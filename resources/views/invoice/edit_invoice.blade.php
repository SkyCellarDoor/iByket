@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')
    <div class="ui grid segment" style="height: 67px;">
        <div class="ui thirteen wide column">
            <select id="search_good" class="ui fluid" style="width:100%;">

            </select>
        </div>
        <div class="ui three wide column">
            <button id="add_good" class='ui fluid button teal'>Добавить&nbsp;наименование</button>
        </div>
    </div>
    <form action="{{ route('invoice_complete') }}" method="post">
        {{ csrf_field() }}
        <div class="ui top attached menu" style="height: 48px;">
            <div class="item">&nbsp;Накладная № {{ $invoice->id }}</div>
            <input id="invoice_id" type="hidden" name="invoice_id" value="{{ $invoice->id }}">
            <div class="item">Поставщик&nbsp;<b> {{ $invoice->user_provider_model->providers_model->company }}</b></div>
            <input type="hidden" name="provider_id" value="{{ $invoice->provider_id }}">
            <div class="item">
                <div id="use_bill" class="ui checkbox">
                    <input type="checkbox" checked>
                    <label>Использовать счет</label>
                    <input id="use_bill_input" name="use_bill" type="hidden" value="0">
                </div>
            </div>
            <div id="bill_div" class="item" style="padding: 4px; display: none;">
                <select name="bill_id" class="ui mini dropdown">
                    <option value="">Выберите счет</option>
                    @foreach($bills as $bill)
                        <option value="{{ $bill->id }}">{{ $bill->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="ui bottom attached segment">
            <div class="ui grid">
                <div class="ui twelve wide column">
                    <div id="loader" class="ui segment" style="min-height: 200px;">
                        <table id="result_table" class="ui very basic celled table fluid" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Товар</th>
                                <th colspan="2">Количество</th>
                                <th colspan="2">Цена</th>
                                <th style="width: 33px;">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
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
                                        <input id="all_summ_input" name="sum" type="hidden" value="">
                                    </div>
                                    <div class="label">
                                        руб.
                                    </div>
                                </div>
                            </span>
                            </div>
                        </div>

                        <div class="extra content">
                            <div class="ui checkbox">
                                <input type="checkbox" name="fun">
                                <label>Выставить цены</label>
                            </div>
                            <span class="right floated">
                            <input type="submit" id="complete" class="ui green button" value="Принять">
                        </span>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div id="add_good_modal" class="ui modal">
        <i class="close icon"></i>
        <div class="header">
            Добавление нового наменования
        </div>

        <div class="content">
            <form id="add_good_form" class="ui form">
                <div class="ui error small message"></div>
                <div id="exist" class="ui info small hidden message">
                    <ul>
                        <li>Уже существует</li>
                    </ul>
                </div>
                <div class="fields">
                    <div id="name_check" class="four wide field">
                        <label>Название</label>
                        <input id="name" name="name" type="text">
                    </div>
                    <div class="field" style="margin-top: 30px;">
                        <span><i class="cube grey icon"></i></span>
                    </div>
                    <div id="one_consist_check" class="field">
                        <label>Единицы измерения</label>
                        <select id="one_consist" class="ui dropdown" name="one_consist">
                            <option value="">Одна единица</option>
                            @foreach($type_consist as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field" style="margin-top: 30px;">
                        <div class="ui checkbox" id="consist_status">
                            <input type="checkbox" name="consist">
                            <label>Составной</label>
                            <input type="hidden" id="consist_status" value="0">
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>Описание</label>
                    <textarea id="description" rows="2"></textarea>
                </div>
                <div id="consist_many" class="fields" style="display: none;">
                    <div class="field" style="margin-top: 10px;">
                        <span><i class="cube grey icon"></i></span>
                        <span><i class="arrow right grey icon"></i></span>
                        <span><i class="cubes grey icon"></i></span>
                    </div>
                    <div class="two wide field">
                        <input name="default_consist_amount" type="number">
                    </div>
                    <div class="field">
                        <select id="many_consist" name="many_consist" class="ui dropdown">
                            <option value="">Состоит</option>
                            @foreach($type_consist as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

        </div>
        <div class="actions">
            <div class="ui cancel button">
                Отмена
            </div>
            <button id="add_good_done" class="ui submit teal button">
                Добавить
            </button>
        </div>
        </form>
    </div>


@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}
@endsection

<style type="text/css">
    .select2-container .select2-selection--single {
        min-height: 36px;
    }

    .select2-container .select2-selection__arrow {
        top: 4px !important;
        right: 5px !important;
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

@section('script')
    <script>

        function formatResult(item) {

            if (item.loading) return item.text;

            if (item.data == null) {
                item.data = 'Без описания'
            }

            var html =
                '<div class="ui label"><span>' +
                item.text
                + '</span><div class="detail">' +
                item.data
                + '</div></div>';
            return $(html);
        };


        $("#search_good").select2({
            "language": {
                "noResults": function () {
                    return "<span>Товар не найден</span>";
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
                url: "/search/good/",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function (data) {

                    return {
                        results: $.map(data.items, function (item) {
//                            return console.log(item);
                            return {
                                text: item.name,
                                id: item.id,
                                data: item.description,
                                value: item.amount,
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

        $("#search_good").on("select2:select", function () {


            var id = $("#search_good").val();
            table_body(id);

        });

        function table_body(id) {

            var invoice_id = $('#invoice_id').val();

            $.ajax({
                url: "{{ route('add_item') }}",
                type: 'POST',
                data: {
                    invoice_id: invoice_id,
                    id: id,
                },
                datatype: "json",
                beforeSend: function () {

                },
                success: function (response) {
                    $('tbody').append(response);

                },
            });
        }


        $('#add_good_done').on('click', function () {

            var name = $('#name').val();
            var description = $('#description').val();
            var consist = $('#consist_status').val();
            var one_name_id = $('#one_consist').val();
            var many_name_id = $('#many_consist').val();

            $.ajax({
                url: "{{ route('add_item') }}",
                type: 'POST',
                data: {
                    name: name,
                    description: description,
                    consist: consist,
                    one_name_id: one_name_id,
                    many_name_id: many_name_id,
                },

                beforeSend: function () {

                    var _form = $('#add_good_form');

                    if (consist == 0) {

                        _form.form({
                            name: {
                                identifier: 'name',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Введите название'
                                    }

                                ]
                            },
                            one_consist: {
                                identifier: 'one_consist',
                                rules: [
                                    {
                                        type: 'minCount[1]',
                                        prompt: 'Выберите единицу измерения'
                                    }

                                ]
                            },
                        });
                    }

                    else {
                        _form.form({
                            name: {
                                identifier: 'name',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Введите название'
                                    }

                                ]
                            },
                            one_consist: {
                                identifier: 'one_consist',
                                rules: [
                                    {
                                        type: 'minCount[1]',
                                        prompt: 'Выберите единицу измерения'
                                    }

                                ]
                            },
                            many_consist: {
                                identifier: 'many_consist',
                                rules: [
                                    {
                                        type: 'minCount[1]',
                                        prompt: 'Выберите единицу измерения состава'
                                    }

                                ]
                            },
                        });
                    }

                    _form.submit(function () {
                        return false;
                    });
                    return _form.form('is valid');

                },
                success: function (response) {
                    var exist = $('#exist');

                    if (response == 'stop') {

                        exist.removeClass('hidden');
                        exist.addClass('visible');

                        return false;
                    }

                    $('#add_good_modal').modal('hide');
                    $('tbody').append(response);
                    $('#name').val('');
                    $('#description').val('');
                    ar
                    $('#many_consist').dropdown('clear');
                    exist.removeClass('visible');
                    exist.addClass('hidden');

                },
            });

        });


        //подсчет сумм

        $('body').on('input', '.input_area', function () {
            count_sum();
        });

        function count_sum() {
            var sum = 0;

            if ($('.input_area').length == 0) {
                $('#all_summ').text('0.00');
                $('#all_summ_input').val(0);

            }

            $('.id_product').each(function () {

                var id = $(this).data('id');


                sum = parseFloat(sum) + parseFloat($('#count_' + id).val()) * parseFloat($('#price_' + id).val());


                if (isNaN(sum)) {
                    sum = 0;
                }

                if ($('#count_many_' + id).length) {


                    var count_many = parseFloat($('#price_' + id).val()) / parseFloat($('#count_many_' + id).val());

                    $('#price_many_' + id).val(count_many.toFixed(2));

                }


                $('#all_summ').text(sum.toFixed(2));
                $('#all_summ_input').val(sum.toFixed(2));
            });
        }


        // модальное окно добавления наименования
        $('#add_good').on('click', function () {
            $('#add_good_modal').modal('refresh');

            $('#add_good_modal').modal('show');

            $('#consist_status').checkbox({

                onChecked: function () {

                    $('#consist_many').show('fast');
                    $('#consist_status').val('1');
                },
                onUnchecked: function () {

                    $('#consist_many').hide('fast');
                    $('#consist_status').val('0');

                },
            });
        });

        $('#use_bill').checkbox({

            onChecked: function () {

                $('#bill_div').hide('fast');
                $('#use_bill_input').val('0');
            },
            onUnchecked: function () {

                $('#bill_div').show('fast');
                $('#use_bill_input').val('1');

            },
        });

        //удаление товара
        $('body').on('click', '.del', function () {

            var id = $(this).data('del');
            $('#tr_' + id).remove();
            count_sum();
        });
    </script>
@endsection


