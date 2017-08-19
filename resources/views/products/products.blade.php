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
        <div class="item">&nbsp;Розничный склад | {{ \App\StorageModel::find(Auth::user()->storage_id)->name }}</div>
        <a class="item" href="{{ route('list_products') }}/{{ Auth::user()->storage_id }}">Мой склад</a>
        <a class="item" href="{{ route('list_products') }}">&nbsp;Все склады</a>
        <div class="ui dropdown right item">
            Операции
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" id="move_product">Перемещение</a>
                <a class="item" id="set_cost">Установка цен</a>
                <a class="item" id="return_product">Возрат поставщику</a>
                <a class="item" id="spend_product">Списание</a>
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
                    <th class="collapsing">
                        Состоит
                    </th>
                    <th class="collapsing">
                        Местоположение
                    </th>
                    <th class="collapsing">
                        Цена
                    </th>
                    <th class="collapsing">
                        Цена
                    </th>
                </tr>
                </thead>
                <tbody id="result">
                @foreach($products as $product)
                    @if ($product->good_model->consist == 0)
                        <tr>
                            <td><input name="id_product[]" type="checkbox" value="{{ $product->id }}"></td>

                            <td>
                                <a class="tovar" href="{{ route('detail_products') }}/{{ $product->good_id }}">
                                    <b>{{ $product->good_model->name }}</b>
                                </a>
                                <div class="ui popup top left transition">
                                    <div class="ui one column center aligned grid">
                                        <img width="300px" height="300px" class="ui image"
                                             src="../storage/orders/101.jpg">
                                    </div>
                                </div>
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
                            <td class="collapsing">
                                <b>{{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}</b>.
                            </td>
                            <td> -</td>
                            <td>{{ $product->storage_model->name }}</td>
                            <td nowrap>
                                @if( $product->one_cost_retail_model )
                                    {{ $product->one_cost_retail_model->cost }} p.
                                @else
                                    -
                                @endif
                            </td>
                            <td nowrap>
                                -
                            </td>
                        </tr>
                    @else
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
                            <td class="collapsing">
                                <b>{{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}</b>.
                            </td>
                            <td class="collapsing"><b>{{ $product->consist_amount }}
                                    /{{ $product->consist_amount_was }} {{ $product->good_model->many_name_model->name_short }}</b>.
                            </td>
                            <td>{{ $product->storage_model->name }}</td>
                            <td nowrap>
                                @if( $product->one_cost_retail_model )
                                    {{ $product->one_cost_retail_model->cost }} p.
                                @else
                                    -
                                @endif
                            </td>
                            <td nowrap>
                                @if( $product->many_cost_retail_model )
                                    {{ $product->many_cost_retail_model->cost }} p.
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endif
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

            $('a.tovar').popup({
                popup: true,
                position: 'right center',
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

            $('#return_product').on('click', function () {
                let url = '{{ route('return_create') }}';

                $('#form_cost').prop('action', url);

                $('#form_cost').submit();
            });

            $('#spend_product').on('click', function () {
                let url = '{{ route('spend_product_create') }}';

                $('#form_cost').prop('action', url);

                $('#form_cost').submit();
            });

        });
    </script>
@endsection


