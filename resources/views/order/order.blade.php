@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')
    <form action="{{ route('create_order') }}" method="post">
        {{ csrf_field() }}
        <div class="ui top attached menu">

            <div class="item">&nbsp;Новый заказ</div>
            <div class="item">
                <div id="delivery" class="ui checkbox">
                    <input type="checkbox">
                    <label class="ui right floated">Доставка</label>
                    <input id="delivery_status" type="hidden" name="delivery" value="0">
                </div>
            </div>
        </div>


        <div class="ui bottom attached segment">
            <div class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segment">
                        <div class="ui grid">
                            <div class="ui sixteen wide column">

                                <div class="ui form">

                                    <input name="client_id" type="hidden" value="{{ $client->id }}">

                                    <div class="field">
                                        <label>Описание заказа</label>
                                        <textarea name="comment"></textarea>
                                    </div>

                                    <div class="field">
                                        <label>Картинка</label>
                                        <div class="ui action input">
                                            <input type="text" readonly>
                                            <input type="file" style="display: none;">
                                            <div class="ui icon button">
                                                <i class="cloud upload icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fields">
                                        <div class="field">
                                            <label><span id="delivery_type_text">Время&nbsp;самовывоза</span></label>
                                            <div class="ui input left icon">
                                                <i class="calendar icon"></i>
                                                <input name="date_delivery" type="text" placeholder="Время">
                                            </div>
                                        </div>
                                        <div id="address" class="fourteen wide column field" style="display: none;">
                                            <label>Адрес доставки</label>
                                            <input id="address_delivery" type="text" name="address_delivery">
                                        </div>
                                    </div>

                                    <div id="other_delivery" style="display: none;">
                                        <div class="fields">
                                            <div class="field">
                                                <label>Тип оплаты</label>
                                                <select id="type_operation" name="type_order_pay" class="ui dropdown">
                                                    <option value="1" selected>Наличные</option>
                                                    <option value="2">Терминал</option>
                                                </select>
                                            </div>
                                            <div id="delivery_from" class="field">
                                                <label>Сдача с </label>
                                                <input name="delivery_from" type="text">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label>Комментарий для курьера</label>
                                            <textarea name="comment_courier" rows="2"></textarea>
                                        </div>
                                    </div>

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
                                            <a><i class="plus icon"></i></a>
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
                                             +7 {{ $client->phone }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="event">
                                    <div class="content">
                                        <div class="summary">
                                            <span class="right floated">
                                              <i class="calendar blue icon"></i>
                                             10.09.2017
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="ui small feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="extra text">
                                            <a class="ui icon" data-position="right center">
                                                Заказ №21
                                            </a>
                                            <div class="ui fluid popup">
                                                <div class="ui two column grid">
                                                    <div class="column">
                                                        <h4 class="ui header">Заказ №21</h4>
                                                        <div class="ui link list">
                                                            <a class="item">Cashmere</a>
                                                            <a class="item">Linen</a>
                                                            <a class="item">Cotton</a>
                                                            <a class="item">Viscose</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            на адрес: <a><span class="address">ул. Тельмана д.47б - 8</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="extra content">
                        <span class="left floated calculator">
                          <i class="calculator icon"></i>
                          2023 р.
                        </span>
                            <span class="right floated percent">
                                <span>5</span>
                                 <i class="percent icon"></i>
                            </span>
                        </div>
                        <div class="extra content">
                            <div class="field">
                                <input class="ui button green right floated" type="submit" value="Создать">
                            </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
@endsection


@section('script')
    <script>

        $(function () {
            $('input[name="date_delivery"]').daterangepicker({
                timePicker: true,
                timePickerIncrement: 15,
                timePicker12Hour: false,
                drops: 'up',
                format: 'DD-MM-YYYY H:mm',
                "singleDatePicker": true,
                locale: {
                    firstDay: 1,
                }
            });
        });

        $('a').popup();

        $('#delivery').checkbox({

            onChecked: function () {

                $('#delivery_type_text').text('Время доставки');
                $('#address').show('fast');
                $('#other_delivery').show('fast');
                $('#delivery_status').val('1');
            },
            onUnchecked: function () {
                $('#delivery_type_text').text('Время самовывоза');

                $('#address').hide('fast');
                $('#other_delivery').hide('fast');
                $('#delivery_status').val('0');

            },

        });

        $('#type_operation').on('change', function () {
            if (this.value == 'cash') {
                $("#delivery_from").show('fast');
            }
            else {
                $("#delivery_from").hide('fast');
            }
        });

        $('input:text, .ui.button', '.ui.action.input')
            .on('click', function (e) {
                $('input:file', $(e.target).parents()).click();
            });

        $('input:file', '.ui.action.input')
            .on('change', function (e) {
                var name = e.target.files[0].name;
                $('input:text', $(e.target).parent()).val(name);
            });

        $('.address').on('click', function () {
            $('#address_delivery').val($(this).text());
        })

    </script>
@endsection

