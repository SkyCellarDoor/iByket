@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.css"
          rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="ui top attached menu">
        @if ($opt_client->providers_model->type == 1)
            <div class="item">ИП "<b><span id="name_company">{{ $opt_client->providers_model->company }}</span></b>"
            </div>

        @else
            <div class="item">ООО "<b><span id="name_company">{{ $opt_client->providers_model->company }}</span></b>"
            </div>

        @endif
        <a class="item" href="{{ route('wholesale_sell') }}/{{ $opt_client->id }}"><i class="plus green icon"></i>Новая
            продажа</a>
        <a id="new_order" class="item"><i class="plus green icon"></i>Новый заказ</a>

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
                    <a class="item active" data-tab="main">Основное</a>
                    <a class="item" data-tab="req">Реквизиты</a>
                    <a class="item" data-tab="additional">Дополнительно</a>
                    <a class="item" data-tab="buy">Покупки</a>
                    <a class="item" data-tab="order">Заказы</a>
                    <a class="item" data-tab="contacts">Контакты</a>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="main">
                    <div class="ui form">
                        <div class="field">
                            <label>Комментарий</label>
                            <textarea></textarea>
                        </div>
                    </div>
                </div>
                <div class="ui bottom attached tab segment" data-tab="req">
                    <div class="ui segments">
                        <div class="ui segment">
                            <p><b>Реквизиты:</b></p>
                            <table class="ui compact fluid table">
                                <tbody>
                                <tr>
                                    <td><p>ИНН</p></td>
                                    <td>2461035440</td>
                                </tr>
                                <tr>
                                    <td><p>КПП</p></td>
                                    <td>246101001</td>
                                </tr>
                                <tr>
                                    <td><p>ОГРН</p></td>
                                    <td>1172468002728</td>
                                </tr>
                                <tr>
                                    <td><p>ОКПО</p></td>
                                    <td>06297426</td>
                                </tr>
                                <tr>
                                    <td nowrap><p>Юридический адрес</p></td>
                                    <td>660050, г. Красноярск, ул. Грунтовая, д. 17, оф. 26</td>
                                </tr>
                                <tr>
                                    <td nowrap><p>Фактический адрес</p></td>
                                    <td>660050, г. Красноярск, ул. Грунтовая, д. 17, оф. 26</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ui segment">
                            <label><b>Банковский счет:</b></label>
                            <table class="ui compact fluid table">
                                <tbody>
                                <tr>
                                    <td><p>Расчётный счёт</p></td>
                                    <td><span>40702810506500000443</span></td>
                                </tr>
                                <tr>
                                    <td><p>Корреспондентский</p></td>
                                    <td><span>30101810845250000999</span></td>
                                </tr>
                                <tr>
                                    <td><p>БИК</p></td>
                                    <td><span>044525999</span></td>
                                </tr>
                                <tr>
                                    <td nowrap><p>Наименование банка</p></td>
                                    <td>
                                        ТОЧКА ПАО БАНКА "ФК ОТКРЫТИЕ" Адрес банка 117216, Москва, ул.
                                        Старокачаловская 1, корпус 2
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="ui attached tab segment" data-tab="additional">
                    <form id="data" method="post" action="{{ route('update_opt_client') }}">
                        {{ csrf_field() }}
                        <input name="id" type="hidden" value="{{ $opt_client->id }}"/>
                        <div class="ui grid">
                            <div class="ui sixteen wide column">
                                <div id="dimmer" class="ui error form">
                                    <div class="ui inverted dimmer">
                                        <div class="content">
                                            <div class="center">
                                                <h2 class="ui icon header"><i class="checkmark icon"></i> Сохраненно
                                                </h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="three fields">
                                        <div class="field">
                                            <label>Название компании</label>
                                            <input id="current_name_company" name="name_company"
                                                   value="{{ $opt_client->providers_model->company }}">
                                        </div>
                                    </div>
                                    <div class="two fields">
                                        <div class="field twelve wide column">
                                            <label>Имя фамилия</label>
                                            <input id="name_main_contact" name="main_contact_name"
                                                   value="{{ $opt_client->name }}">
                                        </div>
                                        <div class="field four wide column">
                                            <label>Номер телефона</label>
                                            <div class="ui labeled input">
                                                <label class="ui label">+</label>
                                                <input id="phone_main_contact" name="main_contact_phone"
                                                       value="{{ $opt_client->phone2 }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input id="update_company" type="submit" class="ui button right floated" style=""
                                       value="Сохранить">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="ui bottom attached tab segment" data-tab="buy">
                    <table id="buy" class="ui compact green selectable celled table">
                        <tbody>
                        @foreach($sells->take(5) as $sell)
                        <tr>
                            <td class="collapsing">
                                <a href="{{ route('wholesale_sell_detail') }}/{{$sell->id}}">{{$sell->id}}</a>
                            </td>
                            <td>
                                {{ $sell->created_at }}
                            </td>
                            <td class="collapsing">
                                {{ $sell->summa }} p.
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="ui bottom attached tab segment" data-tab="order">
                    <table id="buy" class="ui compact green selectable celled table">
                        <tbody>
                        @foreach($orders->take(5) as $order)
                            <tr>
                                <td class="collapsing">
                                    <a href="{{ route('order_detail') }}/{{$order->id}}">{{$order->id}}</a>
                                </td>
                                <td>
                                    {{ $order->date_income }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="ui bottom attached tab segment" data-tab="contacts">
                    <div class="ui segment">
                        <a href="#"><i id="add_address" class="plus icon"></i></a><b>Адреса:</b>
                        <table class="ui compact fluid table">
                            <tbody>
                            @foreach( $addresses as $address )
                                <tr>
                                    <td><p>{{ $address->address }}</p></td>
                                    <td class="collapsing"><i class="cancel icon"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="#"><i id="add_contact" class="plus icon"></i></a><b>Контакты:</b>
                        <table class="ui compact fluid table">
                            <tbody>
                            @foreach( $contacts as $contact )
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>+7 {{ $contact->phone }}</td>
                                    <td class="collapsing"><i class="cancel icon"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="four wide column">
                <div class="ui card" style="width: 100%">
                    <div class="content">
                        <div class="meta">
                            Основной контакт:
                        </div>
                        <div class="description">
                            <span id="name_main_contact_text">{{ $opt_client->name }}</span> | <span
                                    id="phone_main_contact_text"> {{ $opt_client->phone }}</span>
                        </div>
                    </div>
                    <div class="content">
                        <div class="meta">
                            Адреса:
                            {{--<span class="right floated"><a><i id="add_address" class="plus icon"></i></a></span>--}}

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
                            {{--<span class="right floated"><a id="add_contact"><i class="plus icon"></i></a></span>--}}
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
                            {{ $sells_sum }} р.
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

    {{--модальное окно добавление заказа--}}

    <div id="order" class="ui mini modal">
        <i class="close icon"></i>
        <div class="header">
            <span>Добавить адрес</span>
        </div>
        <div class="content">
            <form id="order_form" class="ui form" action="{{ route('new_opt_order') }}" method="POST">
                {{ csrf_field() }}
                <input name="opt_client_id" type="hidden" value="{{ $opt_client->id }}">
                <div class="fields">
                    <div class="field sixteen wide">
                        <label>Дата поставки</label>
                        <input id="date" name="date" value="" type="text" readonly>
                    </div>
                </div>
                <div class="ui small error message"></div>

        </div>
        <div class="actions">
            <a class="ui black cancel button">Отмена</a>
            <input type="submit" class="ui ok green button" value="Продолжить">
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
        $('#phone_main_contact').mask('0 (000) 000-00-00', {placeholder: "0 (000) 000-00-00"});

        $('#update_company').click(function (e) {
            e.preventDefault();

            var formdata = $("#data").serialize();

            $.ajax({
                url: "{{ route('update_opt_client') }}",
                type: 'POST',
                data: formdata,
                beforeSend: function () {

                    $("#update_company").addClass('loading');
                    $('#dimmer').dimmer('show');
                },
                success: function () {
                    $("#name_company").text($("#current_name_company").val());
                    $("#phone_main_contact_text").text("+" + $("#phone_main_contact").val());
                    $("#name_main_contact_text").text($("#name_main_contact").val());
//                    $("#name_product_card").text($("#current_name").val());
                    setTimeout(function () {
                        $("#update_company").removeClass('loading');
                        $('#dimmer').dimmer('hide');
                    }, 1000);

                },
            });
        });

        $('#new_order').on('click', function () {

            $('#order').modal('show');

            $('#date').daterangepicker({
                drops: 'down',
                format: 'YYYY-MM-DD',
                singleDatePicker: true,
                locale: {
                    firstDay: 1,
                },
            });

            $("#order").modal({
                onApprove: function () {
                    $("#order_form").form({
                        fields: {
                            date: {
                                identifier: 'date',
                                rules: [{
                                    type: 'empty',
                                    prompt: 'Выберите дату поставку'
                                }]
                            },
                        }
                    });

                    if ($("#order_form").form('is valid')) {
                        return true;
                    }
                    return false;
                }
            });
        });

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


