@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Накладные на прием</div>
    </div>

    <div class="ui bottom attached segment">

        <div id="tabs" class="ui pointing secondary menu">
            <a class="item active" data-tab="income">Накладные на премещение</a>
            <a class="item" data-tab="back_product">Накладные на возврат</a>
        </div>
        <div class="ui tab segment active" data-tab="income">

            <table class="ui very compact small selectable celled table">
                <thead>
                <tr>
                    <th class="collapsing center aligned">
                        №
                    </th>
                    <th>
                        Дата создания
                    </th>
                    <th class="collapsing">
                        Откуда
                    </th>
                    <th class="collapsing">

                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{ route('move_products_detail') }}/{{ $item->id }}">{{ $item->id }}</a></td>
                        <td nowrap>{{ $item->created_at }}</td>
                        <td>{{ $item->from_storage }}</td>
                        <td><a href="{{ route('income_move_detail') }}/{{ $item->id }}"><input type="button"
                                                                                               class="ui tiny button"
                                                                                               value="принять"></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="ui tab segment" data-tab="back_product">

            <table class="ui very compact small selectable celled table">
                <thead>
                <tr>
                    <th class="collapsing center aligned">
                        №
                    </th>
                    <th>
                        Дата создания
                    </th>
                    <th class="collapsing">
                        Откуда
                    </th>
                    <th class="collapsing">

                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($back_product as $item)
                    <tr>
                        <td><a href="{{ route('move_products_detail') }}/{{ $item->id }}">{{ $item->id }}</a></td>
                        <td nowrap>{{ $item->created_at }}</td>
                        <td>{{ $item->from_storage }}</td>
                        <td><a href="{{ route('income_move_detail') }}/{{ $item->id }}"><input type="button"
                                                                                               class="ui tiny button"
                                                                                               value="принять"></a></td>
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
        $('.menu .item').tab({
            debug: true,
            selector: {
                tabs: '.tab'
            }
        });
    </script>
@endsection


