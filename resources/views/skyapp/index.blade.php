<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>SkyApp</title>
    <meta name="description" content="">
    <meta name="viewport"    content=" width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->

    <link href="{{ asset("semantic/") }}/css/semantic.css" rel="stylesheet" type="text/css" />
    {{--<link href="{{ asset("semantic/") }}/css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset("semantic/") }}/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("semantic/") }}/css/daterangepicker.css" rel="stylesheet" type="text/css"/>


    <!-- endbower -->
    <!-- endbuild -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,300&subset=latin,vietnamese' rel='stylesheet' type='text/css'>


<body style="padding: 10px; background: #e5e5e5;">
{{--@php--}}
{{--phpinfo();--}}
{{--@endphp--}}

@if(\Auth::user()->role == 5)
<div class="ui tiny menu " style="padding: 0px;">
    <a class="item" href="{{ route('home') }}">Домой </a>
    <a class="item" href="{{ route('shift') }}">Смена </a>
    <a class="item" href="{{ route('order') }}">Заказы</a>
    <div class="menu">
        <div class="ui dropdown item">Продажи<i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="{{ route('sell') }}">Продажа</a>
                <a class="item" href="{{ route('sells_list') }}">Список</a>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class="ui dropdown item">Финансы<i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="{{ route('costs') }}">Расходы</a>
                <a class="item" href="{{ route('bills') }}">Счета</a>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class="ui dropdown item">Склад<i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="{{ route('invoice_list') }}">Поступления</a>
                <div class="item">
                    <i class="dropdown icon"></i>
                    <span class="text">Товары</span>
                    <div class="right menu">
                        <a class="item" href="{{ route('list_products') }}">Склад товара</a>
                        <a class="item" href="{{ route('list_goods') }}">Наименования</a>
                        <a class="item" href="{{ route('move_products_list') }}">Перемещения</a>
                        <a class="item" href="{{ route('income_move_product') }}">Входящие перемещения</a>
                    </div>
                </div>
                <div class="item">
                    <i class="dropdown icon"></i>
                    <span class="text">Поставщики</span>
                    <div class="right menu">
                        <a class="item" href="{{ route('list_providers') }}">Список</a>
                        <div class="item">Возврат товара</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="left menu">
        <div class="ui dropdown item">Аналитика<i class="dropdown icon"></i>
            <div class="menu">
                <div class="item">
                    <i class="dropdown icon"></i>
                    <span class="text">Клиенты</span>
                    <div class="right menu">
                        <a class="item" href="{{ route('promise_client') }}">Должники</a>
                    </div>
                </div>
                <a class="item" href="">Финансы</a>
            </div>
        </div>
    </div>

    <div class="right menu">
        <a class="item" style="padding: 7px">
            <div class="ui category search" >
                <div class="ui icon input" >
                    <input class="prompt" type="text" placeholder="Поиск клиентов" >
                    <i class="search icon"></i>
                </div>
                <div class="results"></div>
            </div>
        </a>
        <a class="ui item">
            Сообщения
        </a>
        <div class="ui dropdown item">{{ \Auth::user()->name }}<i class="dropdown icon"></i>
            <div class="menu">
                <a class="item">Аккаунт</a>
                <a class="item">Настройки</a>
                <div class="divider"></div>
                <a href="{{ route('logout') }}" class="item">Выход</a>
            </div>
        </div>
    </div>
</div>







@elseif(\Auth::user()->role == 3)
    <div class="ui menu">
        <a class="item" href="{{ route('home') }}">Домой </a>
        <a class="item" href="{{ route('shift') }}">Смена </a>
        <div class="menu">
            <div class="ui dropdown item">Продажи<i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="{{ route('sell') }}">Продажа</a>
                    <a class="item" href="{{ route('sells_list') }}">Список</a>
                </div>
            </div>
        </div>
        <a class="item" href="{{ route('order') }}">Заказы</a>

        <div class="menu">
            <div class="ui dropdown item">Склад<i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item">
                        <i class="dropdown icon"></i>
                        <span class="text">Товары</span>
                        <div class="right menu">
                            <a class="item" href="{{ route('list_products') }}">Склад товара</a>
                            <a class="item" href="{{ route('list_goods') }}">Наименования</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="right menu">
            <a class="item" style="padding: 7px">
                <div class="ui category search" >
                    <div class="ui icon input" >
                        <input class="prompt" type="text" placeholder="Поиск" >
                        <i class="search icon"></i>
                    </div>
                    <div class="results"></div>
                </div>
            </a>
            <a class="item">Сообщения </a>
            <div class="ui dropdown item">{{ \Auth::user()->name }}<i class="dropdown icon"></i> <div class="menu">
                    <a class="item">Аккаунт</a>
                    <a class="item">Настройки</a>
                    <div class="divider"></div>
                    <a class="item">Выход</a>
                </div>
            </div>
        </div>
    </div>

@endif


{{--модальное окно создания клиента--}}

<div id="new_client" class="ui tiny modal">
    <i class="close icon"></i>
    <div class="header">
        Новый клиент
    </div>
    <div class="content">
        <form action="{{route('create_client')}}" method="post">
            {{ csrf_field() }}
        <div class="ui fields form">
            <div class="field">
                <label>Имя Фамилия</label>
                <input id="name_client" name="name" placeholder="Имя Фамилия" type="text">
            </div>
            <div class="six wide column field">
                <label>Номер телефона</label>
                <div class="ui labeled input">
                    <label for="amount" class="ui label">+7</label>
                    <input type="text" name="phone" placeholder="Номер телефона" id="phone">
                </div>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui button">
            Отмена
        </div>
        <input class="ui teal button" type="submit" value="Создать">
    </form>
    </div>
</div>

{{--модальное окно создания клиента--}}


@yield('content')



<script src="{{ asset("/semantic/") }}/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="{{ asset("/semantic/") }}/js/semantic.js" type="text/javascript"></script>
{{--<script src="{{ asset("/semantic/") }}/js/jquery.datetimepicker.full.js" type="text/javascript"></script>--}}
<script src="{{ asset("/semantic/") }}/js/select2.full.js" type="text/javascript"></script>
<script src="{{ asset("/semantic/") }}/js/jquery.mask.js" type="text/javascript"></script>
<script src="{{ asset("/semantic/") }}/js/moment.js" type="text/javascript"></script>
<script src="{{ asset("/semantic/") }}/js/daterangepicker.js" type="text/javascript"></script>


@yield('page_scripts')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $(".dropdown").dropdown();

    $('.ui.search').search({
        apiSettings: {
            url: '/search_json/{query}'
        },
        fields: {
            title   : 'name',
            price     : 'bill',
            description: 'phone',
            url: 'id',
        },
        minCharacters : 3,
        maxResults: 10,
        error : {
            source      : 'Cannot search. No source used, and Semantic API module was not included',
            noResults   : '<h5 class="ui center aligned header">Не найдено</h5>' +
            '<input id="new_client_input" class="ui fluid teal button" value="Создать" onclick="new_clients()">',
            logging     : 'Error in debug logging, exiting.',
            noTemplate  : 'A valid template name was not specified.',
            serverError : 'There was an issue with querying the server.',
            maxResults  : 'Results must be an array to use maxResults setting',
            method      : 'The method you called is not defined.'
        },
    });


    function new_clients() {

        $('.ui.search').search('hide results');

        $('#name_client').val($('.prompt').val());

        $('.prompt').val('');

        $('#phone').mask('(000)-000-00-00', {placeholder: "(000)-000-00-00"});
        $('#new_client').modal('show');
    }

</script>


@yield('script')

</body>
</html>