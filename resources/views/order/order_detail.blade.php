@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Заказ № {{ $order->id }}</div>
    </div>

    <div class="ui bottom attached segment">

        <div class="ui top attached tabular menu ">
            <a class="item active " data-tab="first">Описание</a>
            <a class="item" data-tab="second">История</a>
        </div>
        <div class="ui bottom attached tab segment active" data-tab="first">


        </div>

        <div class="ui bottom attached tab segment" data-tab="second">
            <table class="ui selectable celled table">
                <thead>
                <tr>
                    <th>Когда</th>
                    <th>Статус</th>
                    <th>Сотрудник</th>
                </tr>
                </thead>
                <tbody>
                @foreach($statuses as $status)
                    <tr>
                        <td>{{ $status->created_at }}</td>
                        <td>{{ $status->status_name_model->name }}</td>
                        <td>{{ $status->user_id }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
        $('.menu .item').tab();
    </script>
@endsection


