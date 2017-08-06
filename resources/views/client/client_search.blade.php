@extends('skyapp.index')

@section('page_css')

    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal.css" rel="stylesheet"
          type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal-bs3patch.css"
          rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="page-bar margin-bottom-20">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('home') }}">Домой</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Клиенты</span>
            </li>
        </ul>

        <div class="page-toolbar">

        </div>
    </div>

    <input type="hidden" name="hidden_search" id="hidden_search" value="{{ route('search') }}">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <!-- /btn-group -->
                <input id="search_client" type="text" class="form-control" placeholder="Поиск" value="{{ $text or '' }}"
                       oninput="search($(this).val())">
                <div class="input-group-btn">
                    <a class="btn green-meadow" id="add" data-toggle="modal" data-id="" data-title=""
                       href="#create_client" onclick="$('#name_client').val($('#search_client').val())">
                        <i class="fa fa-plus"></i> Новый клиент</a>
                </div>
                <!-- /btn-group -->
            </div>
        </div>
        <div class="portlet-body">


            {{--Модальные окна--}}
            {{--окно поступления на счет--}}

            <div id="add_to_bill" class="modal fade" tabindex="-1" data-width="420" style="display: none;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title">Зачистлить на счет клиента</h5>
                    <h5 id="name_title_add" style="font-weight: bold;"></h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cash_operation_client') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <input type="text" name="value" class="form-control" placeholder="Сумма" value="">
                                    <span class="input-group-addon">руб.</span>
                                </div>
                            </div>
                            <div class="col-md-12 margin-top-10">
                                <select class="selectpicker" name="type_bill" title="Выберите тип оплаты">
                                    <option value="1" data-icon="fa fa-money">Наличные</option>
                                    <option value="2" data-icon="fa fa-fax">Терминал</option>
                                    <option value="3" data-icon="fa fa-credit-card">На карту (СберБанк)</option>
                                </select>
                            </div>

                            <div class="col-md-12 margin-top-10">
                                <textarea class="form-control" name="comments" placeholder="Коментарий"
                                          value=""></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input id='client_id_add' name="client_id" type="hidden" value="">
                    <input name="op_type" type="hidden" value="1">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Закрыть</button>
                    <input type="submit" class="btn btn-primary" value="Выполнить">
                    </form>
                </div>
            </div>

            {{--окно списания со счета--}}

            <div id="spend_from_bill" class="modal fade" tabindex="-1" data-width="420" style="display: none;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title">Списать со счета клиента</h5>
                    <h5 id="name_title_spend" style="font-weight: bold;"></h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cash_operation_client') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <input type="text" name="value" class="form-control" placeholder="Сумма" value="">
                                    <span class="input-group-addon">руб.</span>
                                </div>
                            </div>
                            <div class="col-md-12 margin-top-10">
                                <select class="selectpicker" name="type_bill" title="Выберите тип оплаты">
                                    <option value="1" data-icon="fa fa-money">Наличные</option>
                                    <option value="2" data-icon="fa fa-fax">Терминал</option>
                                    <option value="3" data-icon="fa fa-credit-card">На карту (СберБанк)</option>
                                </select>
                            </div>

                            <div class="col-md-12 margin-top-10">
                                <textarea class="form-control" name="comments" placeholder="Коментарий"
                                          value=""></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input id='client_id_spend' name="client_id" type="hidden" value="">
                    <input name="op_type" type="hidden" value="0">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Закрыть</button>
                    <input type="submit" class="btn btn-primary" value="Выполнить">
                    </form>
                </div>
            </div>

            {{--модальное окно создания нового клиента--}}

            <div id="create_client" class="modal fade" tabindex="-1" data-width="740" style="display: none;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Создание нового клиента</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create_client') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <input id="name_client" type="text" name="name" class="form-control"
                                       placeholder="Имя Фамилия" value="">
                            </div>
                            <div class="col-md-4 margin-top-10">
                                <div class="input-group">
                                    <span class="input-group-addon">+7</span>
                                    <input id="phone_client" type="text" class="form-control"
                                           placeholder="Номер телефона" value="" onchange="copy_clear_value()">
                                </div>
                                <input id="phone_client_clear" type="hidden" name="phone" class="form-control"
                                       placeholder="Номер телефона" value="">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Закрыть</button>
                    <input type="submit" class="btn btn-primary" value="Создать">
                    </form>
                </div>
            </div>

            {{--Конец модальных окон--}}

            <table id="table_client" class="table table-bordered table-hover" role="grid">
                <thead>
                <tr>
                    <th class="col-xs-3" style="text-align: center;">Имя фамилия</th>
                    <th class="col-xs-1" style="text-align: center; ">Телефон</th>
                    <th class="col-xs-1" style="text-align: center;">Счет</th>
                    <th class="col-xs-2" style="text-align: center;">Действия</th>
                </tr>
                </thead>
                <tbody align="center">
                @isset($results_out)
                    @foreach($results_out as $result)
                        <tr>
                            <td style="vertical-align: middle" align="left">{{ $result -> name }}</td>
                            <td style="vertical-align: middle;">
                                <div class="raw" style=" width: 130px !important;">+7 {{ $result -> phone }}</div>
                            </td>
                            <td style="vertical-align: middle">
                                <div class="input-group" style="width: 155px !important;">
                                    <div class="input-group-btn">
                                        <a class="btn red" id="spend" data-toggle="modal" data-id="{{ $result -> id }}"
                                           data-title="{{ $result -> name }}" href="#spend_from_bill"
                                           onclick="spend_from_bill($(this).attr('data-id'), $(this).attr('data-title'))">
                                            <i class="fa fa-minus"></i></a>
                                    </div>
                                    <!-- /btn-group -->
                                    <input type="text" class="form-control" style="text-align: center; " readonly
                                           value="{{ $result -> bill }} р.">
                                    <div class="input-group-btn">
                                        <a class="btn green-meadow" id="add" data-toggle="modal"
                                           data-id="{{ $result -> id }}" data-title="{{ $result -> name }}"
                                           href="#add_to_bill"
                                           onclick="add_to_bill($(this).attr('data-id'), $(this).attr('data-title'))">
                                            <i class="fa fa-plus"></i></a>
                                    </div>
                                    <!-- /btn-group -->
                                </div>
                            <td>
                                <div class="btn-group">
                                    <a href="/order/new?user_id={{ $result -> id }}" class="btn btn-primary btn-sm"
                                       role="button">Заказ</a>
                                    <a href="{{ route('detail_view') }}/{{ $result -> id }}"
                                       class="btn btn-primary btn-sm" role="button">Просмотр</a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle btn-sm"
                                                data-toggle="dropdown">
                                            Продажа <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Списать со счета</a></li>
                                            <li><a href="#">Без счета</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                @endisset
                </tbody>
            </table>
            @if($results_out instanceof \Illuminate\Pagination\AbstractPaginator)

                {{$results_out->links()}}

            @endif
        </div>

        @endsection


        @section('page_scripts')
            <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.js"
                    type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.js"
                    type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
        @endsection



        @section('script')
            <script type="text/javascript">


                $('#phone_client').mask('(000) 000-0000', {'translation': {0: {pattern: /[0-9*]/}}});

                function copy_clear_value() {
                    var phone = $('#phone_client_clear').val($('#phone_client').cleanVal());
                    //console.log($('#phone_client').cleanVal());
                }


                $('.selectpicker').selectpicker({
                    iconBase: 'fa',
                    size: 4
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function search(text_s_aj) {
                    if (text_s_aj.length > 2) {


                        var search_url = $("#hidden_search").val();

                        $.ajax({
                            url: search_url,
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                "text_s_aj": text_s_aj,
                            },
                            beforeSend: function () {
                                //console.log(search_url);
                            },
                            success: function (response) {
                                $('tbody').replaceWith(response);
                                //console.log(response);
                            }
                        });
                    }
                    else {
                        $('tbody').replaceWith('<tbody> </tbody>');
                        //console.log('пустой запрос');
                    }

                }


                function add_to_bill(id, name) {

                    $('#client_id_add').val(id);
                    $('#name_title_add').text(name);
                    console.log("add", id, name);


                }

                function spend_from_bill(id, name) {

                    $('#client_id_spend').val(id);
                    $('#name_title_spend').text(name);
                    console.log("spend", id, name);


                }

            </script>
@endsection
