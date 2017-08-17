@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Новый заказ</div>
        <div class="item">Клиент&nbsp;<b>{{ $client->providers_model->company }}</b></div>
        <div class="item">Дата:&nbsp;<b>{{ $order->date_income }}</b></div>
        <a id="add_item" class="item"><i class="plus green icon"></i>Добавить</a>
    </div>
    <div class="ui bottom attached segment">
        <form action="{{route('save_opt_order')}}" method="post" class="ui form">
            {{ csrf_field() }}
            <input id="order_id" type="hidden" value="{{ $order->id }}">
            <input id="client_opt_id" type="hidden" value="{{ $order->client_opt_id }}">
            <div class="ui grid">
                <div class="ui twelve wide column">
                    <div id="items" class="ui segment">
                        {{--<div class="field fluid">--}}
                        {{--<div class="ui icon small input">--}}
                        {{--<input id="order" name="order[]" type="text" placeholder="Описание позиции заказа" value="">--}}
                        {{--<i class="cancel link icon"></i>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="ui four wide column">
                    <div class="ui segment">
                        <div class="fields">
                            <div class="field">
                                <input id="save" class="ui green button" type="submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
@endsection


@section('page_scripts')
    {{--<script src="{{ asset("assets/") }}/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset("assets/") }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>--}}
@endsection


@section('script')
    <script>
        $('#add_item').click(function () {

            var order_id = $('#order_id').val();
            var client_opt_id = $('#client_opt_id').val();

            $.ajax({
                url: "{{ route('add_item_opt_order') }}",
                type: 'POST',
                data: {
                    "order_id": order_id,
                    "client_opt_id": client_opt_id,
                },
                beforeSend: function () {

                },
                success: function (response) {
                    $('#items').append(response);

                },
            });
        });

        $(document).on('click', '.link', function () {

            var id = $(this).data('id');

            $.ajax({
                url: "{{ route('remove_item_opt_order') }}",
                type: 'POST',
                data: {
                    "id": id,
                },
                beforeSend: function () {
                    $('#div_' + id).remove();
                },
                success: function () {

                },
            });

        });

    </script>
@endsection


