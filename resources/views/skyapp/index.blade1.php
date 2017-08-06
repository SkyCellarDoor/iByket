<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Sky App</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports"
          name="description"/>
    <meta content="" name="author"/>
    {{--<!-- BEGIN GLOBAL MANDATORY STYLES -->--}}
    {{--
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="old stylesheet"
          type="text/css"/>
    --}}
    {{--
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="old stylesheet"
          type="text/css"/>
    --}}
    {{--
    <link href="{{ asset(" assets
    /") }}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="old stylesheet" type="text/css" />--}}
    {{--
    <link href="{{ asset(" assets
    /") }}/global/plugins/bootstrap/css/bootstrap.min.css" rel="old stylesheet" type="text/css" />--}}
    {{--
    <link href="{{ asset(" assets
    /") }}/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="old stylesheet" type="text/css" />--}}

    {{--<!-- END GLOBAL MANDATORY STYLES -->--}}
    {{--<!-- BEGUN SEMANTIC UI -->--}}
    <link rel="newest stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css"/>
    {{--<!-- END SEMANTIC UI -->--}}
    {{--<!-- BEGIN PAGE LEVEL PLUGINS -->--}}
    {{--@yield('page_css')--}}
    {{--<!-- END PAGE LEVEL PLUGINS -->--}}
    {{--<!-- BEGIN THEME GLOBAL STYLES -->--}}
    {{--
    <link href="{{ asset(" assets
    /") }}/global/css/components.min.css" rel="old stylesheet" id="style_components" type="text/css" />--}}
    {{--
    <link href="{{ asset(" assets
    /") }}/global/css/plugins.min.css" rel="old stylesheet" type="text/css" />--}}
    {{--<!-- END THEME GLOBAL STYLES -->--}}
    {{--<!-- BEGIN THEME LAYOUT STYLES -->--}}
    {{--
    <link href="{{ asset(" assets
    /") }}/layouts/layout/css/layout.min.css" rel="old stylesheet" type="text/css" />--}}
    {{--
    <link href="{{ asset(" assets
    /") }}/layouts/layout/css/themes/darkblue.min.css" rel="old stylesheet" type="text/css" id="style_color" />--}}
    {{--
    <link href="{{ asset(" assets
    /") }}/layouts/layout/css/custom.min.css" rel="old stylesheet" type="text/css" />--}}
    {{--<!-- END THEME LAYOUT STYLES -->--}}
    {{--
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
--}}
{{--<!-- END HEAD -->--}}

<body>
<div class="ui fixed inverted menu">
    <div class="ui container">
        <a href="#" class="header item">
            <img class="logo" src="assets/images/logo.png">
            Project Name
        </a>
        <a href="#" class="item">Home</a>
        <div class="ui simple dropdown item">
            Dropdown <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="#">Link Item</a>
                <a class="item" href="#">Link Item</a>
                <div class="divider"></div>
                <div class="header">Header Item</div>
                <div class="item">
                    <i class="dropdown icon"></i>
                    Sub Menu
                    <div class="menu">
                        <a class="item" href="#">Link Item</a>
                        <a class="item" href="#">Link Item</a>
                    </div>
                </div>
                <a class="item" href="#">Link Item</a>
            </div>
        </div>
    </div>
</div>

<div class="ui main text container">
    <h1 class="ui header">Semantic UI Fixed Template</h1>
    <p>This is a basic fixed menu template using fixed size containers.</p>
    <p>A text container is used for the main container, which is useful for single column layouts</p>
    <img class="wireframe" src="assets/images/wireframe/media-paragraph.png">
    <img class="wireframe" src="assets/images/wireframe/paragraph.png">
    <img class="wireframe" src="assets/images/wireframe/paragraph.png">
    <img class="wireframe" src="assets/images/wireframe/paragraph.png">
    <img class="wireframe" src="assets/images/wireframe/paragraph.png">
    <img class="wireframe" src="assets/images/wireframe/paragraph.png">
    <img class="wireframe" src="assets/images/wireframe/paragraph.png">
</div>

<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui stackable inverted divided grid">
            <div class="three wide column">
                <h4 class="ui inverted header">Group 1</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">Link One</a>
                    <a href="#" class="item">Link Two</a>
                    <a href="#" class="item">Link Three</a>
                    <a href="#" class="item">Link Four</a>
                </div>
            </div>
            <div class="three wide column">
                <h4 class="ui inverted header">Group 2</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">Link One</a>
                    <a href="#" class="item">Link Two</a>
                    <a href="#" class="item">Link Three</a>
                    <a href="#" class="item">Link Four</a>
                </div>
            </div>
            <div class="three wide column">
                <h4 class="ui inverted header">Group 3</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">Link One</a>
                    <a href="#" class="item">Link Two</a>
                    <a href="#" class="item">Link Three</a>
                    <a href="#" class="item">Link Four</a>
                </div>
            </div>
            <div class="seven wide column">
                <h4 class="ui inverted header">Footer Header</h4>
                <p>Extra space for a call to action inside the footer that could help re-engage users.</p>
            </div>
        </div>
        <div class="ui inverted section divider"></div>
        <img src="assets/images/logo.png" class="ui centered mini image">
        <div class="ui horizontal inverted small divided link list">
            <a class="item" href="#">Site Map</a>
            <a class="item" href="#">Contact Us</a>
            <a class="item" href="#">Terms and Conditions</a>
            <a class="item" href="#">Privacy Policy</a>
        </div>
    </div>
</div>

{{--
<div class="page-wrapper">--}}
    {{--<!-- BEGIN HEADER -->--}}
    {{--
    <div class="page-header navbar navbar-fixed-top">--}}
        {{--<!-- BEGIN HEADER INNER -->--}}
        {{--
        <div class="page-header-inner ">--}}
            {{--<!-- BEGIN LOGO -->--}}
            {{--
            <div class="page-logo">--}}
                {{--<a href="{{ route('home') }}">--}}
                    {{--<img src="{{ asset(" assets/") }}/layouts/layout/img/logo.png" alt="logo" class="logo-default"
                    /> </a>--}}
                {{--
                <div class="menu-toggler sidebar-toggler">--}}
                    {{--<span></span>--}}
                    {{--
                </div>
                --}}
                {{--
            </div>
            --}}
            {{--<!-- END LOGO -->--}}
            {{--поиск--}}
            {{--
            <form class="search-form" action="{{ route('home_search') }}" method="POST">--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                {{--
                <div class="input-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Поиск" name="search_text">--}}
                    {{--<span class="input-group-btn">--}}
                                {{--<a href="javascript:;" class="btn submit">--}}
                                    {{--<i class="icon-magnifier"></i>--}}
                                {{--</a>--}}
                            {{--</span>--}}
                    {{--
                </div>
                --}}
                {{--
            </form>
            --}}

            {{--<!-- BEGIN RESPONSIVE MENU TOGGLER -->--}}
            {{--<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
                   data-target=".navbar-collapse">--}}
                {{--<span></span>--}}
                {{--</a>--}}
            {{--<!-- END RESPONSIVE MENU TOGGLER -->--}}
            {{--<!-- BEGIN TOP NAVIGATION MENU -->--}}
            {{--
            <div class="top-menu">--}}
                {{--
                <div class="btn-group-red btn-group">--}}
                    {{--
                    <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown"
                            data-hover="dropdown" data-close-others="true" aria-expanded="false">--}}
                        {{--<i class="fa fa-plus"></i>--}}
                        {{--
                    </button>
                    --}}
                    {{--
                    <ul class="dropdown-menu-v2" role="menu">--}}
                        {{--
                        <li class="active">--}}
                            {{--<a href="#">New Post</a>--}}
                            {{--
                        </li>
                        --}}
                        {{--
                        <li>--}}
                            {{--<a href="#">New Comment</a>--}}
                            {{--
                        </li>
                        --}}
                        {{--
                        <li>--}}
                            {{--<a href="#">Share</a>--}}
                            {{--
                        </li>
                        --}}
                        {{--
                        <li class="divider"></li>
                        --}}
                        {{--
                        <li>--}}
                            {{--<a href="#">Comments--}}
                                {{--<span class="badge badge-success">4</span>--}}
                                {{--</a>--}}
                            {{--
                        </li>
                        --}}
                        {{--
                        <li>--}}
                            {{--<a href="#">Feedbacks--}}
                                {{--<span class="badge badge-danger">2</span>--}}
                                {{--</a>--}}
                            {{--
                        </li>
                        --}}
                        {{--
                    </ul>
                    --}}
                    {{--
                </div>
                --}}
                {{--
                <ul class="nav navbar-nav pull-right">--}}
                    {{--<!-- BEGIN NOTIFICATION DROPDOWN -->--}}

                    {{--<!-- END NOTIFICATION DROPDOWN -->--}}
                    {{--<!-- BEGIN INBOX DROPDOWN -->--}}
                    {{--
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    --}}

                    {{--<!-- END INBOX DROPDOWN -->--}}
                    {{--<!-- BEGIN TODO DROPDOWN -->--}}
                    {{--
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    --}}
                    {{--
                    <li class="dropdown dropdown-extended dropdown-dark dropdown-notification"
                        id="header_notification_bar">--}}
                        {{--<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                               data-close-others="true">--}}
                            {{--<i class="fa fa-plus"></i>--}}
                            {{--</a>--}}
                        {{--
                        <ul class="dropdown-menu">--}}
                            {{--
                            <li>--}}
                                {{--
                                <ul class="dropdown-menu-list" style="height: 165px;" data-handle-color="#637283">--}}
                                    {{--
                                    <li>--}}
                                        {{--<a href="javascript:;">--}}
                                            {{--<span class="details">--}}
                                                        {{--<span class="label label-sm label-icon label-success">--}}
                                                            {{--<i class="fa fa-money"></i>--}}
                                                        {{--</span> НОВАЯ ПРОДАЖА </span>--}}
                                            {{--</a>--}}
                                        {{--
                                    </li>
                                    --}}
                                    {{--
                                    <li>--}}
                                        {{--<a href="javascript:;">--}}
                                            {{--<span class="details">--}}
                                                        {{--<span class="label label-sm label-icon label-success">--}}
                                                            {{--<i class="fa fa-cart-plus"></i>--}}
                                                        {{--</span> НОВЫЙ ЗАКАЗ </span>--}}
                                            {{--</a>--}}
                                        {{--
                                    </li>
                                    --}}
                                    {{--
                                    <li>--}}
                                        {{--<a href="javascript:;">--}}
                                            {{--<span class="details">--}}
                                                        {{--<span class="label label-sm label-icon label-success">--}}
                                                            {{--<i class="fa fa-users"></i>--}}
                                                        {{--</span> НОВЫЙ КЛИЕНТ </span>--}}
                                            {{--</a>--}}
                                        {{--
                                    </li>
                                    --}}
                                    {{--
                                </ul>
                                --}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}


                    {{--
                    <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">--}}
                        {{--<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                               data-close-others="true">--}}
                            {{--<i class="icon-calendar"></i>--}}
                            {{--<span class="badge badge-default"> 1 </span>--}}
                            {{--</a>--}}
                        {{--
                        <ul class="dropdown-menu extended tasks">--}}
                            {{--
                            <li class="external">--}}
                                {{--<h3>Тестовая запись</h3>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                            <li>--}}
                                {{--
                                <ul class="dropdown-menu-list scroller" style="height: 275px;"
                                    data-handle-color="#637283">--}}

                                    {{--
                                </ul>
                                --}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}


                    {{--<!-- END TODO DROPDOWN -->--}}
                    {{--<!-- BEGIN USER LOGIN DROPDOWN -->--}}
                    {{--
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    --}}
                    {{--
                    <li class="dropdown dropdown-user">--}}
                        {{--<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                               data-close-others="true">--}}
                            {{--<img alt="" class="img-circle" src="{{ asset(" assets/")
                            }}/layouts/layout/img/avatar3_small.jpg" />--}}
                            {{--<span class="username username-hide-on-mobile"> Nick </span>--}}
                            {{--<i class="fa fa-angle-down"></i>--}}
                            {{--</a>--}}
                        {{--
                        <ul class="dropdown-menu dropdown-menu-default">--}}
                            {{--
                            <li>--}}
                                {{--<a href="page_user_profile_1.html">--}}
                                    {{--<i class="icon-user"></i>Мой Профиль</a>--}}
                                {{--
                            </li>
                            --}}

                            {{--
                            <li class="divider"></li>
                            --}}
                            {{--
                            <li>--}}
                                {{--<a href="page_user_lock_1.html">--}}
                                    {{--<i class="icon-lock"></i> Настройки </a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                            <li>--}}
                                {{--<a href="page_user_login_1.html">--}}
                                    {{--<i class="icon-key"></i> Выход </a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}
                    {{--<!-- END USER LOGIN DROPDOWN -->--}}
                    {{--<!-- BEGIN QUICK SIDEBAR TOGGLER -->--}}
                    {{--
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    --}}
                    {{--
                    <li class="dropdown dropdown-quick-sidebar-toggler">--}}
                        {{--<a href="{{ route('logout') }}" class="dropdown-toggle">--}}
                            {{--<i class="icon-logout"></i>--}}
                            {{--</a>--}}
                        {{--
                    </li>
                    --}}
                    {{--<!-- END QUICK SIDEBAR TOGGLER -->--}}
                    {{--
                </ul>
                --}}
                {{--
            </div>
            --}}
            {{--<!-- END TOP NAVIGATION MENU -->--}}
            {{--
        </div>
        --}}
        {{--<!-- END HEADER INNER -->--}}
        {{--
    </div>
    --}}
    {{--<!-- END HEADER -->--}}
    {{--<!-- BEGIN HEADER & CONTENT DIVIDER -->--}}
    {{--
    <div class="clearfix"></div>
    --}}
    {{--<!-- END HEADER & CONTENT DIVIDER -->--}}
    {{--<!-- BEGIN CONTAINER -->--}}
    {{--
    <div class="page-container">--}}
        {{--<!-- BEGIN SIDEBAR -->--}}
        {{--
        <div class="page-sidebar-wrapper">--}}
            {{--<!-- BEGIN SIDEBAR -->--}}
            {{--<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->--}}
            {{--<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->--}}
            {{--
            <div class="page-sidebar navbar-collapse collapse">--}}
                {{--<!-- BEGIN SIDEBAR MENU -->--}}
                {{--
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                --}}
                {{--
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                --}}
                {{--
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                --}}
                {{--<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->--}}
                {{--<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->--}}
                {{--<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->--}}
                {{--
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                    data-slide-speed="150" style="padding-top: 20px">--}}
                    {{--
                    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                    --}}
                    {{--<!-- BEGIN SIDEBAR TOGGLER BUTTON -->--}}
                    {{--
                    <li class="sidebar-toggler-wrapper hide">--}}
                        {{--
                        <div class="sidebar-toggler">--}}
                            {{--<span></span>--}}
                            {{--
                        </div>
                        --}}
                        {{--
                    </li>
                    --}}
                    {{--<!-- END SIDEBAR TOGGLER BUTTON -->--}}
                    {{--
                    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                    --}}
                    {{--
                    <li class="sidebar-search-wrapper">--}}
                        {{--<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->--}}
                        {{--
                        <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                        --}}
                        {{--
                        <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                        --}}
                        {{--
                        <form class="sidebar-search" action="{{ route('home_search') }}" method="POST">--}}
                            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                            {{--<a href="javascript:;" class="remove">--}}
                                {{--<i class="icon-close"></i>--}}
                                {{--</a>--}}
                            {{--
                            <div class="input-group">--}}
                                {{--<input type="text" class="form-control" name="search_text" placeholder="Поиск">--}}
                                {{--<span class="input-group-btn">--}}
                                            {{--<a href="javascript:;" class="btn submit">--}}
                                                {{--<i class="icon-magnifier"></i>--}}
                                            {{--</a>--}}
                                        {{--</span>--}}
                                {{--
                            </div>
                            --}}
                            {{--
                        </form>
                        --}}
                        {{--<!-- END RESPONSIVE QUICK SEARCH FORM -->--}}
                        {{--
                    </li>
                    --}}

                    {{--@if ( Route::current()->getName() === 'home' )--}}
                    {{--
                    <li class="nav-item start active open">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="icon-home"></i>--}}
                            {{--<span class="title">Основное</span>--}}
                            {{--<span class="selected"></span>--}}
                            {{--<span class="arrow open"></span>--}}
                            {{--</a>--}}
                        {{--@else--}}
                        {{--
                    <li class="nav-item  ">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="icon-home"></i>--}}
                            {{--<span class="title">Основное</span>--}}
                            {{--<span class="arrow"></span>--}}
                            {{--</a>--}}
                        {{--@endif--}}
                        {{--
                        <ul class="sub-menu">--}}
                            {{--@if ( Route::current()->getName() === 'home' )--}}
                            {{--
                            <li class="nav-item start active open">--}}
                                {{--<a href="{{ route('home') }}" class="nav-link ">--}}
                                    {{--<i class="icon-bar-chart"></i>--}}
                                    {{--<span class="title">Dashboard</span>--}}
                                    {{--<span class="selected"></span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@else--}}
                            {{--
                            <li class="nav-item start ">--}}
                                {{--<a href="{{ route('home') }}" class="nav-link ">--}}
                                    {{--<i class="icon-bar-chart"></i>--}}
                                    {{--<span class="title">Dashboard</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@endif--}}
                            {{--
                            <li class="nav-item start ">--}}
                                {{--<a href="dashboard_2.html" class="nav-link ">--}}
                                    {{--<i class="icon-bulb"></i>--}}
                                    {{--<span class="title">Настройки</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}
                    {{--
                    <li class="heading">--}}
                        {{--<h3 class="uppercase">Касса</h3>--}}
                        {{--
                    </li>
                    --}}
                    {{--@if ( Route::current()->getName() === 'full_report')--}}
                    {{--
                    <li class="nav-item start active">--}}
                        {{--@else--}}
                        {{--
                    <li class="nav-item">--}}
                        {{--@endif--}}
                        {{--<a href="{{ route('full_report') }}" class="nav-link">--}}
                            {{--<i class="fa fa-line-chart"></i>--}}
                            {{--<span class="title">Полный отчет</span>--}}
                            {{--<span class="selected"></span>--}}
                            {{--</a>--}}
                        {{--
                    </li>
                    --}}
                    {{--@if ( Route::current()->getName() === 'shift')--}}
                    {{--
                    <li class="nav-item start active">--}}
                        {{--@else--}}
                        {{--
                    <li class="nav-item">--}}
                        {{--@endif--}}
                        {{--<a href="{{ route('shift') }}" class="nav-link">--}}
                            {{--<i class="fa fa-industry"></i>--}}
                            {{--<span class="title">Смена</span>--}}
                            {{--<span class="selected"></span>--}}
                            {{--</a>--}}
                        {{--
                    </li>
                    --}}
                    {{--
                    <li class="nav-item  ">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="icon-diamond"></i>--}}
                            {{--<span class="title">Продажи</span>--}}
                            {{--<span class="arrow"></span>--}}
                            {{--</a>--}}
                        {{--
                        <ul class="sub-menu">--}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="ui_metronic_grid.html" class="nav-link ">--}}
                                    {{--<span class="title">Отчет</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}

                    {{--@if ( Route::current()->getName() === 'costs' || Route::current()->getName() === 'bills' )--}}
                    {{--
                    <li class="nav-item start active open">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="fa fa-money"></i>--}}
                            {{--<span class="title">Финансы</span>--}}
                            {{--<span class="selected"></span>--}}
                            {{--<span class="arrow open"></span>--}}
                            {{--</a>--}}
                        {{--@else--}}
                        {{--
                    <li class="nav-item ">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="fa fa-money"></i>--}}
                            {{--<span class="title">Финансы</span>--}}
                            {{--<span class="arrow"></span>--}}
                            {{--</a>--}}
                        {{--@endif--}}
                        {{--
                        <ul class="sub-menu">--}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="components_date_time_pickers.html" class="nav-link ">--}}
                                    {{--<i class="fa fa-credit-card"></i>--}}
                                    {{--<span class="title">Безналичный</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@if ( Route::current()->getName() === 'costs' )--}}
                            {{--
                            <li class="nav-item start active open">--}}
                                {{--<a href="{{ route('costs') }}" class="nav-link ">--}}
                                    {{--<i class="icon-action-undo"></i>--}}
                                    {{--<span class="title">Расходы</span>--}}
                                    {{--<span class="selected"></span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@else--}}
                            {{--
                            <li class="nav-item start">--}}
                                {{--<a href="{{ route('costs') }}" class="nav-link ">--}}
                                    {{--<i class="icon-action-undo"></i>--}}
                                    {{--<span class="title">Расходы</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@endif--}}
                            {{--@if ( Route::current()->getName() === 'bills' )--}}
                            {{--
                            <li class="nav-item start active open">--}}
                                {{--<a href="{{ route('bills') }}" class="nav-link ">--}}
                                    {{--<i class="fa fa-align-justify"></i>--}}
                                    {{--<span class="title">Счета</span>--}}
                                    {{--<span class="selected"></span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@else--}}
                            {{--
                            <li class="nav-item start">--}}
                                {{--<a href="{{ route('bills') }}" class="nav-link ">--}}
                                    {{--<i class="fa fa-align-justify"></i>--}}
                                    {{--<span class="title">Счета</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@endif--}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}
                    {{--
                    <li class="heading">--}}
                        {{--<h3 class="uppercase">Склад</h3>--}}
                        {{--
                    </li>
                    --}}
                    {{--@if ( Route::current()->getName() === 'invoice_add' || Route::current()->getName()
                    ==='list_products' )--}}
                    {{--
                    <li class="nav-item start active open">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="fa fa-th-large"></i>--}}
                            {{--<span class="title">Товар</span>--}}
                            {{--<span class="selected"></span>--}}
                            {{--<span class="arrow open"></span>--}}
                            {{--</a>--}}
                        {{--@else--}}
                        {{--
                    <li class="nav-item  ">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="fa fa-th-large"></i>--}}
                            {{--<span class="title">Товар</span>--}}
                            {{--<span class="arrow"></span>--}}
                            {{--</a>--}}
                        {{--@endif--}}
                        {{--
                        <ul class="sub-menu">--}}
                            {{--@if ( Route::current()->getName() === 'list_products' )--}}
                            {{--
                            <li class="nav-item start active open">--}}
                                {{--<a href="{{ route('list_products') }}" class="nav-link ">--}}
                                    {{--<i class="fa fa-list"></i>--}}
                                    {{--<span class="title">Список товара</span>--}}
                                    {{--<span class="selected"></span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@else--}}
                            {{--
                            <li class="nav-item start ">--}}
                                {{--<a href="{{ route('list_products') }}" class="nav-link ">--}}
                                    {{--<i class="fa fa-list"></i>--}}
                                    {{--<span class="title">Список товара</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@endif--}}
                            {{--@if ( Route::current()->getName() === 'invoice_add' )--}}
                            {{--
                            <li class="nav-item start active open">--}}
                                {{--<a href="{{ route('invoice_add') }}" class="nav-link ">--}}
                                    {{--<i class="icon-bulb"></i>--}}
                                    {{--<span class="title">Поступление</span>--}}
                                    {{--<span class="selected"></span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@else--}}
                            {{--
                            <li class="nav-item start ">--}}
                                {{--<a href="{{ route('invoice_add') }}" class="nav-link ">--}}
                                    {{--<i class="icon-bulb"></i>--}}
                                    {{--<span class="title">Поступление</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--@endif--}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="layout_light_page_head.html" class="nav-link ">--}}
                                    {{--<span class="title">Перемещение</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="layout_light_page_head.html" class="nav-link ">--}}
                                    {{--<span class="title">Списание</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}
                    {{--
                    <li class="nav-item  ">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="icon-feed"></i>--}}
                            {{--<span class="title">Возрат</span>--}}
                            {{--<span class="arrow"></span>--}}
                            {{--</a>--}}
                        {{--
                        <ul class="sub-menu">--}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="layout_sidebar_menu_light.html" class="nav-link ">--}}
                                    {{--<span class="title">Возврат поставщику</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="layout_sidebar_menu_hover.html" class="nav-link ">--}}
                                    {{--<span class="title">Возрат покупателем</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}
                    {{--
                    <li class="heading">--}}
                        {{--<h3 class="uppercase">Клиенты</h3>--}}
                        {{--
                    </li>
                    --}}
                    {{--@if ( Route::current()->getName() === 'home_search' || Route::current()->getName() === 'search'
                    )--}}
                    {{--
                    <li class="nav-item start active">--}}
                        {{--@else--}}
                        {{--
                    <li class="nav-item">--}}
                        {{--@endif--}}
                        {{--<a href="{{ route('home_search') }}" class="nav-link">--}}
                            {{--<i class="icon-users"></i>--}}
                            {{--<span class="title">Список</span>--}}
                            {{--<span class="selected"></span>--}}
                            {{--</a>--}}
                        {{--
                    </li>
                    --}}
                    {{--
                    <li class="nav-item  ">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="icon-basket"></i>--}}
                            {{--<span class="title">Аналитика</span>--}}
                            {{--<span class="arrow"></span>--}}
                            {{--</a>--}}
                        {{--
                        <ul class="sub-menu">--}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="ecommerce_index.html" class="nav-link ">--}}
                                    {{--<i class="icon-home"></i>--}}
                                    {{--<span class="title">Клиенты с авансами</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="ecommerce_orders.html" class="nav-link ">--}}
                                    {{--<i class="icon-basket"></i>--}}
                                    {{--<span class="title">Должники</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}
                    {{--
                    <li class="heading">--}}
                        {{--<h3 class="uppercase">Заказы</h3>--}}
                        {{--
                    </li>
                    --}}
                    {{--
                    <li class="nav-item  ">--}}
                        {{--<a href="javascript:;" class="nav-link nav-toggle">--}}
                            {{--<i class="fa fa-bar-chart"></i>--}}
                            {{--<span class="title">Аналитика</span>--}}
                            {{--<span class="arrow"></span>--}}
                            {{--</a>--}}
                        {{--
                        <ul class="sub-menu">--}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="ecommerce_index.html" class="nav-link ">--}}
                                    {{--<i class="icon-home"></i>--}}
                                    {{--<span class="title">Клиенты с авансами</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                            <li class="nav-item  ">--}}
                                {{--<a href="ecommerce_orders.html" class="nav-link ">--}}
                                    {{--<i class="icon-basket"></i>--}}
                                    {{--<span class="title">Должники</span>--}}
                                    {{--</a>--}}
                                {{--
                            </li>
                            --}}
                            {{--
                        </ul>
                        --}}
                        {{--
                    </li>
                    --}}
                    {{--
                </ul>
                --}}
                {{--<!-- END SIDEBAR MENU -->--}}
                {{--<!-- END SIDEBAR MENU -->--}}
                {{--
            </div>
            --}}
            {{--<!-- END SIDEBAR -->--}}
            {{--
        </div>
        --}}
        {{--<!-- END SIDEBAR -->--}}
        {{--<!-- BEGIN CONTENT -->--}}
        {{--
        <div class="page-content-wrapper">--}}
            {{--<!-- BEGIN CONTENT BODY -->--}}
            {{--
            <div class="page-content">--}}
                {{--<!-- BEGIN PAGE HEADER-->--}}


                {{--<!-- BEGIN PAGE BAR -->--}}
                {{--Проверка на авторизацию--}}
                {{--@if(Auth::guest())--}}
                {{--<a href="/login" class="btn btn-info">Залогинтесь пожалуйста</a>--}}
                {{--@endif--}}

                {{--<!-- END PAGE BAR -->--}}
                {{--<!-- END PAGE HEADER-->--}}
                {{--<!-- BEGIN DASHBOARD-->--}}
                {{--<!-- Начало основного контента-->--}}
                @yield('content')


                {{--<!-- Конец основного контента-->--}}
                {{--
            </div>
            --}}
            {{--<!-- END CONTENT BODY -->--}}
            {{--
        </div>
        --}}
        {{--<!-- END CONTENT -->--}}
        {{--<!-- BEGIN QUICK SIDEBAR -->--}}
        {{--<a href="javascript:;" class="page-quick-sidebar-toggler">--}}
            {{--<i class="icon-login"></i>--}}
            {{--</a>--}}

        {{--
    </div>
    --}}
    {{--<!-- END CONTAINER -->--}}
    {{--<!-- BEGIN FOOTER -->--}}
    {{--
    <div class="page-footer">--}}
        {{--
        <div class="page-footer-inner">--}}
            {{--2017 &copy; iByket--}}
            {{--
        </div>
        --}}
        {{--
        <div class="scroll-to-top">--}}
            {{--<i class="icon-arrow-up"></i>--}}
            {{--
        </div>
        --}}
        {{--
    </div>
    --}}
    {{--<!-- END FOOTER -->--}}
    {{--
</div>
--}}
{{--<!-- BEGIN QUICK NAV -->--}}

{{--<!-- END QUICK NAV -->--}}

{{--<!-- BEGIN CORE PLUGINS -->--}}
<script src="{{ asset(" assets
/") }}/global/plugins/jquery.min.js" type="text/javascript"></script>
{
    {
        -- < script
        src = "{{ asset("
        assets / ") }}/global/plugins/bootstrap/js/bootstrap.min.js"
        type = "text/javascript" ></script>--}}
{{--
<script src="{{ asset(" assets
/") }}/global/plugins/js.cookie.min.js" type="text/javascript"></script>--
}
}
{
    {
        -- < script
        src = "{{ asset("
        assets / ") }}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type = "text/javascript" ></script>--}}
{{--
<script src="{{ asset(" assets
/") }}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>--
}
}
{
    {
        -- < script
        src = "{{ asset("
        assets / ") }}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type = "text/javascript" ></script>--}}
{{--
<script src="{{ asset(" assets
/") }}/global/plugins/morris/morris.min.js" type="text/javascript"></script>--
}
}
{
    {
        -- < script
        src = "{{ asset("
        assets / ") }}/global/scripts/app.min.js"
        type = "text/javascript" ></script>--}}
{{--<!-- BEGUN SEMANTIC UI -->--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.js"></script>
{{--<!-- END SEMANTIC UI -->--}}
{{--<!-- END CORE PLUGINS -->--}}
{{--<!-- BEGIN PAGE LEVEL SCRIPTS -->--}}
@yield('page_scripts')
{{--<!-- BEGIN PAGE LEVEL SCRIPTS -->--}}
{{--<!-- END PAGE LEVEL SCRIPTS -->--}}
{{--<!-- BEGIN THEME LAYOUT SCRIPTS -->--}}
{{--
<script src="{{ asset(" assets
/") }}/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>--
}
}
{
    {
        -- < script
        src = "{{ asset("
        assets / ") }}/layouts/layout/scripts/demo.min.js"
        type = "text/javascript" ></script>--}}
{{--
<script src="{{ asset(" assets
/") }}/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>--
}
}
{
    {
        -- < script
        src = "{{ asset("
        assets / ") }}/layouts/global/scripts/quick-nav.min.js"
        type = "text/javascript" ></script>--}}
{{--<!-- END THEME LAYOUT SCRIPTS -->--}}

@yield('script')

</body>

</html>