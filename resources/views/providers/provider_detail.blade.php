@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.css"
          rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="ui top attached menu">
        @if ($provider->providers_model->type == 2)
            <div class="item">ООО "<b>{{ $provider->providers_model->company }}</b>"</div>

        @else
            <div class="item">ИП "<b>{{ $provider->providers_model->company }}</b>"</div>

        @endif


        <a id="add" class="item">
            <i class="plus green icon"></i>
            Поступление товара
        </a>

        <div class="right menu">
            <a class="item" data-type="1" href="#fin_modal" onclick="new_fin($(this).attr('data-type'))"> <i
                        class="minus icon red "></i></a>
            <div class="item">
                @if ( $provider->bill < 0 )
                    <div class="ui red mini horizontal statistic">
                        <div class="value">
                            {{ $provider->bill }}
                        </div>
                        <div class="label">
                            руб.
                        </div>
                    </div>
                @elseif( $provider->bill > 0 )
                    <div class="ui green mini horizontal statistic">
                        <div class="value">
                            {{ $provider->bill }}
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
        <table id="invoice" class="ui compact selectable celled table">
            <thead>
            <tr>
                <th class="collapsing">№</th>
                <th>Дата прихода товара</th>
                <th>Дата создания накладной</th>
                <th class="collapsing">Сумма</th>

            </tr>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>
                        <a href="{{ route('invoice_detail') }}/{{ $invoice->id }}">{{ $invoice->id }}
                    </td>
                    <td nowrap>{{ $invoice->real_date }}</td>

                    <td nowrap>{{ $invoice->created_at }}</td>
                    <td nowrap>{{ $invoice->summa }} p.</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{--Модальное окно финасовых операций --}}

    <div id="fin_modal" class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            <span id="type_name"></span>
        </div>
        <div class="content">
            <form id="form_move_money" class="ui form" action="{{ route('fin_op_provider') }}" method="POST">
                {{ csrf_field() }}

                <input id='type_op' name="type_op" type="hidden" value="">
                <input id='client_id' name="client_id" type="hidden" value="{{ $provider->id }}">
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

    {{--Модальное окно новой накладной--}}

    <div id="add_modal" class="ui small modal">

        <i class="close icon"></i>
        <div class="header">
            Header
        </div>

        <div class="content">
            <form action="{{ route('invoice_create') }}" method="post">
                {{ csrf_field() }}
                <div class="ui form">
                    <div class="three fields">
                        <div class="field">
                            <label>Поставщик</label>
                            <div class="ui input">
                                <input value="{{ $provider->providers_model->company }}" readonly>
                                <input type="hidden" name="provider" value="{{ $provider->id }}" readonly>
                            </div>
                        </div>
                        <div class="field">
                            <label>Дата поступления</label>
                            <div class="ui input">
                                <input type="text" name="real_date" value=""/>
                                <input type="hidden" name="bill_use" value="1"/>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="actions">
            <div class="ui cancel black button">
                Cancel
            </div>
            <input type="submit" class="ui ok teal button" value="Продолжить">

            </form>
        </div>
    </div>


@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.js"></script>
@endsection


@section('script')
    <script>

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


