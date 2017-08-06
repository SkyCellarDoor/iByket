@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}
    <link href="../assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/global/plugins/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" name="hidden_search" id="hidden_search" value="{{ route('sub_cat_good') }}">

    <div class="ui top attached menu">
        <div class="item">&nbsp;<span id="name_product">{{ $product->name }}</span></div>

        <div class="ui right dropdown item">
            ???????
            <i class="dropdown icon"></i>
            <div class="menu">
                <div class="item">?????</div>
                <div class="item">????</div>
            </div>
        </div>


    </div>

    <div class="ui top attached tabular menu">
        <a class="item active" data-tab="main">Основное</a>
        <a class="item" data-tab="second">Дополнительно</a>
        <a class="item" data-tab="promotions">Акции</a>
        <a class="item" data-tab="cargo">Наличие</a>
        <a class="item" data-tab="sells">Продажи</a>
        <a class="item" data-tab="invoice">Поступления</a>
    </div>


    <div class="ui bottom attached active tab segment" data-tab="main">
        <form id="data" role="form" action="{{ route('update_good') }}">
            <input name="id" type="hidden" class="form-control" value="{{ $product->id }}"/>
            <div class="ui grid">
                <div class="ui twelve wide column">
                    <div id="dimmer" class="ui error form segment">
                        <div class="ui inverted dimmer">
                            <div class="content">
                                <div class="center">
                                    <h2 class="ui icon header"><i class="checkmark icon"></i> Сохраненно </h2>
                                </div>
                            </div>
                        </div>

                        <div class="three fields">
                            <div class="field">
                                <label>Название</label>
                                <input id="current_name" name="name" type="text" class="form-control"
                                       placeholder="Название" value="{{ $product->name }}">
                            </div>
                            <div class="field">
                                <label>Категория</label>
                                <select id="category" class="dropdown" name="category">
                                    <option value="">Выберите категорию</option>
                                    @foreach( $categories as $category)
                                        @if( $product->category_id == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div id="div_sub_cat" class="field">
                                <label>Подкатегория</label>
                                <select id="sub_category" class="dropdown" name="sub_category">
                                    <option value="">Выберите подкатегорию</option>
                                    @foreach( $sub_categories as $sub_category)
                                        @if( $product->sub_category_id == $sub_category->id)
                                            <option value="{{ $sub_category->id }}"
                                                    selected>{{ $sub_category->name }}</option>
                                            @else
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="field">
                            <label>Описание</label>
                            <textarea name="description" placeholder="Описание"
                                      rows="2">{{ $product->description }}</textarea>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Производитель</label>
                                <input name="vendor" type="text" placeholder="Производитель"
                                       class="form-control" value="{{ $product->vendor }}"/>
                            </div>
                            <div class="field">
                                <label>Страна</label>
                                <input name="country" type="text" placeholder="Страна"
                                       class="form-control" value="{{ $product->country }}"/>
                            </div>
                        </div>
                        <div class="three fields">
                            <div class="field">
                                <label>Длинна</label>
                                <input name="sizeX" type="text" placeholder="Высота"
                                       class="form-control" value="{{ $product->sizeX }}"/>
                            </div>
                            <div class="field">
                                <label>Ширина</label>
                                <input name="sizeY" type="text" placeholder="Ширина"
                                       class="form-control" value="{{ $product->sizeY }}"/>
                            </div>
                            <div class="field">
                                <label>Радиус</label>
                                <input name="sizeZ" type="text" placeholder="Радиус"
                                       class="form-control" value="{{ $product->sizeDi }}"/>
                            </div>
                        </div>
                    </div>
                    <input id="semantic_button" type="submit" class="ui button right floated" style=""
                           value="Сохранить">
                </div>
                <div class="ui four wide column">
                    <div class="ui centered card" style="width: 100%;">
                        <div class="content">
                            <div class="content">
                                <div class="header"><span id="name_product_card">{{ $product->name }}</span>
                                    <span class="right floated time">{{ $product_count }} {{ $product->one_name_model->name_short }}
                                        .</span></div>
                                <div class="meta">
                                    <span class="category">{{ $product->main_cat->name }}
                                        /{{ $product->sub_cat->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="ui feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="summary">
                                                <span class="right floated">
                                                ?
                                                 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="ui small feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="extra text">
                                            ?
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="content">
                            ?
                        </div>
                        <div class="extra  content">
                            1
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="ui bottom attached tab segment" data-tab="second">
        <div class="ui grid">
            <div class="ui twelve wide column">
                <div id="loader" class="ui">
                    <table id="result" class="ui segment very compact fluid basic collapsing celled table"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th style="width: 1%"><input type="checkbox"></th>
                            <th>Дата поступления / Накладная</th>
                            <th>Магазин</th>
                            <th>Себестоимость</th>
                            <th><a class="ui small label">Кол-во </a></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($list_products as $list_product)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>{{ $list_product->invoice_model->real_date }} /
                                    <a>{{  $list_product->invoice_model->id }}</a></td>
                                <td><a class="ui small teal label">{{ $list_product->storage_model->name }}</a></td>
                                <td>{{ $list_product->cost_end }}</td>
                                <td>
                                    <a class="ui small label"> {{ $list_product->amount }} {{ $list_product->good_model->one_name_model->name_short }}</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>


        </div>
    </div>

    {{--акции--}}

    <div class="ui bottom attached tab segment" data-tab="promotions">
        <div class="ui grid">
            <div class="ui twelve wide column">
                <div class="ui top attached tabular menu">
                    <a class="active item" data-tab="active_promotion">Активные</a>
                    <a class="item" data-tab="not_active_promotion">Не активные</a>
                </div>
                <div class="ui bottom attached active tab segment" data-tab="active_promotion">
                    <table id="result_table" class="ui table compact celled segment">

                    </table>
                </div>
                <div class="ui bottom attached tab segment" data-tab="not_active_promotion">Second</div>
            </div>
            <div class="ui four wide column">
                <div class="ui segment">
                    <input id="button_new_promotion" type="button" class="ui fluid green button" value="Новая акция">
                </div>
            </div>
        </div>
    </div>


    <div class="ui bottom attached tab segment" data-tab="cargo">Third</div>
    <div class="ui bottom attached tab segment" data-tab="sells">
        <table class="ui table compact celled selectable segment ">
            <thead>
            <tr>
                <th class="collapsing">№</th>
                <th class="collapsing" nowrap>Дата</th>
                <th>Клиент</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $sells as $sell )
                <tr>
                    <td><a href="{{ route('sell_detail') }}/{{ $sell->sells_id }}">{{ $sell->sells_id }}</a></td>
                    <td nowrap>{{ $sell->created_at }}</td>
                    @if ( $sell->sells_model->client_id == NULL )
                        <td>Без клиента</td>
                    @else
                        <td>
                            <a href="{{ route('detail_view') }}/{{ $sell->sells_model->client_id }}">{{ $sell->sells_model->client_sell_model->name }}</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="ui bottom attached tab segment" data-tab="invoice">Third</div>

    {{--Модальные окна--}}

    {{--Модальное окно новой акции--}}

    <div id="new_promotion" class="ui small modal">

        <i class="close icon"></i>
        <div class="header">
            Новая акция
        </div>

        <div class="content">
            <div class="ui form">
                <form id="form_new_promotion" role="form" method="post">
                    {{ csrf_field() }}
                    <input id="id_product" type="hidden" class="form-control" value="{{ $product->id }}"/>
                    <div class="ui error message">

                    </div>
                    <div class="three fields">
                        <div class="field">
                            <label>Название</label>
                            <input id="name" placeholder="Название" type="text">
                        </div>
                        <div class="three wide field">
                            <label>Процент скидки</label>
                            <div class="ui right icon input">
                                <input id="percent" type="number" min="0">
                                <i class="percent icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label>Применять к ценам на:</label>
                            <div class="grouped inline fields">
                                <div class="field">
                                    <div class="ui checkbox">
                                        <input id="on_retail" type="checkbox" name="on_retail" checked="">
                                        <label>Розницу</label>
                                    </div>
                                    <div class="ui checkbox">
                                        <input id="on_wholesale" type="checkbox" name="on_wholesale">
                                        <label>Опт</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Описание</label>
                        <textarea id="description" placeholder="Описание" rows="2"></textarea>
                    </div>
                    <label>
                        <b>Период действия:
                            <a class="date_period" href="#"
                               data-text="{{ \Carbon\Carbon::now()->tomorrow()->toDateString() }}">&nbsp;день&nbsp;</a>
                            <a class="date_period" href="#"
                               data-text="{{ \Carbon\Carbon::now()->addDay(2)->toDateString() }}">&nbsp;2 дня&nbsp;</a>
                            <a class="date_period" href="#"
                               data-text="{{ \Carbon\Carbon::now()->addDay(7)->toDateString() }}">&nbsp;неделю&nbsp;</a>
                            <a class="date_period" href="#"
                               data-text="{{ \Carbon\Carbon::now()->addDay(30)->toDateString() }}">&nbsp;месяц&nbsp;</a>
                        </b>
                    </label>
                    <div class="ui message">
                        <div class="two fields">
                            <div class="field">
                                <label>Начало</label>
                                <input id="on_date" placeholder="Начало" type="text"
                                       value="{{ \Carbon\Carbon::now()->toDateString() }}">
                                <label class="small">
                                    <a class="date_start" href="#"
                                       data-text="{{ \Carbon\Carbon::now()->toDateString()  }}">&nbsp;сегодня&nbsp;</a>
                                    <a class="date_start" href="#"
                                       data-text="{{ \Carbon\Carbon::tomorrow()->toDateString()  }}">&nbsp;завтра&nbsp;</a>
                                </label>
                            </div>
                            <div class="field">
                                <label>Конец</label>
                                <input id="off_date" placeholder="Конец" type="text">
                                <label class="small">
                                    <a class="date_end" href="#"
                                       data-text="{{ \Carbon\Carbon::tomorrow()->toDateString()  }}">&nbsp;до завтра&nbsp;</a>
                                    <a class="date_end" href="#"
                                       data-text="{{ \Carbon\Carbon::now()->endOfWeek()->toDateString()  }}">&nbsp;до
                                        конца недели&nbsp;</a>
                                    <a class="date_end" href="#"
                                       data-text="{{ \Carbon\Carbon::now()->endOfMonth()->toDateString()  }}">&nbsp;до
                                        конца месяца&nbsp;</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="info message"></div>

            </div>

        </div>
        <div class="actions">
            <div class="ui red button">Отмена</div>
            <input type="submit" id="add_promotion" class="ui green ok button" value="Создать">
            </form>
        </div>

    </div>

@endsection


@section('page_scripts')


@endsection


@section('script')
    <script>
        $('.menu .item').tab();

        $('.dropdown').dropdown();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#category').on('change', function () {
            var selected = $(this).find("option:selected").val();

            console.log(selected);

            var search_url = $("#hidden_search").val();

            $.ajax({
                url: search_url,
                type: "POST",
                data: {
                    "category": selected,
                },
                beforeSend: function () {

                },
                success: function (response) {

                    $('#div_sub_cat').html(response);
                    $('#sub_category').dropdown('refresh');

                }
            });
        });

        $('#semantic_button').click(function (e) {
            e.preventDefault();
            var formdata = $("#data").serialize();
            $.ajax({
                url: "/good/update",
                type: 'POST',
                data: formdata,
                beforeSend: function () {

                    $("#semantic_button").addClass('loading');
                    $('#dimmer').dimmer('show');
                },
                success: function () {
                    $("#name_product").text($("#current_name").val());
                    $("#name_product_card").text($("#current_name").val());
                    setTimeout(function () {
                        $("#semantic_button").removeClass('loading');
                        $('.segment').dimmer('hide');
                    }, 1000);

                },
            });
        });


        //        акции

        $('#button_new_promotion').on('click', function () {

            $('#new_promotion').modal('show');
        });

        $("#new_promotion").modal({
            onApprove: function () {
                $("#form_new_promotion")
                    .form({
                        fields: {
                            name: {
                                identifier: 'name',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Введите имя'
                                    }
                                ]
                            },
                            description: {
                                identifier: 'description',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Введите описание'
                                    }
                                ]
                            },
                            percent: {
                                identifier: 'percent',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Введите процент'
                                    }
                                ]
                            },
                            on_date: {
                                identifier: 'on_date',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Введите дату начала акции'
                                    }
                                ]
                            },
                        }
                    });
                if ($("#form_new_promotion").form('is valid')) {

                    $("#form_new_promotion").on('submit', function (e) {
                        e.preventDefault();
                        $('#new_promotion').modal('hide');
                    });

                    render_table();

                }
                return false;
            }
        });



        function render_table() {

            var id = $('#id_product').val();

            if ($('#name').val()) {

                var name = $('#name').val();
                var description = $('#description').val();
                var percent = $('#percent').val();
                var on_date = $('#on_date').val();
                var off_date = $('#off_date	').val();

                if ($('#on_retail:checked').prop("checked")) {
                    var on_retail = 1;
                }
                else {
                    var on_retail = 0;
                }

                if ($('#on_wholesale:checked').prop("checked")) {
                    var on_wholesale = 1;
                }
                else {
                    var on_wholesale = 0;
                }
            }


            $.ajax({
                url: "{{ route('new_promotion') }}",
                type: 'POST',
                data: {
                    id: id,
                    name: name,
                    description: description,
                    percent: percent,
                    on_date: on_date,
                    off_date: off_date,
                    on_retail: on_retail,
                    on_wholesale: on_wholesale,

                },

                beforeSend: function () {

                },
                success: function (response) {

                    $('#result_table').html(response);
                },
            });

        }

        function stop_promotion(id_promotion) {
            $.ajax({
                url: "{{ route('new_promotion') }}",
                type: 'POST',
                data: {
                    id: id,
                    name: name,
                    description: description,
                    percent: percent,
                    on_date: on_date,
                    off_date: off_date,
                    on_retail: on_retail,
                    on_wholesale: on_wholesale,

                },

                beforeSend: function () {

                },
                success: function (response) {

                    $('#result_table').html(response);
                },
            });
        }


        //        установка даты в поля

        $('.date_start').on('click', function () {
            $('#on_date').val($(this).data('text'))
        });

        $('.date_end').on('click', function () {
            $('#off_date').val($(this).data('text'))
        });

        $('.date_period').on('click', function () {
            $('#on_date').val("{{ \Carbon\Carbon::now()->toDateString() }}");
            $('#off_date').val($(this).data('text'))
        });

        render_table();
        //конец акций




    </script>
@endsection


