@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css"/>

@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--начало заголовка страницы--}}
    <div class="page-bar">

        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('home') }}">Домой</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Отчет</span>
            </li>
        </ul>

        <div class="page-toolbar">
            <form class="form-inline" role="form">
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-calendar" style="margin: 10px 2px 4px 10px; !important;"></i>
                        <input id="reportrange" type="text" name="date_period" class="form-control" readonly>
                    </div>
                </div>

                <button type="submit" class="btn btn-success" style="margin-top: 0px; !important;">Применить</button>
            </form>
            {{--<div class="input-group-control pull-right">--}}
            {{--<input id="reportrange" type="text" name="date_period" class="form-control">--}}

            {{--</div>--}}
            {{--<div class="m-grid-col-md-3 pull-right">--}}
            {{--<div class="input-group" id="defaultrange">--}}
            {{--<input id="reportrange" type="text" name="date_period" class="form-control">--}}
            {{--<span class="input-group-btn">--}}
            {{--<button class="btn default date-range-toggle" type="button" name="date_period">--}}
            {{--<i class="fa fa-calendar"></i>--}}
            {{--</button>--}}
            {{--</span>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
    {{--конец заголовка страницы--}}

    <br/>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse_fin"><b>Финансовые операции</b></a>
            </h4>
        </div>
        <div id="collapse_fin" class="collapse">
            <table class="table table-bordered table-striped table-hover table-condensed" style="margin-bottom: -1px;">
                <thead>
                <tr>
                    <th class="col-md-2 text-center">
                        <i class="fa fa-calendar"></i> Дата
                    </th>
                    <th class="text-center">
                        Клиент
                    </th>
                    <th>
                        Комментарий
                    </th>
                    <th class="text-center">
                        Тип
                    </th>
                    <th class="col-md-1 text-center">
                        Сумма
                    </th>

                </tr>
                </thead>
                <tbody>

                @foreach($bills_operation as $operation)
                    <tr>
                        <td class="text-center" style="vertical-align:middle">
                            {{ $operation->created_at }}
                        </td>
                        <td class="text-center" style="vertical-align:middle">
                            {{ $operation->client_id }}
                        </td>
                        <td>
                            {{ $operation->comments }}
                        </td>
                        <td class="text-center" style="vertical-align:middle">
                            {{ $operation->type }}
                        </td>
                        @if($operation->value > 0)
                            <td class="text-center font-green-meadow" style="vertical-align:middle;">
                                <b>{{ $operation->value }} р.</b>
                            </td>
                        @elseif($operation->value < 0)
                            <td class="text-center font-red" style="vertical-align:middle">
                                <b>{{ $operation->value }} р.</b>
                            </td>
                        @endif
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="raw" style="text-align: right;">
                Общая сумма финансовых операций: <b>{{ $amunt_opertion }} р.</b>
            </div>
        </div>

    </div>


@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>


@endsection


@section('script')
    <script>
        $(function () {

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                opens: 'left',
                ranges: {
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'За неделю': [moment().subtract(6, 'days'), moment()],
                    'За 30 дней': [moment().subtract(29, 'days'), moment()],
                    'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
                    'Предыдущий месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                },
                locale: {
                    format: 'YYYY-MM-DD',
                    firstDay: 1,
                    separator: " - ",
                    applyLabel: "Принять",
                    cancelLabel: "Отмена",
                    customRangeLabel: "Период",
                    daysOfWeek: [
                        "Вс",
                        "Пн",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Сб"
                    ],
                    monthNames: [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Остябрь",
                        "Ноябрь",
                        "Декабрь"
                    ],
                },
            }, cb);

            cb(start, end);

        });

    </script>
@endsection


