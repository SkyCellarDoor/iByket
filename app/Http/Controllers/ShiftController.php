<?php

namespace App\Http\Controllers;

use App\CashRoutesModel;
use App\MoveMoneyModel;
use App\SellsModel;
use App\ShiftModel;
use App\SpendModel;
use App\StorageModel;
use Illuminate\Http\Request;
use App\BillModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PhpParser\ErrorHandler\Collecting;

class ShiftController extends Controller
{
    public function index()
    {


        $shift = ShiftModel::OpenShift()->first();

        if (empty($shift)) {

            $last = ShiftModel::LastShift()->first();

            if (empty($last)) {
                $last = 0;
            }

            return view('shift.new_shift')->with('last_shift_cash', $last);
        } else {

            $bills = BillModel::WhatKindBillThisUser();
            $data = $shift->created_at->toDateTimeString();
            $begin_cash = $shift->cash;
            $default_bill = StorageModel::UserStorage()->default_bill;

            // поиск всех операций магазина к которому принадлежит этот пользователь после начала смены,
            // также выбор только тех счетов, которые принадлежат этому магазину.

            $operations = CashRoutesModel::where('created_at', '>', $data)->whereIn('bill', $bills)->get();
            $spend = SpendModel::where('created_at', '>', $data)->whereIn('bill', $bills)->get();
            $move = MoveMoneyModel::where('created_at', '>', $data)->whereIn('bill', $bills)->get();

            $spend = $spend->map(function ($spend) {
                $spend['client_id'] = 'spend';
                return $spend;
            });

            $move = $move->map(function ($move) {
                $move['client_id'] = 'move';
                return $move;
            });

            $all_operations = $spend->merge($operations)->merge($move)->sortByDesc('created_at');

            $all_operations = $all_operations->filter(function ($all_operations) {
                return $all_operations->value > 0 || $all_operations->bill == 1;
            });

            $all_amount = $all_operations->sum('value') + $begin_cash;

            // сумма отдельных счетов принадлежаащих этому магазину в массиве с ключем в виде  ID счета
            foreach ($bills as $bill) {

                if ($bill == $default_bill) {
                    $bill_sum[$bill] = $all_operations->where('bill', $bill)->sum('value') + $begin_cash;
                } else {
                    $bill_sum[$bill] = $all_operations->where('bill', $bill)->sum('value');
                }

            }
            $sell = SellsModel::where('created_at', '>', $data)->get();

            return view('shift.shift')
                ->with(['operations' => $all_operations])
                ->with(['sells' => $sell])
                ->with(['bill_sum' => $bill_sum])
                ->with('all_amount', $all_amount)
                ->with('default_bill', $default_bill);
        }
    }

    public function endShift(Request $request)
    {

        $thisShift = ShiftModel::OpenShift()->first()->id;
        $shift = ShiftModel::find($thisShift);
        $shift->status = 1;
        $shift->last_cash = $request->cash;
        $shift->save();

        return redirect()->route('shift');
    }

    public function newShift(Request $request)
    {

        $new_shift = new ShiftModel();
        $new_shift->cash = $request->cash;
        $new_shift->status = 0;
        $new_shift->storage_id = StorageModel::UserStorage()->id;
        $new_shift->user_id = Auth::id();
        $new_shift->save();

        return redirect()->route('shift');
    }
}