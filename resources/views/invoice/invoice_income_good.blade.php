@extends('skyapp.index')


@section('page_css')

    <link href="{{ asset("assets/") }}/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/") }}/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet"
          type="text/css"/>

@endsection


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" id="cost_unit" value="{{ $cost_unit[0] }}">
    <input type="hidden" id="cost_delivery" value="{{ $invoice[0] }}">
    <input type="hidden" name="hidden_add" id="hidden_add" value="{{ route('invoice_create_goods') }}">
    <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{ route('invoice_delete_goods') }}">
    <input type="hidden" name="hidden_update" id="hidden_update" value="{{ route('invoice_update_goods') }}">
    <input type="hidden" name="hidden_update_end" id="hidden_update_end"
           value="{{ route('invoice_update_goods_end') }}">
    <input type="hidden" name="hidden_end" id="hidden_end" value="{{ route('invoice_end') }}">
    <input type="hidden" name="hidden_invoice" id="hidden_invoice" value="{{ route('invoice_list') }}">
    <input type="hidden" name="id_invoice" id="id_invoice" value="{{ $id }}">

    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box blue-dark">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa"></i>Новая накладная
            </div>
            <div class="actions">
                <a href="javascript:;" class="btn btn-default btn-sm">
                    <i class="fa fa-plus"></i> Добавить тип товара </a>
            </div>
        </div>
        <div class="portlet-body">
            <div id="sample_3_wrapper" class="dataTables_wrapper footer">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div id="sample_3_filter" class="dataTables_filter">
                            <div class="actions">
                                <a href="javascript:;" class="btn btn-default btn-sm">
                                    <i class="fa fa-money"></i> {{ $cost_unit[0] }} </a>
                                <a href="javascript:;" class="btn btn-default btn-sm">
                                    <i class="fa fa-bus"></i> {{ $invoice[0] }} </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover order-column dataTable" role="grid">
                        <thead>
                        <tr role="row">
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 200px;">
                                <small>Товар</small>
                            </th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">
                                <small> Количесво</small>
                            </th>
                            <th class="sorting_disabled" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1"
                                style="width: 77px;">
                                <small> Стоимость (у.е)</small>
                            </th>
                            <th class="sorting_disabled" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1"
                                style="width: 77px;">
                                <small> Стоимость в рублях</small>
                            </th>
                            <th class="sorting_disabled" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1"
                                style="width: 50px;">
                                <small> Стоимость с доставкой</small>
                            </th>
                            <th class="sorting_disabled" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1"
                                style="width: 20px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goods as $x)
                            <tr class="gradeX odd" role="row" id="tr_id{{ $x -> id }}" name="{{ $x -> id }}">
                                <td>
                                    <select id="good_name_id{{ $x -> id }}" class="select2-allow-clear"
                                            onchange="update_data('{{$x -> id}}')">
                                        <option value="0" selected disabled>Выберите Товар</option>
                                        @foreach($goods_name as $y)
                                            @if( $y->id == $x->good_id)
                                                <option selected value="{{ $y -> id }}">{{ $y-> name }}</option>
                                            @else
                                                <option value="{{ $y -> id }}">{{ $y-> name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td class="sorting_1">
                                    <input class="form-control" size="4"
                                           type="text" id="amaunt{{$x -> id}}"
                                           value="{{$x -> amount }}"
                                           name="amaunt_{{$x -> id }}"
                                           oninput="summ('{{$x -> id}}')"
                                           onBlur="update_data('{{$x -> id}}')"
                                           onclick="$(this).select()"
                                           onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')">
                                </td>
                                <td>
                                    <input class="form-control" size="4"
                                           type="text" id="cost{{$x -> id}}"
                                           value="{{$x -> cost_income}}"
                                           oninput="summ('{{$x -> id}}')"
                                           onBlur="update_data('{{$x -> id}}')"
                                           onclick="$(this).select()"
                                           onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')">

                                </td>
                                <td>
                                    <input id="rub{{$x -> id}}" value="{{$x -> cost_income_r}}" name="cost_rub"
                                           class="form-control" size="4" readonly>
                                </td>
                                <td>
                                    <input id="cost_end_id{{$x -> id}}" value="{{$x -> cost_end}}" name="cost_end"
                                           class="form-control" size="4" readonly>
                                </td>
                                <td>
                                    <input type="button" class="btn btn-danger" value="x"
                                           onclick="delete_good('{{$x -> id}}')">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-md-13 col-sm-13">
                    <div id="sample_3_filter" class="dataTables_filter">
                        <div class="actions">
                            <a href="javascript:;" class="btn btn-default btn-sm" onclick="add_new_empity_good()">
                                <i class="fa fa-plus"></i> Добавить товар </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="portlet-title">
            <div class="actions">
                <a href="javascript:;" class="btn btn-default btn-sm" onclick="end()">
                    Принять товар <i class="fa fa-toggle-right"></i>
                </a>
            </div>
        </div>
    </div>

    </div>
    <script type="text/javascript">


    </script>
@endsection

@section('page_scripts')
    <script src="{{ asset("assets/") }}/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{ asset("assets/") }}/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{ asset("assets/") }}/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{ asset("assets/") }}/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
            type="text/javascript"></script>
@endsection


@section('script')
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".select2-allow-clear").select2({
            allowClear: false,
            placeholder: "Выберите Товар",
            width: "300px",
        });

        function update_data(id) {

            var update_url = $("#hidden_update").val();


            // проверка на значение пременой, являеться ли она строкой
//        if (isNaN(parseInt($("#good_name_id" + id + " option:selected").val())) === false){
//            var good_id = $("#good_name_id" + id + " option:selected").val();
//
//        }
//        else {
//            var good_id = 0;
//
//        }
            var good_id = $("#good_name_id" + id + " option:selected").val()

            var amount = $("#amaunt" + id).val();
            var cost_income = $("#cost" + id).val();
            var cost_income_r = $("#rub" + id).val();
            var cost_end = $("#cost_end_id" + id).val();

            $.ajax({
                url: update_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    "id": id,
                    "good_id": good_id,
                    "amount": amount,
                    "cost_income": cost_income,
                    "cost_income_r": cost_income_r,
                    "cost_end": cost_end,

                },
                beforeSend: function () {
                    console.log(good_id);
                },
                success: function () {

                }
            });
        }


        function add_new_empity_good() {
            var hidden_add = $("#hidden_add").val();
            var id = $("#id_invoice").val();

            $.ajax({
                url: hidden_add,
                type: "POST",
                dataType: "JSON",
                data: {
                    "id": id,
                },
                beforeSend: function () {
                    //console.log();
                },
                success: function () {
                    location.reload();
                },
                error: function () {
                }
            });
        }


        function delete_good(id) {

            var conf = confirm("Дейсвительно удалить?");
            var delete_url = $("#hidden_delete").val();

            if (conf) {
                $.ajax({
                    url: delete_url,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        "id": id
                    },
                    success: function () {
                        $("#tr_id" + id).remove();
                    }
                });
            }
            else {
                return false;
            }
        }

        function summ(id) {

            var cost_unit = $("#cost_unit").val();
            var cost_delivery = $("#cost_delivery").val();
            var cost = $("#cost" + id).val();

            // расчтет стоимости в рублях
            $("#rub" + id).val(parseFloat(cost_unit * cost).toFixed(2));

            // сумма всех значений инпутов с именем которое начинаеться с amaunt_
            // делим на стоимость доставки и округляем до 2 значений после запятой

            var summa = 0;
            $("input[name^='amaunt_']").each(function () {
                summa += parseInt($(this).val());
            });

            // стоимость доставки за едницу товара
            var cost_delivery_one = parseFloat(parseInt(cost_delivery) / summa).toFixed(2);


            //проходим по всем элементам конечной стоимости, при этом находим в родительском элементе
            //рядом стоящий инпут и прессчитываем все поля конечной стоимости
            $("input[name ='cost_end']").each(function () {
                var cost_rub = $(this).parent().parent().find("input[name = 'cost_rub']").val();
                var cost_end = parseFloat(cost_delivery_one) + parseFloat(cost_rub);
                $(this).val(parseFloat(cost_end).toFixed(2));
                var id = $(this).parent().parent().prop('id').substr(5);

                var update_end_url = $("#hidden_update_end").val();

                $.ajax({
                    url: update_end_url,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "cost_end": cost_end,

                    },
                    beforeSend: function () {
                        //console.log(cost_income);
                    },
                    success: function () {

                    }
                });

                console.log(cost_end, cost_delivery_one);

            });


        }

        var url_end = $("#hidden_end").val();
        var url_invoice = $("#hidden_invoice").val();
        id_invoice = $("#id_invoice").val();

        function end() {
            $.ajax({
                url: url_end,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'id_invoice': id_invoice,
                },
                error: function () {

                },
                beforeSend: function () {

                },
                success: function () {
                    $(location).attr('href', url_invoice);
                },

            });
        }

    </script>
@endsection