@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui grid">
        <div class="ui sixteen wide column">
            <div class="ui segment">

            </div>
        </div>
    </div>


    <div class="ui top attached menu">
        <div class="item">&nbsp;Товары</div>
        {{--<div class="ui slider checkbox item right">--}}
        {{--<input type="checkbox" tabindex="0" class="hidden">--}}
        {{--<label>Только мой склад</label>--}}
        {{--</div>--}}
        <div class="ui dropdown right item">
            Операции
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" id="move_product">Перемещение</a>
                <a class="item" id="set_cost">Установка цен</a>
            </div>
        </div>
    </div>



    <div class="ui bottom attached segment ">
        <div id="dimmer" class="ui active inverted">
            <div id="loader" class="ui"></div>
        </div>
        <form id="form_cost" action="" method="post">
            {{ csrf_field() }}
            <input name="back_url" type="hidden" value="{{ Route::currentRouteName() }}">
            <table id="list_prod" class="ui very compact small selectable celled table dimmable">
                <thead>
                <tr>
                    <th width="1%">
                    </th>
                    <th>
                        Название (Дата поступления)
                    </th>
                    <th class="collapsing">
                        Категория
                    </th>
                    <th class="collapsing">
                        Кол-во
                    </th>
                    <th>
                        Местоположение
                    </th>
                    <th class="collapsing">
                        Цена
                    </th>
                </tr>
                </thead>
                <tbody id="result">
                @foreach($products as $product)
                    <tr>
                        <td><input name="id_product[]" type="checkbox" value="{{ $product->id }}"></td>

                        <td>
                            <a href="{{ route('detail_products') }}/{{ $product->good_id }}">
                                <b>{{ $product->good_model->name }}</b>
                            </a>
                            {{ $product->invoice_model->real_date }}
                        </td>
                        <td nowrap>
                            @if($product->good_model->main_cat != NULL)
                                {{ $product->good_model->main_cat->name }}
                            @else
                                -
                            @endif
                            /
                            @if($product->good_model->sub_cat != NULL)
                                {{ $product->good_model->sub_cat->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td><b>{{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}</b>.</td>
                        <td>{{ $product->storage_model->name }}</td>
                        <td nowrap>
                            @if( $product->one_cost_retail_model )
                                {{ $product->one_cost_retail_model->cost }} p.
                            @else
                                -
                            @endif
                        </td>
                    </tr>

                    {{--@if($product->good_model->consist == 0)--}}
                    {{--<tr role="row" class="filter">--}}
                    {{--<td width="1%">--}}
                    {{--<input name="id_product[]" type="checkbox" value="{{ $product->id }}">--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<h5><a href="{{ route('detail_products') }}/{{ $product->good_id }}"--}}
                    {{--class="ui label small blue"><b>{{ $product->good_model->name }}</b></a></h5>--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<h5>--}}
                    {{--<a class="ui label small blue"><b>{{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}</b>.</a>--}}
                    {{--</h5>--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<h5><a class="ui label small blue"><b>{{ $product->invoice_model->real_date }}</b></a></h5>--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label small blue"><b></b>&nbsp;--}}
                    {{--<div class="detail">1</div>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>. ---}}
                    {{--<b>{{ $product->cost_end }}</b> р.</a>--}}
                    {{--</td>--}}
                    {{--@if($product->one_cost_sell_id == 0)--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label red"><b>Не установлена</b></a>--}}
                    {{--</td>--}}
                    {{--@else--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<h5><a class="ui label blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>. ---}}
                    {{--<b>{{ $product->one_cost_sell_id }}</b> р.</a></h5>--}}
                    {{--</td>--}}
                    {{--@endif--}}
                    {{--@if($product->one_cost_sell_opt_id == 0)--}}
                    {{--<td rowspan="1" colspan="1" class="">--}}
                    {{--<a class="ui label red"><b>Не установлена</b></a>--}}
                    {{--</td>--}}
                    {{--@else--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<h5>--}}
                    {{--<span class="ui label ui label-info"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>. - <b>{{ $product->one_cost_sell_opt_id }}</b> р.</span>--}}
                    {{--</h5>--}}
                    {{--</td>--}}
                    {{--@endif--}}
                    {{--</tr>--}}
                    {{--@else--}}
                    {{--<tr role="row" class="filter">--}}
                    {{--<td width="1%">--}}
                    {{--<input name="id_product[]" type="checkbox" value="{{ $product->id }}">--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a href="{{route('detail_products') }}/{{ $product->good_id }}"--}}
                    {{--class="ui label small blue"><b>{{ $product->good_model->name }}</b></a>--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label small blue"><b>{{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->consist_amaunt }} {{ $product->good_model->many_name_model->name_short }}--}}
                    {{--.--}}
                    {{--</div>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label small blue"><b>{{ $product->invoice_model->real_date }}</b></a>--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label small blue"><b>1</b>&nbsp;--}}
                    {{--<div class="detail">1</div>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->cost_end }}р.</div>--}}
                    {{--</a>--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->consist_cost_end }}р.</div>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--@if($product->one_cost_sell_id == 0 & $product->many_cost_sell_id == 0)--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label red"><b>Не установлена</b></a>--}}
                    {{--</td>--}}
                    {{--@else--}}
                    {{--@if($product->one_cost_sell_id > 1 & $product->many_cost_sell_id == 0)--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label ui label-info"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->one_cost_sell_id }}р.</div>--}}
                    {{--</a>--}}
                    {{--<a class="ui label red"><b>Не установлена</b></a>--}}
                    {{--</td>--}}
                    {{--@elseif($product->one_cost_sell_id == 0 & $product->many_cost_sell_id > 0 )--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label red"><b>Не установлена</b></a>--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->many_cost_sell_id }}р.</div>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--@else--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->one_cost_sell_id }}р.</div>--}}
                    {{--</a>--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->many_cost_sell_id }}р.</div>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--@endif--}}
                    {{--@endif--}}
                    {{--@if($product->one_cost_sell_opt_id == 0 & $product->many_cost_sell_opt_id == 0)--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label red"><b>Не установлена</b></a>--}}
                    {{--</td>--}}
                    {{--@else--}}
                    {{--@if($product->one_cost_sell_opt_id > 1 & $product->many_cost_sell_opt_id == 0)--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label ui label-info"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->one_cost_sell_opt_id }}р.</div>--}}
                    {{--</a>--}}
                    {{--<a class="ui label red"><b>Не установлена</b></a>--}}
                    {{--</td>--}}
                    {{--@elseif($product->one_cost_sell_opt_id == 0 & $product->many_cost_sell_opt_id > 0 )--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label red"><b>Не установлена</b></a>--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">>{{ $product->many_cost_sell_opt_id }}р.</div>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--@else--}}
                    {{--<td rowspan="1" colspan="1">--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->one_cost_sell_opt_id }}р.</div>--}}
                    {{--</a>--}}
                    {{--<a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.--}}
                    {{--<div class="detail">{{ $product->many_cost_sell_opt_id }}р.</div>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--@endif--}}
                    {{--@endif--}}
                    {{--</tr>--}}
                    {{--@endif--}}
                @endforeach
                </tbody>
            </table>
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
        $(document).ready(function () {

//            $('.checkbox').checkbox({
//                onChange: function () {
//                    render_table();
//                }
//            });

            {{--function render_table() {--}}

            {{--var search = [];--}}

            {{--if ($('.checkbox').checkbox('is checked')) {--}}
            {{--search.mystorage = 1;--}}

            {{--}--}}
            {{--else {--}}
            {{--search.mystorage = 0;--}}
            {{--}--}}

            {{--$.ajax({--}}
            {{--url: "{{ route('list_products') }}",--}}
            {{--type: 'POST',--}}
            {{--data: {--}}
            {{--mystorage: search.mystorage,--}}
            {{--id: search.settings,--}}
            {{--},--}}
            {{--datatype: "json",--}}
            {{--beforeSend: function () {--}}
            {{--//console.log(search);--}}
            {{--$('#dimmer').addClass('dimmer');--}}
            {{--$('#loader').addClass('loader');--}}

            {{--},--}}
            {{--success: function (response) {--}}
            {{--$('#result').html(response);--}}
            {{--$('#dimmer').removeClass('dimmer');--}}
            {{--$('#loader').removeClass('loader');--}}
            {{--},--}}
            {{--});--}}
            {{--}--}}

            {{--render_table();--}}


            $(document).ready(function () {

                $('#list_prod').DataTable({
                    "language": {
                        "info": "Старница _PAGE_ из _PAGES_",
                        "lengthMenu": "_MENU_  &nbsp;&nbsp;записей на страницу",
                        "zeroRecords": "Нет товаров",
                        "search": "Поиск:",
                        "paginate": {
                            "first": "Начало",
                            "last": "Конец",
                            "next": "Вперед",
                            "previous": "Назад"
                        },

                    },
                    "lengthMenu": [[25, 50, -1], [25, 50, "Все"]],

                });

            });

            $('#set_cost').on('click', function () {

                let url = '{{ route('set_cost') }}';

                $('#form_cost').prop('action', url);

                $('#form_cost').submit();
            });

            $('#move_product').on('click', function () {
                let url = '{{ route('move_product') }}';

                $('#form_cost').prop('action', url);

                $('#form_cost').submit();
            });

        });
    </script>
@endsection


