@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Список заказов</div>
    </div>



    <div class="ui bottom attached segment">
        <table class="ui green selectable celled table">
            <thead>
            <tr>
                <th style="width: 1%">№</th>
                <th>Дата</th>
                <th>Описание</th>
                <th>Клиент</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders->take(5) as $order)
                <tr>
                    <td>
                        <a href="{{ route('order_detail') }}/{{ $order->id }}">
                            {{ $order->id }}
                        </a>
                    </td>
                    <td>
                        {{ $order->created_at }}
                    </td>
                    <td>
                        {{$order->comments }}
                    </td>
                    <td>
                        <a href="{{ route('detail_view') }}/{{ $order->client_id }}"> {{ $order->client_model->name }}</a>
                    </td>
                    <td>
                        {{ $order->status_history_model->status_name_model->name }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}
@endsection


@section('script')
    <script>

    </script>
@endsection


