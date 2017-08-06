@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Перемещение продукта</div>
        <div class="item">{{ \Auth::user()->storage_id }}</div>
    </div>
    <div class="ui bottom attached segment">
        <form action="{{ route('move_product_create') }}" method="post" class="ui form">
            {{ csrf_field() }}
            <div class="ui grid">
                <div class="ui twelve wide column">
                    <table class="ui very compact small selectable celled table">
                        <thead>
                        <tr>
                            <th class="collapsing center aligned">
                                #
                            </th>
                            <th>
                                Товар
                            </th>
                            <th class="collapsing">
                                Кол-во на складе
                            </th>
                            <th colspan="2">
                                Переместить
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <input type="hidden" name="back_url" value="{{ $back_url }}">
                        @foreach($products as $product)
                            @if( $product->good_model->consist == 0)
                                <tr>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                    <td>
                                        {{ $product->good_model->name }}
                                        <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                                    </td>
                                    <td style="font-size: 0.85714286em;">
                                        <div class="date">
                                            <i class="cube icon"></i>
                                            {{ $product->amount }}
                                            {{ $product->good_model->one_name_model->name_short }}.
                                        </div>
                                    </td>
                                    @if($product->amount == 1)
                                        <td colspan="2" style="padding: 1px;">
                                            <div class="ui mini labeled left icon input">
                                                <i class="cube grey icon"></i>
                                                <input name="value_one[]" type="number"
                                                       style="width:90px; box-sizing: border-box;background: #ececec;"
                                                       readonly="readonly" value="1">
                                                <input name="value_many[]" type="hidden" value="">
                                            </div>
                                        </td>
                                    @else
                                        <td colspan="2" style="padding: 1px;">
                                            <div class="ui mini labeled left icon input">
                                                <i class="cube grey icon"></i>
                                                <input name="value_one[]" type="number" min="1"
                                                       max="{{ $product->amount }}"
                                                       style="width:90px; box-sizing: border-box;" value="">
                                                <input name="value_many[]" type="hidden" value="">
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                    <td>
                                        {{ $product->good_model->name }}
                                        <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                                    </td>

                                    <td style="font-size: 0.85714286em;" nowrap>
                                        <div class="date">
                                            <i class="cube icon"></i>
                                            {{ $product->amount }}
                                            {{ $product->good_model->one_name_model->name_short }}.
                                            &nbsp;
                                            <i class="cubes icon"></i>
                                            {{ $product->consist_amount }} / {{ $product->consist_amount_was }}
                                            {{ $product->good_model->many_name_model->name_short }}.
                                        </div>
                                    </td>
                                    @if($product->amount == 1)
                                        <td class="collapsing" style="padding: 1px;">
                                            <div class="ui mini labeled left icon input">
                                                <i class="cube grey icon"></i>
                                                <input name="value_one[]" type="number"
                                                       style="width:90px; box-sizing: border-box;background: #ececec;"
                                                       readonly="readonly" value="1">
                                            </div>
                                        </td>
                                        <td class="collapsing" style="padding: 1px;">
                                            <div class="ui mini labeled left icon input">
                                                <i class="cubes grey icon"></i>
                                                <input name="value_many[]" value="{{ $product->consist_amount }}"
                                                       style="width:90px; box-sizing: border-box; background: #ececec;"
                                                       readonly="readonly">
                                            </div>
                                        </td>
                                    @else
                                        <td class="collapsing" style="padding: 1px;">
                                            <div class="ui mini labeled left icon input">
                                                <i class="cube grey icon"></i>
                                                <input name="value_one[]" type="number" min="1"
                                                       max="{{ $product->amount }}"
                                                       style="width:90px; box-sizing: border-box;" value="">
                                            </div>
                                        </td>
                                        <td class="collapsing" style="padding: 1px;">
                                            <div class="ui mini labeled left icon input">
                                                <i class="cubes grey icon"></i>
                                                <input name="value_many[]" value="{{ $product->consist_amount }}"
                                                       style="width:90px; box-sizing: border-box; background: #ececec;"
                                                       readonly="readonly">
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="ui four wide column">
                    <div class="ui centered card" style="width: 100%;">
                        <div class="content">
                            <div class="field">
                                <select class="ui dropdown storage" name="storage_to">
                                    <option value="">Куда переместить</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="extra content">
                            <span class="right floated">
                                 <button class="ui green button" type="submit">Переместить</button>
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
        $('.storage').dropdown();
        console.log();
    </script>
@endsection


