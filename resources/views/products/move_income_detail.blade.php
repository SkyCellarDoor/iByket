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
        @if($detail->back_products > 0)
            <div class="item">&nbsp;Накладная на возврат товара по накладной № {{ $detail->back_products }}</div>
        @else
            <div class="item">&nbsp;Накладная на перемещение № {{ $detail->id }}</div>
        @endif
    </div>

    <div class="ui bottom attached segment">
        <form class="ui form" action="{{ route('income_move_complete') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="move_income" value="{{ $detail->id }}">
            <input type="hidden" name="from_storage" value="{{ $detail->from_storage }}">
            <div class="ui grid">
                <div class="ui twelve wide column">
                    <table class="ui very compact small selectable celled table">
                        <thead>
                        <tr>
                            <th>
                                Товар
                            </th>
                            <th class="collapsing">
                                Количество
                            </th>
                            <th class="collapsing">
                                Прием
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->product_id }}</td>
                                <input type="hidden" name="id[]" value="{{ $item->id }}"/>
                                <td>{{ $item->value_one }}</td>
                                <input name="value_in[]" type="hidden" value="{{ $item->value_one }}">
                                @if( $detail->back_products > 0)
                                    <td>
                                        <div class="ui right aligned category search item">
                                            <div class="ui transparent left icon input" style="width: 100px;">
                                                <i class="cube icon"></i>
                                                <input name="value[]" type="number" value="{{ $item->value_one }}"
                                                       readonly>
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    <td>
                                        <div class="ui right aligned category search item">
                                            <div class="ui transparent left icon input" style="width: 100px;">
                                                <i class="cube icon"></i>
                                                <input name="value[]" type="number" min="0" max="{{ $item->value_one }}"
                                                       placeholder="Кол-во">
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="ui four wide column">
                    <div class="ui centered card" style="width: 100%;">
                        <div class="content">
                            <div class="field">
                                {{ \Auth::user()->storage_id }}
                            </div>
                        </div>
                        <div class="extra content">
                            <span class="right floated">
                                 <button class="ui green button" type="submit">Принять</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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


