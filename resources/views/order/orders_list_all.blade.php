@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Список всех заказов</div>
        <div class="right item">
            <div class="ui transparent icon input">
                <input name="sort_date" type="text" placeholder="." readonly style="width: 210px;">
                <i class="calendar icon"></i>
            </div>
        </div>
    </div>
    </div>

    <div class="ui bottom attached segment">


        <table id="dataTable" class="ui very compact green selectable celled table">
            <thead>
            <tr>
                <th style="width: 1%">№</th>
                <th>Клиент</th>
                <th class="collapsing">Телефон</th>
                <th>Адрес</th>
                <th>Дата/Время</th>
                <th>Магазин</th>

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
                        {{ $order->storage_model->name }}

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

@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}
@endsection


@section('script')
    <script>
        $(document).ready(function () {

            let input_sort = $('input[name="sort_date"]');

            var start = moment().startOf('month');
            var end = moment();

            function cb(start, end) {
                input_sort.val(start.format('YYYY-MM-DD') + ' | ' + end.format('YYYY-MM-DD'));
            }

            input_sort.daterangepicker({
                "separator": " | ",
                format: 'YYYY-MM-DD',
                ranges: {
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                    'Этот месяц': [moment().startOf('month'), moment()],
                    'Предыдущий месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                autoUpdateInput: false,
                opens: "left",
                locale: {
                    cancelLabel: 'Отмена'
                },

            }, cb);

            cb(start, end);

            input_sort.on('apply.daterangepicker', function (ev, picker) {

                location.href = '{{ route('orders_list_all') }}/' + $(this).val();

            });


//            input_sort.on('apply.daterangepicker', function(ev, picker) {
//                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
//            });
//
//            input_sort.on('cancel.daterangepicker', function(ev, picker) {
//                $(this).val('');
//            });


            $('#dataTable').DataTable({
                "aaSorting": [],
                "lengthMenu": [[25, 50, -1], [25, 50, "Все"]],
                "language": {
                    "lengthMenu": "_MENU_  &nbsp;&nbsp;записей на страницу",
                    "zeroRecords": "В выбранном диапозоне дат, нет ни одного заказа",
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


