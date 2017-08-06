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
        <div class="ui slider checkbox item right">
            <input type="checkbox" tabindex="0" class="hidden">
            <label>Только мой склад</label>
        </div>
        <div class="ui dropdown item">
            Операции
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" id="move_product"">Перемещение</a>
                <a class="item" id="set_cost">Установка цен</a>
                <div class="item">Установить оптовую цену</div>
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
            <table class="ui very compact small selectable celled table dimmable">
                <thead>
                <tr>
                    <th width="1%">
                        <input type="checkbox">
                    </th>
                    <th>
                        Название
                    </th>
                    <th>
                        Кол-во
                    </th>
                    <th>
                        Дата поступления
                    </th>
                    <th>
                        Местоположение
                    </th>
                    <th>
                        Себестоимость
                    </th>
                    <th>
                        Розничная цена
                    </th>
                    <th>
                        Оптовая цена
                    </th>
                </tr>
                </thead>
                <tbody id="result">

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

            $('.checkbox').checkbox({
                onChange: function () {
                    render_table();
                }
            });

            function render_table() {

                var search = [];

                if ($('.checkbox').checkbox('is checked')) {
                    search.mystorage = 1;

                }
                else {
                    search.mystorage = 0;
                }

                $.ajax({
                    url: "{{ route('list_products') }}",
                    type: 'POST',
                    data: {
                        mystorage: search.mystorage,
                        id: search.settings,
                    },
                    datatype: "json",
                    beforeSend: function () {
                        //console.log(search);
                        $('#dimmer').addClass('dimmer');
                        $('#loader').addClass('loader');

                    },
                    success: function (response) {
                        $('#result').html(response);
                        $('#dimmer').removeClass('dimmer');
                        $('#loader').removeClass('loader');
                    },
                });
            }

            render_table();

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


