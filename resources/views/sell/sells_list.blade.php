@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')


    <div class="ui top attached menu">
        <div class="item">&nbsp;Список продаж</div>
    </div>

    <div class="ui bottom attached segment">
        <table id="result" class="ui fluid very compact collapsing celled table" style="width: 100%">
            <thead>
            <tr>
                <th style="width: 1%">
                    №
                </th>
                <th>
                    Клиент
                </th>
                <th>
                    Сумма
                </th>
                <th style="width: 1%">
                    Скидка
                </th>
                <th style="width: 1%" nowrap>
                    Магазаин
                </th>
                <th style="width: 1%">
                    Сотрудник
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($sells as $sell)
                <tr>
                    <td>
                        <a href="{{ route('sell_detail') }}/{{ $sell->id }}">{{ $sell->id }}</a>
                    </td>
                    <td>
                        @if( $sell->client_id == NULL )
                            Без клиента
                        @else
                            <a href="{{ route('detail_view') }}/{{ $sell->client_id }}">{{ $sell->client_sell_model->name }}</a>
                        @endif
                    </td>
                    <td>
                        {{ $sell->summa }} p.
                    </td>
                    <td>
                        @if( $sell->discount == NULL || $sell->discount == 0)
                            -
                        @else
                            {{ $sell->discount }}
                        @endif
                    </td>
                    <td nowrap>
                        {{ $sell->storage_model->name }}
                    </td>
                    <td>
                        {{ $sell->user_id }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>

            </tfoot>
        </table>
        {{ $sells->links() }}
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


