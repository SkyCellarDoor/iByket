@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.css"
          rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="ui top attached menu">
        @if ($opt_client->providers_model->type == 1)
            <div class="item">ИП "<b>{{ $opt_client->providers_model->company }}</b>"</div>

        @else
            <div class="item">ООО "<b>{{ $opt_client->providers_model->company }}</b>"</div>

        @endif
        <div class="right menu">
            <a class="item" data-type="1" onclick="new_fin($(this).attr('data-type'))"> <i
                        class="minus icon red "></i></a>
            <div class="item">
                @if ( $opt_client->bill < 0 )
                    <div class="ui red mini horizontal statistic">
                        <div class="value">
                            {{ $opt_client->bill }}
                        </div>
                        <div class="label">
                            руб.
                        </div>
                    </div>
                @elseif( $opt_client->bill > 0 )
                    <div class="ui green mini horizontal statistic">
                        <div class="value">
                            {{ $opt_client->bill }}
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

    <div class="ui bottom attached segment">
        <div class="ui grid">
            <div class="twelve wide column">
                <div id="tabs" class="ui top attached tabular menu">
                    <a class="item active " data-tab="main">Основное</a>
                    <a class="item" data-tab="buy">Покупки</a>
                    <a class="item" data-tab="order">Заказы</a>
                    <a class="item" data-tab="contacts">Контакты</a>
                </div>

                <div class="ui bottom attached tab segment active" data-tab="main">
                    <table id="buy" class="ui compact green selectable celled table">
                        <thead>
                        <tr>
                            <th colspan="3">Последние 5 заказов</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($orders->take(5) as $order)--}}
                        {{--<tr>--}}
                        {{--<td class="collapsing">--}}
                        {{--<a href="{{ route('order_detail') }}/{{$order->id}}">{{$order->id}}</a>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                        {{--{{ $order->created_at }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                        {{--{{ $order->status_history_model->status_name_model->name }}--}}
                        {{--</td>--}}

                        {{--</tr>--}}
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
                <div class="ui bottom attached tab segment" data-tab="buy">
                    <table id="buy" class="ui compact green selectable celled table">
                        <thead>
                        <tr>
                            <th colspan="3">Покупки</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($orders->take(5) as $order)--}}
                        {{--<tr>--}}
                        {{--<td class="collapsing">--}}
                        {{--<a href="{{ route('order_detail') }}/{{$order->id}}">{{$order->id}}</a>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                        {{--{{ $order->created_at }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                        {{--{{ $order->status_history_model->status_name_model->name }}--}}
                        {{--</td>--}}

                        {{--</tr>--}}
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
                <div class="ui bottom attached tab segment" data-tab="order">
                    <table id="buy" class="ui compact green selectable celled table">
                        <thead>
                        <tr>
                            <th colspan="3">Заказы</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($orders->take(5) as $order)--}}
                        {{--<tr>--}}
                        {{--<td class="collapsing">--}}
                        {{--<a href="{{ route('order_detail') }}/{{$order->id}}">{{$order->id}}</a>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                        {{--{{ $order->created_at }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                        {{--{{ $order->status_history_model->status_name_model->name }}--}}
                        {{--</td>--}}

                        {{--</tr>--}}
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
                <div class="ui bottom attached tab segment" data-tab="contacts">
                    4
                </div>
            </div>
            <div class="four wide column">
                <div class="ui card" style="width: 100%">
                    <div class="content">
                        <div class="meta">
                            Адреса:
                            <span class="right floated"><a><i id="add_address" class="plus icon"></i></a></span>

                        </div>
                        @foreach( $addresses as $address )
                            <div class="description">
                                {{ $address->address }}
                            </div>
                        @endforeach
                    </div>
                    <div class="content">
                        <div class="meta">
                            Контакты:
                            <span class="right floated"><a id="add_contact"><i class="plus icon"></i></a></span>
                        </div>
                        @foreach( $contacts as $contact )
                            <div class="description">
                                {{ $contact->name }} | {{ $contact->phone }}
                            </div>
                        @endforeach
                    </div>
                    <div class="extra content">
                        <a>
                            <i class="calculator icon"></i>
                            13000 р.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Модальное окно финасовых операций --}}

    <div id="fin_modal" class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            <span id="type_name"></span>
        </div>
        <div class="content">
            <form id="form_move_money" class="ui form" action="{{ route('fin_operation') }}" method="POST">
                <input id='type_op' name="type_op" type="hidden" value="">
                <input id='client_id' name="client_id" type="hidden" value="{{ $opt_client->id }}">
                {{ csrf_field() }}
                <div class="ui grid">
                    <div class="four wide column field">
                        <div class="ui right labeled input ">
                            <input id='cash_value' name="value" value="" type="text" placeholder="Сумма">
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


    {{--модальное окно добавления адресса--}}

    <div id="address" class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            <span>Добавить адрес</span>
        </div>
        <div class="content">
            <form id="add_address_form" class="ui form" action="{{ route('add_address') }}" method="POST">
                {{ csrf_field() }}
                <input name="user_id" type="hidden" value="{{ $opt_client->id }}">
                <div class="fields">
                    <input name="address" value="" type="text" placeholder="Адрес">
                </div>
                <div class="ui small error message"></div>

        </div>
        <div class="actions">
            <a class="ui black cancel button">Отмена</a>
            <input type="submit" class="ui ok green button">
            </form>
        </div>

    </div>

    {{--модальное окно добавления контакта--}}

    <div id="contact" class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            <span>Добавить адрес</span>
        </div>
        <div class="content">
            <form id="add_contact_form" class="ui form" action="{{ route('add_contact') }}" method="POST">
                {{ csrf_field() }}
                <input name="user_id" type="hidden" value="{{ $opt_client->company_id }}">
                <div class="fields">
                    <div class="field four wide">
                        <label>Должность</label>
                        <input name="role" value="" type="text" placeholder="Должность">
                    </div>
                    <div class="field twelve wide">
                        <label>Имя Фамилия</label>
                        <input name="name" value="" type="text" placeholder="Имя Фамилия">
                    </div>
                </div>
                <div class="fields">
                    <div class="five wide column field">
                        <label>Номер телефона</label>
                        <div class="ui labeled input">
                            <label for="amount" class="ui label">+7</label>
                            <input id="phone_opt" type="text" name="phone" placeholder="Номер телефона">
                        </div>
                    </div>
                </div>
                <div class="ui small error message"></div>

        </div>
        <div class="actions">
            <a class="ui black cancel button">Отмена</a>
            <input type="submit" class="ui ok green button">
            </form>
        </div>

    </div>

@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    <script src="{{ asset("/semantic/") }}/js/jquery.mask.js" type="text/javascript"></script>
@endsection


@section('script')
    <script>


        $('#add_address').on('click', function () {


            $('#address').modal('show');

            $("#address").modal({
                onApprove: function () {
                    $("#add_address_form").form({
                        fields: {
                            address: {
                                identifier: 'address',
                                rules: [{
                                    type: 'empty',
                                    prompt: 'Введите адрес'
                                }]
                            },
                        }
                    });

                    if ($("#add_address_form").form('is valid')) {
                        return true;
                    }
                    return false;
                }
            });
        });

        $('#add_contact').on('click', function () {

            $('#contact').modal('show');

            $('#phone_opt').mask('(000)-000-00-00', {placeholder: "(000)-000-00-00"});

            $("#contact").modal({
                onApprove: function () {
                    $("#add_contact_form").form({
                        fields: {
                            name: {
                                identifier: 'name',
                                rules: [{
                                    type: 'empty',
                                    prompt: 'Введите имя'
                                }]
                            },
                            phone: {
                                identifier: 'phone',
                                rules: [{
                                    type: 'empty',
                                    prompt: 'Введите телефон'
                                }]
                            },
                        }
                    });

                    if ($("#add_contact_form").form('is valid')) {
                        return true;
                    }
                    return false;
                }
            });
        });


        $('.menu .item').tab();

        $('#add').on('click', function () {

            $('#add_modal').modal('show');

            $(function () {
                $('input[name="real_date"]').daterangepicker({
                    format: 'YYYY-MM-DD',
                    "singleDatePicker": true,
                });
            });

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


