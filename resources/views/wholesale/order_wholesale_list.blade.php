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
        <div class="item">&nbsp;Список заказов</div>
    </div>

    <div class="ui bottom attached segment">
        @foreach($orders as $order)
            <div class="ui top attached grey inverted menu">
                <div class="item">
                    {{ $order -> orders_user_model->wholesales_model->company }}
                </div>
                <div class="right item">
                    {{ $order -> date_income }}
                </div>
            </div>
            <div class="ui bottom attached segment">
                <table class="ui very compact small very basic table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($order->orders_item as $item)
                        <tr>
                            <td>{{ $item->comment }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
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

    </script>
@endsection


