@extends('skyapp.index')

@section('page_css')

@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--начало заголовка страницы--}}

    <div class="ui top attached menu">
        <div class="item">&nbsp;Смена</div>
        <div class="right menu">
            <div class="ui right dropdown item">
                Смена
                <i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item"><b>Начало смены:</b> {{ \App\ShiftModel::OpenShift()->first()->created_at }}</div>
                    <div class="item"><b>Начальная касса: </b><span class="">{{ \App\ShiftModel::OpenShift()->first()->cash }}
                            р.</span></div>
                    <div class="item">
                        <form action="{{ route('end_shift') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="cash" value="{{  $bill_sum[$default_bill] }}">
                            <button class="fluid ui teal button">Конец смены</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="ui bottom attached segment">
        <div class="ui cards">
            @foreach($bill_sum as $bill => $sum)
                <div class="ui {{ \App\BillModel::find($bill)->color }} card">
                    <div class="content">
                        <div class="header">
                            {{ \App\BillModel::find($bill)->name }}

                            <span class="right floated">
                            <a>
                                <i class="{{ \App\BillModel::find($bill)->image }} big icon"></i>
                            </a>
                        </span>
                        </div>
                        <div class="meta">
                            {{ \App\BillModel::find($bill)->description }}
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="header">
                      <span class="right floated">
                        {{ $sum }}&nbsp;p.
                      </span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="fin_op">Финасовые операции</a>
            <a class="item" data-tab="sells">Продажи</a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="fin_op">
            <table id="fin_table" class="ui very compact selectable celled table">
            <thead>
            <tr>
                <th class="collapsing">
                    Дата
                </th>
                <th>
                    Клиент/Операция
                </th>
                <th>
                    Комментарий
                </th>
                <th>
                </th>
                <th>
                    Сумма
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($operations as $operation)
                <tr>
                    <td nowrap>
                        {{ mb_convert_case(strval($operation->created_at->format('d F H:i')), MB_CASE_TITLE, "UTF-8") }}
                    </td>
                    @if($operation->client_id == 'spend')
                        <td class="text-center" style="vertical-align:middle">
                            Расход
                        </td>
                        <td class="negative">
                            Нет прав на просмотр
                        </td>
                    @elseif ($operation->client_id == 'move' )
                        <td class="text-center" style="vertical-align:middle">
                            Перемещение
                        </td>
                        <td class="negative">
                            Нет прав на просмотр
                        </td>
                    @else
                        <td class="text-center" style="vertical-align:middle">
                            @if($operation->client_cash_model == NULL)
                                Без клиента
                            @else
                                <a href="{{ route('detail_view') }}/{{ $operation->client_id }}">{{ $operation->client_cash_model->name }}</a>
                            @endif
                        </td>
                        <td>
                            {{ $operation->comments }}
                        </td>
                    @endif

                    <td class="collapsing">
                        <i class="{{ $operation->bill_model->image }} icon"></i>
                    </td>
                    @if($operation->value > 0)
                        <td class="collapsing positive">
                            <b>{{ $operation->value }}&nbsp;р.</b>
                        </td>
                    @elseif($operation->value < 0)
                        <td class="collapsing negative">
                            <b>{{ $operation->value }}&nbsp;р.</b>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

        </div>
        <div class="ui bottom attached tab segment" data-tab="sells">
            <table id="sells" class="ui very compact selectable celled table">
                <thead>
                <tr>
                    <th class="collapsing">
                        №
                    </th>
                    <th>
                        Клиент
                    </th>
                    <th>
                        Дата
                    </th>
                    <th class="collapsing">
                        Сумма
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($sells as $sell)
                    <tr>
                        <td>
                            <a href="{{ route('sell_detail') }}/{{ $sell->id }}">{{ $sell->id }}</a>
                        </td>
                        @if($sell->client_sell_model == NULL)
                            <td>Без клиента</td>
                        @else
                            <td>
                                <a href="{{ route('detail_view') }}/{{ $sell->client_id }}">{{ $sell->client_sell_model->name }}</a>
                            </td>
                        @endif
                        <td>{{ mb_convert_case(strval($sell->created_at->format('d F H:i')), MB_CASE_TITLE, "UTF-8") }}</td>
                        <td nowrap>{{ $sell->summa }} p.</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection


@section('page_scripts')

@endsection


@section('script')
    <script>
        $(document).ready(function () {
            $('#fin_table').DataTable({
                "lengthMenu": [[25, 50, -1], [25, 50, "Все"]],
                "language": {
                    "lengthMenu": "_MENU_  &nbsp;&nbsp;записей на страницу",
                    "zeroRecords": "Ничего не найдено",
                    "info": "Старница _PAGE_ из _PAGES_",
                    "search": "Поиск:",
                    "paginate": {
                        "first": "Начало",
                        "last": "Конец",
                        "next": "Вперед",
                        "previous": "Назад"
                    },
                }
            });

            $('#sells').DataTable({
                "lengthMenu": [[25, 50, -1], [25, 50, "Все"]],
                "language": {
                    "lengthMenu": "_MENU_  &nbsp;&nbsp;записей на страницу",
                    "zeroRecords": "Ничего не найдено",
                    "info": "Старница _PAGE_ из _PAGES_",
                    "search": "Поиск:",
                    "paginate": {
                        "first": "Начало",
                        "last": "Конец",
                        "next": "Вперед",
                        "previous": "Назад"
                    },
                }
            });


            $('.menu .item').tab();

        });



    </script>
@endsection


