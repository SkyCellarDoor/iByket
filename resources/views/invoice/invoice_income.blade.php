@extends('skyapp.index')

@section('page_css')

    <link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet"
          type="text/css"/>
    <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"
          type="text/css"/>

@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--начало заголовка страницы--}}
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Новая накладная</span>
            </li>
        </ul>

        <div class="page-toolbar">

        </div>
    </div>
    {{--конец заголовка страницы--}}

    <div class="raw">
        <br/>
        <div class="portlet box blue-dark">
            <div class="portlet-title">
                <div class="caption" id="test">
                    <i class="fa"></i>Новая накладная от {{ date('') }}
                </div>

            </div>
            <div class="portlet-body">
                <div class="form-group">
                    <form class="form-inline">
                        <div class="input-group col-md-3" id="p_provider">
                            <span class="input-group-addon">Счет
                                <input type="checkbox" id="bill" checked>
                            </span>
                            <select id="provider" class="select2-allow-clear">
                                <option value="0">Выберите поставщика</option>
                                @foreach($providers as $p)
                                    <option value="{{ $p->id }}">{{ $p->company }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">

                        </div>
                        <div class="input-group col-md-2" id="p_ye">
                            <input onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')"
                                   id="costy_ye" value=""
                                   class="form-control" placeholder="Сумма в y.e.">
                            <span class="input-group-addon">
                            <i class="fa">y.e.</i>
                            </span>
                        </div>
                        <div class="input-group col-md-2" id="p_del">
                            <input onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')"
                                   id="costy_deliv"
                                   class="form-control" placeholder="Сумма доставки">
                            <span class="input-group-addon">
                            <i class="fa fa-rub"></i>
                            </span>
                        </div>
                        <div class="input-group date col-md-2 form_datetime bs-datetime" data-date=""
                             data-date-format="dd-MM-yyyy">
                            <input class="form-control" id="real_date" size="16" type="text" value="" readonly="">
                            <span class="input-group-addon">
                                    <button class="btn default date-set" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                 </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="portlet-title">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm" onclick="send_data()">
                        Продолжить <i class="fa fa-toggle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <input type="hidden" name="hidden_new" id="hidden_new" value="{{ route('invoice_add') }}">
        <input type="hidden" name="hidden_add_new" id="hidden_add_new" value="{{ route('invoice_add') }}">

        <script type="text/javascript">

        </script>
        @endsection


        @section('page_scripts')
            <script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js"
                    type="text/javascript"></script>
            <script src="{{ asset("assets/") }}/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
                    type="text/javascript"></script>
            <script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
        @endsection


        @section('script')
            <script>

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#real_date").val(moment().format("YYYY-MM-DD"));

                function send_data() {

                    var bill = $("#bill").prop('checked');

                    if (bill === true) {
                        bill = 1;
                    }
                    else {
                        bill = 0;
                    }

                    var url_add = $("#hidden_add_new").val();
                    var url_new = $("#hidden_new").val();
                    var provider = parseFloat($(".select2-allow-clear").val());
                    var costy_ye = parseFloat($("#costy_ye").val());
                    var costy_deliv = parseFloat($("#costy_deliv").val());
                    var real_date = $("#real_date").val();

                    // console.log(bill, provider, costy_ye, costy_deliv, real_date);

                    if (provider === 0 || isNaN(costy_ye) || isNaN(costy_deliv)) {
                        if (provider === 0) {
                            $("#p_provider").pulsate({
                                color: "#c32326",
                                repeat: !1

                            });
                        }

                        if (isNaN(costy_ye)) {
                            $("#p_ye").pulsate({
                                color: "#c32326",
                                repeat: !1

                            });
                        }

                        if (isNaN(costy_deliv)) {
                            $("#p_del").pulsate({
                                color: "#c32326",
                                repeat: !1

                            });
                        }

                        return false;
                    }

                    $.ajax({
                        url: url_add,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            'provider_id': provider,
                            'use_bill': bill,
                            'cost_unit': costy_ye,
                            'cost_delivery': costy_deliv,
                            'real_date': real_date,
                        },
                        error: function () {

                        },
                        beforeSend: function () {

                        },
                        success: function (response) {
                            var id = response.id;
                            $(location).attr('href', url_new + "/" + id);
                            //console.log(id);
                        },

                    });
                }

                $(".select2-allow-clear").select2({
                    allowClear: false,
                    placeholder: "Выберите Поставщика",
                    width: "250px",
                });


                $(".form_datetime").datetimepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    minView: 2,
                    todayBtn: 1,
                    fontAwesome: true,
                    pickerPosition: ("bottom-left")
                });

            </script>
@endsection


