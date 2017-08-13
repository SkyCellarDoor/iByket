@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Список активных заказов</div>
    </div>



    <div class="ui bottom attached segment">

        <div class="ui top attached tabular menu ">
            <a class="item active" data-tab="main">Список</a>
            <a class="item" data-tab="today">Сегодня</a>
            <a class="item" data-tab="week">Неделя</a>
        </div>
        <div class="ui bottom attached tab segment active" data-tab="main">

            <table id="dataTable" class="ui very compact green selectable celled table">
            <thead>
            <tr>
                <th style="width: 1%">№</th>
                <th>Клиент</th>
                <th class="collapsing">Телефон</th>
                <th>Адрес</th>
                <th>Дата/Время</th>
                <th class="collapsing">Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('order_detail') }}/{{ $order->id }}">
                            {{ $order->id }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('detail_view') }}/{{ $order->client_id }}"> {{ $order->client_model->name }}</a>
                    </td>
                    <td nowrap>
                        {{ $order->client_model->phone }}
                    </td>
                    <td>
                        @if( $order->address_model != NULL)
                            {{ $order->address_model->address }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if( $order->time_delivery != NULL)
                            {{ mb_convert_case(strval(\Jenssegers\Date\Date::parse($order->time_delivery)->format('d F H:i')), MB_CASE_TITLE, "UTF-8") }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ $order->status_history_model->status_name_model->name }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            {{--<table id="dataTable" class="ui celled table" cellspacing="0" width="100%">--}}
            {{--<thead>--}}
            {{--<tr>--}}
            {{--<th>Name</th>--}}
            {{--<th>Position</th>--}}
            {{--<th>Office</th>--}}
            {{--<th>Age</th>--}}
            {{--<th>Start date</th>--}}
            {{--<th>Salary</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tfoot>--}}
            {{--<tr>--}}
            {{--<th>Name</th>--}}
            {{--<th>Position</th>--}}
            {{--<th>Office</th>--}}
            {{--<th>Age</th>--}}
            {{--<th>Start date</th>--}}
            {{--<th>Salary</th>--}}
            {{--</tr>--}}
            {{--</tfoot>--}}
            {{--<tbody>--}}
            {{--<tr>--}}
            {{--<td>Tiger Nixon</td>--}}
            {{--<td>System Architect</td>--}}
            {{--<td>Edinburgh</td>--}}
            {{--<td>61</td>--}}
            {{--<td>2011/04/25</td>--}}
            {{--<td>$320,800</td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
            {{--</table>--}}
        </div>

        <div class="ui bottom attached tab segment" data-tab="today">


            <table class="ui single line table">
                <thead>
                <tr>
                    <th>
                        {{ $today }}
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders_today as $key => $items)
                    <tr>
                        <td class="positive">
                            <b>{{ $key }}:00 @if($this_hour < $key) Ближайшие @endif</b>
                        </td>
                        <td class="positive"></td>
                    </tr>
                    @foreach($items as $item)
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{ route('order_detail') }}/{{ $item->id }}">
                                    {{ \Carbon\Carbon::parse($item->time_delivery)->format('H:i') }}
                                </a>
                                |
                                @if($item->type == 1)
                                    Доставка
                                @else
                                    Самовывоз
                                @endif
                            </td>
                            <td>{{ $item->client_model->name }}</td>
                        </tr>
                    @endforeach
                @endforeach

                </tbody>
            </table>


        </div>

        <div class="ui bottom attached tab segment" data-tab="week">
            <table class="ui single line table">
                <thead>
                <tr>
                    <th>{{ $this_week_start }} - {{ $this_week_end }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td>Если надо, сделаю</td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>

        @endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "aaSorting": [],
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
        });

        $('.menu .item').tab();

    </script>
@endsection


