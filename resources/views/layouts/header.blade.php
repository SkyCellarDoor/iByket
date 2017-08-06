<!DOCTYPE html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- Добавление CSS для красивого select (выпадающий список) -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="/js/select/bootstrap-select.min.js"></script>

    <!-- Добавление календаря -->
    <script type="text/javascript" src="/calendar/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/calendar/js/locales/bootstrap-datetimepicker.ru.js" charset="UTF-8"></script>
    <link href="/calendar/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <!-- Добавление moment.js для работы с датами -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/ru.js"></script>

    <!-- Добавление красивого radio button (Bootstrap Switch) -->
    <script type="text/javascript" src="/b_switch/js/bootstrap-switch.js" charset="UTF-8"></script>
    <link href="/b_switch/css/bootstrap-switch.css" rel="stylesheet" media="screen">


</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Мира 85</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li @if ( Route::current()->getName() === 'home'  )
                    class="active"
                    @endif ><a href="/home">Основная</a></li>
                <li @if ( Route::current()->getName() === 'sell'  )
                    class="active"
                    @endif ><a href="/sell">Продажа</a></li>
                <li @if ( Route::current()->getName() === 'order'  )
                    class="active"
                    @endif ><a href="/order">Заказ</a></li>
                <li @if ( Route::current()->getName() === 'clients'  )
                    class="active"
                        @endif ><a href="/clients">Клиенты</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Склад <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/storage">Просмотр</a></li>
                        <li @if ( Route::current()->getName() === 'invoice'  )
                            class="active"
                             @endif><a href="/invoices_view">Накладные</a></li>
                        <li class="divider"></li>
                        <li @if ( Route::current()->getName() === 'invoice_goods'  )
                            class="active"
                                @endif>
                            <a href="{{ route('invoice_goods') }}">Поступление</a></li>
                        <li><a href="/move_good">Перемещение</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Настройки</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Выход</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@yield('content')

</body>
</html>


