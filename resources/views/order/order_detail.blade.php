@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top grey five item inverted  menu">
        <div class="item">&nbsp;Заказ № {{ $order->id }}</div>
        @if ( $order->type == 1)
            <div class="item">Доставка</div>
            <div class="item selectable warning">Время:&nbsp;<b>{{ $order-> time_delivery }}</b></div>
            <div class="item">Куда:&nbsp;<b>{{ $order-> address_model->address }}</b></div>
            @if ($order->type_delivery == 1 && $order->from_delivery != NULL)
                <div class="item">Оплата:&nbsp;<b>Наличные</b>&nbsp;(cдача с {{ $order->from_delivery }})</div>
            @elseif($order->type_delivery == 1)
                <div class="item">Оплата:&nbsp;<b>Наличные</b></div>
            @else
                <div class="item">Оплата:&nbsp;<b>Терминал</b></div>
            @endif
        @else
            <div class="item teal">Самовывоз</div>
            <div class="item">Время:&nbsp;<b>{{ $order-> time_delivery }}</b></div>
        @endif
    </div>

    <div class="ui bottom attached segment">

        <div class="ui top attached tabular menu ">
            <a class="item active " data-tab="first">Описание</a>
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
                                        <textarea name="comment"> {{ $order->comments }}</textarea>
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
                                    @if ( $order->type == 1)
                                        <div id="other_delivery">
                                            <div class="fields">
                                                <div class="field">
                                                    <label>Тип оплаты</label>
                                                    <select id="type_operation" name="type_order_pay"
                                                            class="ui dropdown">
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
                                <input class="ui button green right floated" type="submit" value="Сохранить">
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
                        <td>{{ $status->user_id }}</td>
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
    </script>
@endsection


