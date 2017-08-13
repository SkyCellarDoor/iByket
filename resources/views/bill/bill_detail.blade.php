@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;<b>{{ $bill->name }}</b></div>
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
                <th>Коментарий</th>
                <th class="collapsing">Дата</th>
                <th class="collapsing">Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($operations as $operation)
                <tr>
                    <td>
                        {{ $operation->id }}
                    </td>
                    <td>
                        {{ $operation->comments }}
                    </td>
                    <td nowrap>
                        {{ $operation->created_at }}
                    </td>
                    <td nowrap>
                        {{ $operation->value }}
                    </td>

                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Сумма:</th>
            </tr>
            </tfoot>
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

                location.href = '{{ route('bill_detail') }}/{{ $bill->id }}/' + $(this).val();

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
                },
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(3, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(3).footer()).html(
                        'Сумма: ' + pageTotal.toFixed(2) + ' p. (всего: ' + total.toFixed(2) + ' p. )'
                    );
                }
            });
        });

        $(document).ready(function () {
            $('#example').DataTable({});
        });

        $('.menu .item').tab();

    </script>
@endsection


