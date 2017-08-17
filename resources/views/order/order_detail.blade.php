@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')
    <form class="ui form" action="{{ route('update_order') }}" method="post">
        {{ csrf_field() }}

        <div class="ui top grey five item inverted  menu">
            <div class="item">&nbsp;Заказ № {{ $order->id }}
                | {{ $order->status_history_model->status_name_model->name }}</div>
            <input id="order_id" name="order_id" type="hidden" value="{{ $order->id }}">
            <input name="client_id" type="hidden" value="{{ $order->client_id }}">
            <input name="type_order_pay" type="hidden" value="{{ $order->type }}">
            @if ( $order->type == 1)
                <div class="item">Доставка</div>
                <div class="item ">Время:&nbsp;<b>{{ $time }}</b></div>
                <div class="item">Куда:&nbsp;<b>{{ $order -> address_model->address }}</b></div>
                @if ($order->type_delivery == 1 && $order->from_delivery != NULL)
                    <div class="item">Оплата:&nbsp;<b>Наличные</b>&nbsp;(cдача с {{ $order->from_delivery }})</div>
                @elseif($order->type_delivery == 1)
                    <div class="item">Оплата:&nbsp;<b>Наличные</b></div>
                @else
                    <div class="item">Оплата:&nbsp;<b>Терминал</b></div>
                @endif
            @else
                <div class="item teal">Самовывоз c&nbsp;&nbsp;<b>{{ $order->storage_model->name }}</b></div>
                <div class="item">Время:&nbsp;<b>{{ $time }}</b></div>
            @endif
        </div>
        <div class="top attached ui segment">
            <button class="ui button"
                    onclick="status(2)" {{ $order->status_history_model->status_name_id >= 2 || $order->status_history_model->status_name_id >= 5 ? "disabled" : "" }}>
                Собран<i class="angle double right icon"></i></button>
            <button class="ui button"
                    onclick="status(3)" {{ $order->status_history_model->status_name_id >= 3 || $order->status_history_model->status_name_id >= 5 ? "disabled" : "" }}>
                Отправлен<i class="angle double right icon"></i></button>
            <button class="ui button green"
                    onclick="status(4)" {{ $order->status_history_model->status_name_id >= 4 || $order->status_history_model->status_name_id >= 5 ? "disabled" : "" }}>
                Выполнен
            </button>
            <button class="ui right floated red button"
                    onclick="status(5)" {{ $order->status_history_model->status_name_id >= 5 || $order->status_history_model->status_name_id >= 4 ? "disabled" : "" }}>
                Отменен
            </button>

        </div>
        <div class="bottom attached ui segment">

            <div class="ui top attached tabular menu ">
                <a class="item active " data-tab="first">Описание</a>
                @if ($order->img != NULL)
                    <a class="item" data-tab="image">Изображения</a>
                @endif
                <a class="item" data-tab="second">История</a>
            </div>
            <div class="ui bottom attached tab segment active" data-tab="first">
                <div class="ui grid">
                    <div class="ui twelve wide column">
                        <div class="ui segment">
                            <div class="ui grid">
                                <div class="ui sixteen wide column">
                                    <div class="ui form">
                                        <div class="field">
                                            <label>Описание заказа</label>
                                            <textarea name="comment" rows="5"> {{ $order->comments }}</textarea>
                                        </div>

                                        {{--<div class="field">--}}
                                        {{--<label>Картинка</label>--}}
                                        {{--<div class="ui action input">--}}
                                        {{--<input type="text" readonly>--}}
                                        {{--<input type="file" style="display: none;">--}}
                                        {{--<div class="ui icon button">--}}
                                        {{--<i class="cloud upload icon"></i>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}

                                        <div class="fields">
                                            <div class="field">
                                                @if( $order-> type_delivery == 1)
                                                    <label><span
                                                                id="delivery_type_text">Время&nbsp;доставки</span></label>
                                                @else
                                                    <label><span
                                                                id="delivery_type_text">Время&nbsp;самовывоза</span></label>
                                                @endif

                                                <div class="ui input left icon">
                                                    <i class="calendar icon"></i>
                                                    <input id="date" type="text" value="" readonly>

                                                    <input type="hidden" id="form_time" name="date_delivery"
                                                           value="{{ $order->time_delivery }}"/>
                                                </div>
                                            </div>
                                            @if ( $order->type == 1)
                                                <div id="address" class="fourteen wide column field" style="">
                                                    <label>Адрес доставки</label>
                                                    <input id="address_delivery" type="text" name="address_delivery"
                                                           value="{{ $order -> address_model->address }}">
                                                </div>
                                            @else
                                                <div id="address" class="four wide column field" style="">
                                                    <label>Магазин самомывывоза</label>
                                                    <select class="dropdown field" name="storage">
                                                        <option value="">Выберите магазин</option>
                                                        @foreach( $storages as $storage )
                                                            @if ($storage -> id == $order->storage_id)
                                                                <option value="{{ $storage->id }}"
                                                                        selected>{{ $storage->name }}</option>
                                                            @else
                                                                <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                        </div>

                                        @if ( $order->type == 1)
                                            <div id="other_delivery">
                                                <div class="fields">
                                                    <div class="field">
                                                        <label>Тип оплаты</label>
                                                        <select id="type_operation" name="type_order_pay"
                                                                class="ui dropdown">
                                                            @if( $order-> type_delivery == 1)
                                                                <option value="1" selected>Наличные</option>
                                                                <option value="2">Терминал</option>
                                                            @else
                                                                <option value="1">Наличные</option>
                                                                <option value="2" selected>Терминал</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @if( $order-> type_delivery == 1)
                                                        <div id="delivery_from" class="field">
                                                            <label>Сдача с </label>
                                                            <input name="delivery_from" type="text"
                                                                   value="{{ $order-> from_delivery }}">
                                                        </div>
                                                    @else
                                                        <div id="delivery_from" class="field" style="display: none;">
                                                            <label>Сдача с </label>
                                                            <input name="delivery_from" type="text" value="">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="field">
                                                    <label>Комментарий для курьера</label>
                                                    <textarea name="comment_courier"
                                                              rows="2"> {{ $order->comment_courier }}</textarea>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ui four wide column">
                        <div class="ui fluid centered card">
                            <div class="content">
                                <b>{{ $client->name }}</b>
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
                                        <a class="item" data-type="0" href="#fin_modal"
                                           onclick="new_fin($(this).attr('data-type'))">
                                            <i class="plus icon green"></i>
                                        </a>
                                            @if ( $client->bill < 0 )
                                                <div class="ui red mini horizontal statistic">
                                                    <div class="value">
                                                        {{ $client->bill }}
                                                    </div>
                                                    <div class="label">
                                                        руб.
                                                    </div>
                                                </div>
                                            @elseif( $client->bill > 0 )
                                                <div class="ui green mini horizontal statistic">
                                                    <div class="value">
                                                        {{ $client->bill }}
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
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="event">
                                        <div class="content">
                                            <div class="summary">
                                            <span class="right floated">
                                              <i class="call square green icon"></i>
                                                {{ $client->phone }}
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--<div class="extra content">--}}
                            {{--<span class="left floated calculator">--}}
                            {{--<i class="calculator icon"></i>--}}
                            {{--2023 р.--}}
                            {{--</span>--}}
                            {{--<span class="right floated percent">--}}
                            {{--<span>5</span>--}}
                            {{--<i class="percent icon"></i>--}}
                            {{--</span>--}}
                            {{--</div>--}}
                            <div class="extra content">
                                <div class="field">
                                    <input class="ui button green right floated" type="submit"
                                           value="Сохранить" {{ $order->status_history_model->status_name_id >= 5 || $order->status_history_model->status_name_id >= 4 ? "disabled" : "" }}>
                                </div>
    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="second">
            <table class="ui selectable celled table">
                <thead>
                <tr>
                    <th>Когда</th>
                    <th>Статус</th>
                    <th>Сотрудник</th>
                </tr>
                </thead>
                <tbody>
                @foreach($statuses as $status)
                    <tr>
                        <td>{{ $status->created_at }}</td>
                        <td>{{ $status->status_name_model->name }}</td>
                        <td>{{ $status->status_user_id->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @if ($order->img != NULL)
        <div class="ui bottom attached tab segment" data-tab="image">
            <img class="ui image" src="../storage/orders/{{$order->img}}">
        </div>
        @endif

        </div>
    </form>
    {{--модальное окно зачисления на счет--}}
    <div id="fin_modal" class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            <span id="type_name"></span>
        </div>
        <div class="content">
            <form id="form_move_money" class="ui form" action="{{ route('fin_operation') }}" method="POST">
                <input id='type_op' name="type_op" type="hidden" value="">
                <input id='client_id' name="client_id" type="hidden" value="{{ $client->id }}">
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
                            <textarea rows="2" name="comments"
                                      placeholder="Комментарий">Зачисление аванса за заказ №{{ $order->id }}</textarea>
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

@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}
@endsection


@section('script')
    <script>

        function status(status) {

            let id = $('#order_id').val();

            $.ajax({
                url: "{{ route('change_status') }}",
                type: 'POST',
                data: {
                    id: id,
                    status: status,

                },

                beforeSend: function () {

                },
                success: function (response) {

                },
            });
        }
        $('.menu .item').tab();

        var start = moment($('#form_time').val());
        $('#date').val(start.format('DD MMM H:mm'));

        $(function () {
            $('#date').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 15,
                    timePicker12Hour: false,
                    drops: 'up',
                    format: 'DD MMM H:mm',
                    singleDatePicker: true,
                    locale: {
                        firstDay: 1,
                    },
                },
                function (start, end, label) {
                    $('#date').val(start.format('DD MMM H:mm'));
                    $('#form_time').val(start.format('YYYY-MM-DD H:mm'));
                });
        });


        $('#type_operation').on('change', function () {

            if (this.value == '1') {
                $("#delivery_from").show('fast');
                console.log('2');

            }
            else {
                console.log('1');
                $("#delivery_from").hide('fast');
            }
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


