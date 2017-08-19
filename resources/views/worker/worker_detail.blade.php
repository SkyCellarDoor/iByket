@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}
    <link href="../assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css"/>
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="ui menu">
        <div class="item">&nbsp;<b>Сотрудник</b></div>
        <div class="item"><b>{{ $workers->name }}</b></div>
        {{--<a class="item" href="{{ route('new_order') }}/{{ $workers->id }}"><i class="plus icon green"></i>Заказ</a>--}}
        {{--<a class="item" href="{{ route('sell') }}/{{ $workers->id }}"><i class="plus icon green"></i>Продажа</a>--}}
        <div class="right menu">
            <a class="item" data-type="1" href="#fin_modal" onclick="new_fin($(this).attr('data-type'))"> <i
                        class="minus icon red "></i></a>
            <div class="item">
                @if ( $workers->bill < 0 )
                    <div class="ui red mini horizontal statistic">
                        <div class="value">
                            {{ $workers->bill }}
                        </div>
                        <div class="label">
                            руб.
                        </div>
                    </div>
                @elseif( $workers->bill > 0 )
                    <div class="ui green mini horizontal statistic">
                        <div class="value">
                            {{ $workers->bill }}
                        </div>
                        <div class="label">
                            руб.
                        </div>
                    </div>
                @else
                    <div class="ui mini horizontal statistic">
                        <div class="value">
                            0
                        </div>
                        <div class="label">
                            руб.
                        </div>
                    </div>
                @endif
            </div>
            <a class="item" data-type="0" href="#fin_modal" onclick="new_fin($(this).attr('data-type'))"> <i
                        class="plus icon green"></i></a>
        </div>
    </div>
    <div id="tabs" class="ui top attached tabular menu">
        <a class="item active " data-tab="main">Основное</a>
        <a class="item" data-tab="more" data-value="more">Подробности</a>
        <a class="item" data-tab="orders">Заказы</a>
        <a class="item" data-tab="sells">Покупки</a>
        <a class="item" data-tab="fin_op">Финансовые операции</a>
    </div>
    <div class="ui bottom attached tab segment active" data-tab="main">
        <div class="ui grid">

            <div class="ui twelve wide column">
                <table class="ui green selectable celled table">
                    <thead>
                    <tr>
                        <th colspan="3">Последние 5 заказов</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="ui four wide column">
                <div class="ui centered card" style="width: 100%">
                    <div class="content">
                        <a>
                        <span class="right floated thumbs outline up">
                            <i class="right floated thumbs outline up icon"></i>
                        </span>
                        </a>
                        <a>
                        <span class="right floated thumbs outline down">
                            <i class="right floated thumbs outline down icon"></i>
                        </span>
                        </a>
                        <div class="header"></div>
                        <div class="description">
                            <p></p>
                        </div>
                    </div>
                    <div class="content">
                        <div class="ui feed">
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <span class="right floated">
                                          <i class="call square green icon"></i>{{ $workers->phone }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="event">--}}
                            {{--<div class="content">--}}
                            {{--<div class="summary">--}}
                            {{--<span class="right floated">--}}
                            {{--<i class="calendar blue icon"></i>--}}
                            {{--10.09.2017--}}
                            {{--</span>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    {{--<div class="extra content">--}}
                    {{--<span class="left floated calculator">--}}
                    {{--<i class="calculator icon"></i>--}}
                    {{--</span>--}}
                        {{--<span class="right floated percent">--}}
                        {{--<span>5</span>--}}
                        {{--<i class="percent icon"></i>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="ui bottom attached tab segment" data-tab="more">
        2
    </div>
    <div class="ui bottom attached tab segment" data-tab="orders">
        <table class="ui green selectable celled table">
            <thead>
            <tr>
                <th colspan="3">Последние 5 заказов</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="ui bottom attached tab segment" data-tab="sells">
        <table class="ui green selectable celled table">
            <thead>
            <tr>
                <th style="width: 1%">
                    №
                </th>
                <th>
                    Сумма
                </th>
                <th style="width: 20%">
                    Дата
                </th>

            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="ui bottom attached tab segment" data-tab="fin_op">
        <table class="ui blue very compact small selectable celled table dimmable">
            <thead>
            <tr>
                <th>
                    Дата
                </th>
                <th>
                    Коментарий
                </th>
                <th>
                    Сумма
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($bills_operation as $operation)
                <tr>
                    <td>
                        {{ $operation->created_at }}
                    </td>
                    <td>
                        @if( $operation->storage_id == NULL )
                            <span style="font-style: italic;">{{ $operation->comments }}</span>
                        @else
                            <span>{{ $operation->comments }}</span>
                        @endif
                    </td>
                    <td>
                        @if( $operation->storage_id == NULL )
                            <span style="font-style: italic;">{{ $operation->value }}</span> p.
                        @else
                            <span><b>{{ $operation->value }}</b></span> p.
                        @endif

                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>

    {{--Модальные окна--}}


    <div id="fin_modal" class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            <span id="type_name"></span>
        </div>
        <div class="content">
            <form id="form_move_money" class="ui form" action="{{ route('fin_operation') }}" method="POST">
                <input id='type_op' name="type_op" type="hidden" value="">
                <input id='client_id' name="client_id" type="hidden" value="{{ $workers->id }}">
                {{ csrf_field() }}
                <div class="ui grid">
                    <div class="four wide column field">
                        <div class="ui right labeled input ">
                            <input id='cash_value' name="value" value="" type="number" placeholder="Сумма">
                            <div class="ui label">
                                p.
                            </div>
                        </div>
                    </div>
                    <div class="six wide column ">
                        <select id="bills" class="dropdown field" name="bill">
                            <option value="">Способ оплаты</option>
                            @foreach( $bills as $bill )
                                <option value="{{ $bill->id }}">{{ $bill->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="sixteen wide column">
                    <div class="ui form">
                        <div class="field">
                            <textarea rows="2" name="comments" placeholder="Комментарий"></textarea>
                        </div>
                    </div>
                </div>
                <div class="ui error message"></div>
        </div>
        <div class="actions">
            <input type="submit" class="ui black deny button" value="Отмена" onclick="event.preventDefault();">
            <input type="submit" class="ui ok green button">
            </form>
        </div>
    </div>


    {{--Модальные окна--}}

@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
@endsection


@section('script')
    <script>
        $('.menu .item').tab({
            history: true,
            historyType: 'hash',
        });

        function new_fin(type, value_max) {


            $("#fin_modal").modal('show');


            $("#fin_modal #type_op").val(type);

            if (type < 1) {
                $("#fin_modal #type_name").text("Зачисление");
            }
            else {
                $("#fin_modal #type_name").text("Списание");

            }

            $("#fin_modal").modal({
                onApprove: function () {
                    $("#form_move_money")
                        .form({
                            fields: {
                                value: {
                                    identifier: 'value',
                                    rules: [
                                        {
                                            type: 'empty',
                                            prompt: 'Введите сумму'
                                        }
                                    ]
                                },
                                comment: {
                                    identifier: 'comments',
                                    rules: [
                                        {
                                            type: 'empty',
                                            prompt: 'Введите описание'
                                        }
                                    ]
                                },
                                bill: {
                                    identifier: 'bills',
                                    rules: [
                                        {
                                            type: 'minCount[1]',
                                            prompt: 'Выберите счет'
                                        }
                                    ]
                                }

                            }
                        });

                    if ($("#form_move_money").form('is valid')) {
                        return true;
                    }
                    return false;
                }
            });

        }
    </script>
@endsection


