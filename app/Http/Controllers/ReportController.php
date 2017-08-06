<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CashRoutesModel;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function index() {

        //вывод финасовых операций

        //сегодняшня дата с часами и минутами
        $fromDate = new Carbon('now', 'Asia/Krasnoyarsk');
        // обрезаем минуты и приклеиваем начало дня 00:00:00
        $now_day = $fromDate->toDateString()." 00:00:00";
        //сегодняшня дата с часами и минутами
        $toDate = new Carbon('now','Asia/Krasnoyarsk');


        $bills_operation = CashRoutesModel::whereBetween('created_at', [$now_day, $toDate])->orderBy('created_at', 'desc')->get();
        $amunt_opertion = $bills_operation->sum('value');
        //dump($bills_operation->sum('value'));
        return view('report.full_report')->with('bills_operation', $bills_operation)->with('amunt_opertion', $amunt_opertion);

    }


}
