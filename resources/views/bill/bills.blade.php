@extends('skyapp.index')

@section('page_css')

@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="ui top attached menu">
        <div class="item">&nbsp;Счета</div>
        <div class="right menu">
            <div class="ui right dropdown item">
                Чтонибудь сделать
                <i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item">1</div>
                    <div class="item">1</div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui bottom attached segment">

        <div class="ui top attached tabular menu ">
            <a class="item active " data-tab="first">Список счетов</a>
            <a class="item" data-tab="second">Итория операций</a>
        </div>
        <div class="ui bottom attached tab segment active " data-tab="first">


            <table class="ui selectable celled table">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Принадлежность</th>
                    <th>Описание</th>
                    <th>Сумма</th>
                    <th>Операции</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $bills as $bill)
                    <tr>
                        <td>
                            <a href="{{ route('bill_detail') }}/{{ $bill->id }}"> {{ $bill->name }}</a>
                        </td>
                        <td>
                            @if( $bill->storage_model->id == 0)
                                Сервисный счет
                            @else
                                {{ $bill->storage_model->name }}
                            @endif
                        </td>
                        <td>
                            {{ $bill->description }}
                        </td>
                        <td>
                            <b>{{ $bill_sum[$bill->id] }}</b> р.
                        </td>
                        <td>
                            <a class="btn green" data-id="{{ $bill->id }}" data-value-max="{{ $bill_sum[$bill->id] }}"
                               data-toggle="modal" href="#move_money"
                               onclick="add_value($(this).attr('data-id'), $(this).attr('data-value-max'))">
                                Перевести
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="ui bottom attached tab segment" data-tab="second">
            <table class="ui selectable celled table">
                <thead>
                <tr>
                    <th>Принадлежность</th>
                    <th>Откуда</th>
                    <th>Куда</th>
                    <th>Сумма</th>
                    <th>Коментарии</th>
                    <th>Операции</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

    {{--модальное окно--}}

    <div id="move_money" class="ui modal">
        <i class="close icon"></i>
        <div class="header">
            Новый Расход
        </div>
        <div class="content">
            <form id="form_move_money" class="ui form" action="{{ route('cash_operation_bill') }}" method="POST">
                <input id='bill_from' name="bill_from" type="hidden" value="">

                {{ csrf_field() }}
                <div class="ui grid">
                    <div class="five wide column field">
                        <div class="ui right labeled input ">
                            <input style="width:140px;" id='cash_value' name="value" value="" type="number" min="1"
                                   max="" placeholder="Сумма">
                            <div class="ui label">
                                Макс: <span id="max"></span> p.
                            </div>

                        </div>
                    </div>
                    <div class="six wide column ">
                        <select id="bills" class="dropdown field" name="bill_to" title="Куда перевести">
                            <option value="">Куда</option>
                            @foreach( $bills as $bill)
                                <option value="{{ $bill->id }}"
                                        data-icon="fa fa-{{ $bill->image }}">{{ $bill->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <div class="ui form">
                            <div class="field">
                                <textarea rows="2" name="comments" placeholder="Комментарий"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui error message prompt "></div>
        </div>
        <div class="actions">
            <input type="submit" class="ui black deny button" value="Отмена" onclick="event.preventDefault();">
            <input type="submit" class="ui ok green button">
            </form>
        </div>
    </div>

    {{--конец модального окно--}}
@endsection


@section('page_scripts')

@endsection


@section('script')
    <script>
        $('.menu .item').tab();

        $(".dropdown").dropdown();

        function add_value(id, value_max) {


            $("#move_money").modal('show');

            $("#move_money").modal({
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
                                    identifier: 'bill_to',
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

            //console.log(value_max);
            $("#move_money #cash_value").prop("max", value_max);
            $("#move_money #max").text(value_max);
            $("#move_money #bill_from").val(id);


            $("#move_money .item[data-value]").removeClass('disabled');
            $("#move_money .item[data-value=" + id + "]").addClass('disabled');
            $("#move_money #bills").dropdown('refresh');

        }

    </script>
@endsection


