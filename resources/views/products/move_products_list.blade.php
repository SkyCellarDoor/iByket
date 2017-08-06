@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Перемещения</div>
    </div>

    <div class="ui bottom attached segment">
        <div id="tabs" class="ui pointing secondary menu">
            <a class="item active" data-tab="all">Все накладные</a>
            <a class="item" data-tab="new">Новые</a>
            <a class="item" data-tab="back">Возраты</a>
            <a class="item" data-tab="complete">Завершенные</a>
        </div>
        <div class="ui tab segment active" data-tab="all">
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
                        Отправлен
                    </th>
                    <th class="collapsing">
                        Откуда
                    </th>
                    <th class="collapsing">
                        Куда
                    </th>
                    <th class="collapsing">
                        Принят
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{ route('move_products_detail') }}/{{ $item->id }}">{{ $item->id }}</a></td>
                        <td nowrap>{{ $item->created_at }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->from_storage }}</td>
                        <td>{{ $item->to_storage }}</td>
                        @if( $item->user_take != NULL )
                            <td>{{ $item->user_take }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ui tab segment" data-tab="new">
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
                        Отправлен
                    </th>
                    <th class="collapsing">
                        Откуда
                    </th>
                    <th class="collapsing">
                        Куда
                    </th>
                    <th class="collapsing">
                        Принят
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($new as $item)
                    <tr>
                        <td><a href="{{ route('move_products_detail') }}/{{ $item->id }}">{{ $item->id }}</a></td>
                        <td nowrap>{{ $item->created_at }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->from_storage }}</td>
                        <td>{{ $item->to_storage }}</td>
                        @if( $item->user_take != NULL )
                            <td>{{ $item->user_take }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ui tab segment " data-tab="back">
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
                        Отправлен
                    </th>
                    <th class="collapsing">
                        Откуда
                    </th>
                    <th class="collapsing">
                        Куда
                    </th>
                    <th class="collapsing">
                        Принят
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($back_product as $item)
                    <tr>
                        <td><a href="{{ route('move_products_detail') }}/{{ $item->id }}">{{ $item->id }}</a></td>
                        <td nowrap>{{ $item->created_at }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->from_storage }}</td>
                        <td>{{ $item->to_storage }}</td>
                        @if( $item->user_take != NULL )
                            <td>{{ $item->user_take }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ui tab segment " data-tab="complete">
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
                        Отправлен
                    </th>
                    <th class="collapsing">
                        Откуда
                    </th>
                    <th class="collapsing">
                        Куда
                    </th>
                    <th class="collapsing">
                        Принят
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($complete as $item)
                    <tr>
                        <td><a href="{{ route('move_products_detail') }}/{{ $item->id }}">{{ $item->id }}</a></td>
                        <td nowrap>{{ $item->created_at }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->from_storage }}</td>
                        <td>{{ $item->to_storage }}</td>
                        @if( $item->user_take != NULL )
                            <td>{{ $item->user_take }}</td>
                        @else
                            <td>-</td>
                        @endif
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


