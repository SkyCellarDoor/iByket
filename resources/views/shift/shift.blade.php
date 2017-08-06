@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}


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

        <div class="ui equal width grid" style="margin: 5px;">
            @foreach($bill_sum as $bill=>$sum)
                <div class="ui column">
                    <div class="ui segments">
                        <div class="ui {{ \App\BillModel::find($bill)->color }} bottom attached label"
                             style="padding: 5px;">{{ \App\BillModel::find($bill)->description }}</div>
                        <div class="ui  {{ \App\BillModel::find($bill)->color }} segment">
                            <a class="ui  {{ \App\BillModel::find($bill)->color }} ribbon label">{{ \App\BillModel::find($bill)->name }}</a>
                        </div>
                        <div class="ui segment">
                            <b>{{ $sum }}</b> р.
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
            <table class="ui very compact selectable celled table">
            <thead>
            <tr>
                <th colspan="5">
                    Финансовые операции
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($operations as $operation)
                <tr>
                    <td class="text-center" style="vertical-align:middle">
                        {{ $operation->created_at }}
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

                    <td class="text-center" style="vertical-align:middle">
                        <i class="fa fa-{{ \App\BillModel::find($operation->bill)->image  }}"></i>
                    </td>
                    @if($operation->value > 0)
                        <td class="text-center font-green-meadow" style="vertical-align:middle;">
                            <b>{{ $operation->value }}&nbsp;р.</b>
                        </td>
                    @elseif($operation->value < 0)
                        <td class="text-center font-red" style="vertical-align: middle; width: 100px;">
                            <b>{{ $operation->value }}&nbsp;р.</b>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

        </div>
        <div class="ui bottom attached tab segment" data-tab="sells">
            <table class="ui very compact selectable celled table">
                <thead>
                <tr>
                    <th colspan="4">
                        Продажи
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($sells as $sell)
                    <tr>
                        <td><a href="{{ route('sell_detail') }}/{{ $sell->id }}">{{ $sell->id }}</a>
                        </td>
                        @if($sell->client_sell_model == NULL)
                            <td>Без клиента</td>
                        @else
                            <td>
                                <a href="{{ route('detail_view') }}/{{ $sell->client_id }}">{{ $sell->client_sell_model->name }}</a>
                            </td>
                        @endif
                        <td>{{ $sell->created_at }}</td>
                        <td>{{ $sell->summa }} p.</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}
@endsection


@section('script')
    <script>
        $('.menu .item').tab();
        $(".dropdown").dropdown();
    </script>
@endsection


