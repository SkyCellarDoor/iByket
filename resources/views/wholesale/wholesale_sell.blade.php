@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui grid">
        <div class="ui sixteen wide column">
            <div class="ui segment" style="height: 67px;">
                <select id="search" class="" style="width:100%;">

                </select>
            </div>
        </div>
    </div>
    <form id="send_data" action="{{ route('complete_wholesale') }}" method="post" class="ui form">
        {{ csrf_field() }}
        <div class="ui top attached menu" style="height: 48px;">

            <div class="item">
                &nbsp;Новая продажа
            </div>
            @if( $client == NULL)
                <div class=" item">
                    Без клиента
                    <input name="client_id" type="hidden" value="">
                </div>
            @else
                <div class="item">
                    <a href="{{ route('opt_client_detail') }}/{{ $client->id }}"
                       target="_blank">{{ $client->wholesales_model->company }}</a>
                    @if($client->bill >= 0)
                        <div class="floating ui green label">{{ $client->bill }}&nbsp;р.</div>
                    @else
                        <div class="floating ui red label">{{ $client->bill }}&nbsp;р.</div>
                    @endif
                    <input id="client_value_bill" type="hidden" value="{{ $client->bill }}">
                    <input name="client_id" type="hidden" value="{{ $client->id }}">
                </div>
                <div class="item">
                    <div id="use_bill" class="ui checkbox">
                        <label>Использовать счет</label>
                        <input type="checkbox">
                    </div>
                </div>

            @endif
            <input id="use_bill_input" type="hidden" name="use_bill" value="0">

            <a id="bill_div" class="item" style="padding: 4px;">
                <div class="field">
                    <select id="list_bills" name="bill_id" class="ui mini dropdown bill">
                        <option value="">Выберите счет</option>
                        @foreach($bills as $bill)
                            <option value="{{ $bill->id }}">{{ $bill->name }}</option>
                        @endforeach
                    </select>
                </div>
            </a>
            <input id="cash" type="hidden" value="{{ $cash->id }}">
            <div class="item right">
                <div id="discount_checkbox" class="ui checkbox">
                    <input type="checkbox">
                    <label>Скидка</label>
                    <input type="hidden" value="0">
                </div>
            </div>
        </div>
        <div class="ui bottom attached segment">
            <div class="ui grid">
                <div class="ui twelve wide column">


                    <div id="loader" class="ui segment" style="min-height: 200px;">
                        <table id="result" class="ui fluid very basic collapsing celled table" style="width: 100%">
                            <thead>
                            <tr>
                                <th style="width:40%;">
                                    Товар
                                </th>
                                <th style="width:10%;">Количество</th>
                                <th style="width:10%;">Цена</th>
                                <th class="left aligned" style="width:5%;">Сумма&nbsp;позиции</th>
                                <th class="left aligned" style="width:3%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="ui four wide column">
                    <div class="ui centered card" style="width: 100%;">
                        <div class="content">
                            <div class="summary">
                            <span class="right floated">
                                    <div class="ui horizontal statistic">
                                    <div class="value">
                                        <span id="all_summ">0.00</span>
                                    </div>
                                        <input id="all_summ_input" name="sum" type="hidden" value="">
                                    <div class="label">
                                        руб.
                                    </div>
                                </div>
                            </span>
                            </div>
                        </div>
                        <div id="discount_div" class="content" style="display: none;">
                            <div class="ui small feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="extra text">
                                            <div class="ui tiny form">
                                                <div class="five wide inline field">
                                                    <label>Cкидка</label>
                                                    <div class="ui icon input">
                                                        <input id="promotion_sum" value="" name="promotion_sum" min="0"
                                                               max="100" type="number">
                                                        <i class="percent icon"></i>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <select class="ui mini dropdown">
                                                        <option value="">Выберите акцию</option>
                                                    </select>
                                                </div>
                                                <div class="field">
                                                    <label>Причина скидки <br/>
                                                        <a class="ui tiny red label">Карта</a>
                                                        <a class="ui tiny green label">Количесво</a>
                                                    </label>
                                                    <textarea rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="add_puy" class="content" style="display: none;">
                            <div class="ui form">
                                <div class="field">
                                    <label>Доплата на счет (<span id="span_add_puy" class="ui red">0.00</span>
                                        p.)</label>
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label>Доплата</label>
                                        <input name="add_puy_to_client" value="">
                                    </div>
                                </div>
                                <div class="field">
                                    <select id="list_bills_add" name="add_bill_id" class="ui mini dropdown bill">
                                        <option value="">Выберите счет</option>
                                        @foreach($bills as $bill)
                                            <option value="{{ $bill->id }}">{{ $bill->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="keep_change" class="content" style="display: none;">
                            <div class="two fields">
                                <div class="field">
                                    <label>Сумма клиента</label>
                                    <input id="client_cash" type="text" value="">
                                </div>
                                <div class="ui right floated field">
                                    <label>Сдача</label>
                                    <span id="client_change" class="ui right floated">0 p.</span>
                                </div>
                            </div>
                        </div>
                        <div class="extra content">
                        <span class="right floated">
                            <input id="complete" class="ui green tiny  button" type="submit" value="Оформить">
                        </span>

    </form>
    </div>
    </div>
    </div>
    </div>
    </div>

    <style type="text/css">
        .select2-container .select2-selection--single {
            min-height: 36px;
        }

        .select2-container .select2-search__field {
            min-height: 36px;
        }

        .select2-container .select2-selection__rendered {
            padding-top: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 5px;
            right: 6px;
        }

        .select2-results {
            max-height: 200px;
        }

        .select2-choices {
            min-height: 150px;
            max-height: 150px;
            overflow-y: auto;
        }
    </style>
@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}


@endsection
<style>

    .ui.table td .td_price {
        padding: 0 !important;
        text-align: inherit;
    }

</style>

@section('script')
    <script>
        count_sum();

        function formatResult(item) {
            if (item.loading) return item.text;
            if (item.consist == 0) {

                var html =
                    '<div class="ui green label">' +
                    '<span>' +
                    item.text +
                    '</span>' +
                    '<div class="detail">' +
                    item.date +
                    '</div>' +
                    '</div>' +
                    '<div class="ui blue label">' +
                    item.amount + '&nbsp;' + item.consist_name_one + '.' +
                    '<div class="detail">' +
                    item.price + '&nbsp;p.' +
                    '</div>' +
                    '</div>';

                return $(html);

            }
            else {
                var html =
                    '<div class="ui green label">' +
                    '<span>' +
                    item.text +
                    '</span>' +
                    '<div class="detail">' +
                    item.date +
                    '</div>' +
                    '</div>' +
                    '<div class="ui blue label">' +
                    item.amount + '&nbsp;' + item.consist_name_one + '.&nbsp;&nbsp;' + item.consist_amount + '/' + item.consist_amount_was + '&nbsp;' + item.consist_name_many + '.' +
                    '<div class="detail">' +
                    item.price + '&nbsp;p.' +
                    '</div>' +
                    '</div>';

                return $(html);
            }

        };

        $("#search").select2({
            "language": {
                "noResults": function () {
                    return "Не найдено";
                },
                "searching": function () {
                    return "Поиск...";
                },
                "inputTooShort": function (args) {
                    var remainingChars = args.minimum - args.input.length;
                    return 'Введите более ' + remainingChars + ' символов';
                },
            },
            ajax: {
                url: "/search/product_wholesale/",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {

                    return {
                        results: $.map(data.items, function (item) {

                            return {
                                text: item.name,
                                id: item.id,
                                date: item.created_at,
                                amount: item.amount,
                                consist_amount: item.consist_amount,
                                consist_name_one: item.consist_name_one,
                                consist_name_many: item.consist_name_many,
                                consist_amount_was: item.consist_amount_was,
                                consist: item.consist,
                                price: item.price,
                            }
                        })
                    };
                },

                cache: false
            },
            escapeMarkup: function (m) {
                return m;
            },
            templateResult: formatResult,
            templateSelection: formatResult,

            minimumInputLength: 2,
        });

        function add_item_sell(id) {

            $.ajax({
                url: "{{ route('wholesale_add_item_sell') }}",
                type: 'POST',
                data: {
                    id: id,
                },
                beforeSend: function () {

                },
                success: function (response) {
                    $('tbody').append(response);
                    count_sum_row();
                    count_sum();
                    client_change_count();


                    $('#popup_test')
                        .popup({
                            on: 'hover',
                            target: '#popup_test',
                            inline: true,
                        });
                },
            });
        }

        $("#search").on("select2:select", function () {

            var id = $("#search").val();
            add_item_sell(id);
        });

        $('body').on('input', '.area_input', function () {
            count_sum_row();
            count_sum();
            client_change_count();


        });

        $(document).on('click', '.remove', function () {

            let id = $(this).data('id');
            $('#tr_' + id).remove();
            count_sum_row();
            count_sum();
            client_change_count();


        });

        $('#promotion_sum').on('input', function () {

            let percent = $(this).val();

            $('.price').each(function () {

                let id = $(this).data('id');
                let default_price = $('#default_price_' + id).val();
                $(this).val(default_price);
                $('#span_price_' + id).text(default_price);
                let price = $(this).val();
                let new_price = parseFloat(price - (price * (percent / 100))).toFixed(2);
                $(this).val(new_price);
                $('#span_price_' + id).text(new_price);

            });
            count_sum_row();
            count_sum();
            client_change_count();

        });

        function count_sum() {

            if ($('.sum').length == 0) {

                $("#all_summ").text('0.00');
                $("#all_summ_input").val('');
                $('#complete').attr('disabled', 'disabled');
            }
            else {
                $('#complete').removeAttr('disabled');
                let all_summa = 0;

                $('.sum').each(function () {

                    all_summa += parseFloat($(this).val());
                    $("#all_summ").text(all_summa.toFixed(2));
                    $("#all_summ_input").val(all_summa.toFixed(2));


                    // сумма доплаты клиента
                    let add_puy = all_summa - $('#client_value_bill').val();
                    if (add_puy >= 0) {
                        $('#span_add_puy').text(add_puy.toFixed(2));
                    }
                    else {
                        $('#span_add_puy').text('0.00');
                    }

                });
            }
        }

        function count_sum_row() {

            $('.area_input').each(function () {
                let id = $(this).data('id');
                let sum = parseFloat(parseFloat($('#count_' + id).val()) * parseFloat($('#price_' + id).val())).toFixed(2);

                if (isNaN(sum)) {
                    sum = '0.00';
                }

                $('#span_sum_' + id).text(sum + ' p.');
                $('#sum_' + id).val(sum);

            });
        }

        $('#discount_checkbox').checkbox({

            onChecked: function () {

                $('#discount_div').show('fast');
//                $('#consist_status').val('1');
            },
            onUnchecked: function () {

                $('#discount_div').hide('fast');
//                $('#consist_status').val('0');

            },
        });

        var rule = {
            fields: {
                bill_id: {
                    identifier: 'bill_id',
                    rules: [
                        {
                            type: 'minCount[1]',
                        }
                    ]
                },
            }
        };

        $('#use_bill').checkbox({

            onChecked: function () {

                $('#bill_div').hide('fast');
                $('#add_puy').show('fast');
                $('#use_bill_input').val('1');
                $('.dropdown').dropdown('clear');

                var rule = {
                    fields: {
                        add_bill_id: {
                            identifier: 'add_bill_id',
                            rules: [
                                {
                                    type: 'minCount[1]',
                                }
                            ]
                        },
                    }
                };
                console.log(rule);
            },
            onUnchecked: function () {

                $('#bill_div').show('fast');
                $('#add_puy').hide('fast');
                $('#use_bill_input').val('0');
                $('.dropdown').dropdown('clear');

                var rule = {
                    fields: {
                        bill_id: {
                            identifier: 'bill_id',
                            rules: [
                                {
                                    type: 'minCount[1]',
                                }
                            ]
                        },
                    }
                };
                console.log(rule);

            },
        });

        $('#client_cash').on('input', function () {
            client_change_count()
        });

        function client_change_count() {
            let sum_buy = parseFloat($('#all_summ_input').val());
            let cash = parseFloat($('#client_cash').val());
            let result = 0;

            if (cash > sum_buy) {
                result = cash - sum_buy;
            }


            $('#client_change').text(result.toFixed(2) + ' p.');


        }

        $('.bill').dropdown({
            onChange: function (val) {
                if (val == $('#cash').val()) {
                    $('#keep_change').show('fast');
                }
                else {
                    $('#keep_change').hide('fast');
                }
            }
        });

        //        $('#send_data').form(rule, console.log(rule));

        $('#complete').on('click', function () {
            if ($('#use_bill_input').val() == 0) {
                $('#send_data').form({
                    fields: {
                        bill_id: {
                            identifier: 'bill_id',
                            rules: [
                                {
                                    type: 'minCount[1]',
                                }
                            ]
                        },
                    }
                });
            }
            else {
                $('#send_data').form({
                    fields: {
                        add_bill_id: {
                            identifier: 'add_bill_id',
                            rules: [
                                {
                                    type: 'minCount[1]',
                                }
                            ]
                        },
                        add_puy_to_client: {
                            identifier: 'add_puy_to_client',
                            rules: [
                                {
                                    type: 'empty',
                                }
                            ]
                        },
                    }
                });
            }
        });

    </script>
@endsection


