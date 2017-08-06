@foreach($products as $product)
    @if($product->good_model->consist == 0)
        <tr role="row" class="filter">
            <td width="1%">
                <input name="id_product[]" type="checkbox" value="{{ $product->id }}">
            </td>
            <td rowspan="1" colspan="1">
                <h5><a href="{{ route('detail_products') }}/{{ $product->good_id }}"
                       class="ui label small blue"><b>{{ $product->good_model->name }}</b></a></h5>
            </td>
            <td rowspan="1" colspan="1">
                <h5>
                    <a class="ui label small blue"><b>{{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}</b>.</a>
                </h5>
            </td>
            <td rowspan="1" colspan="1">
                <h5><a class="ui label small blue"><b>{{ $product->invoice_model->real_date }}</b></a></h5>
            </td>
            <td rowspan="1" colspan="1">
                <a class="ui label small blue"><b></b>&nbsp;
                    <div class="detail">1</div>
                </a>
            </td>
            <td rowspan="1" colspan="1">
                <a class="ui label small blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>. -
                    <b>{{ $product->cost_end }}</b> р.</a>
            </td>
            @if($product->one_cost_sell_id == 0)
                <td rowspan="1" colspan="1">
                    <a class="ui label red"><b>Не установлена</b></a>
                </td>
            @else
                <td rowspan="1" colspan="1">
                    <h5><a class="ui label blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>. -
                            <b>{{ $product->one_cost_sell_id }}</b> р.</a></h5>
                </td>
            @endif
            @if($product->one_cost_sell_opt_id == 0)
                <td rowspan="1" colspan="1" class="">
                    <a class="ui label red"><b>Не установлена</b></a>
                </td>
            @else
                <td rowspan="1" colspan="1">
                    <h5>
                        <span class="ui label ui label-info"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>. - <b>{{ $product->one_cost_sell_opt_id }}</b> р.</span>
                    </h5>
                </td>
            @endif
        </tr>
    @else
        <tr role="row" class="filter">
            <td width="1%">
                <input name="id_product[]" type="checkbox" value="{{ $product->id }}">
            </td>
            <td rowspan="1" colspan="1">
                <a href="{{route('detail_products') }}/{{ $product->good_id }}"
                   class="ui label small blue"><b>{{ $product->good_model->name }}</b></a>
            </td>
            <td rowspan="1" colspan="1">
                <a class="ui label small blue"><b>{{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}</b>.
                    <div class="detail">{{ $product->consist_amaunt }} {{ $product->good_model->many_name_model->name_short }}
                        .
                    </div>
                </a>
            </td>
            <td rowspan="1" colspan="1">
                <a class="ui label small blue"><b>{{ $product->invoice_model->real_date }}</b></a>
            </td>
            <td rowspan="1" colspan="1">
                <a class="ui label small blue"><b>1</b>&nbsp;
                    <div class="detail">1</div>
                </a>
            </td>
            <td rowspan="1" colspan="1">
                <a class="ui label small blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.
                    <div class="detail">{{ $product->cost_end }}р.</div>
                </a>
                <a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.
                    <div class="detail">{{ $product->consist_cost_end }}р.</div>
                </a>
            </td>
            @if($product->one_cost_sell_id == 0 & $product->many_cost_sell_id == 0)
                <td rowspan="1" colspan="1">
                    <a class="ui label red"><b>Не установлена</b></a>
                </td>
            @else
                @if($product->one_cost_sell_id > 1 & $product->many_cost_sell_id == 0)
                    <td rowspan="1" colspan="1">
                        <a class="ui label ui label-info"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.
                            <div class="detail">{{ $product->one_cost_sell_id }}р.</div>
                        </a>
                        <a class="ui label red"><b>Не установлена</b></a>
                    </td>
                @elseif($product->one_cost_sell_id == 0 & $product->many_cost_sell_id > 0 )
                    <td rowspan="1" colspan="1">
                        <a class="ui label red"><b>Не установлена</b></a>
                        <a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.
                            <div class="detail">{{ $product->many_cost_sell_id }}р.</div>
                        </a>
                    </td>
                @else
                    <td rowspan="1" colspan="1">
                        <a class="ui label small blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.
                            <div class="detail">{{ $product->one_cost_sell_id }}р.</div>
                        </a>
                        <a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.
                            <div class="detail">{{ $product->many_cost_sell_id }}р.</div>
                        </a>
                    </td>
                @endif
            @endif
            @if($product->one_cost_sell_opt_id == 0 & $product->many_cost_sell_opt_id == 0)
                <td rowspan="1" colspan="1">
                    <a class="ui label red"><b>Не установлена</b></a>
                </td>
            @else
                @if($product->one_cost_sell_opt_id > 1 & $product->many_cost_sell_opt_id == 0)
                    <td rowspan="1" colspan="1">
                        <a class="ui label ui label-info"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.
                            <div class="detail">{{ $product->one_cost_sell_opt_id }}р.</div>
                        </a>
                        <a class="ui label red"><b>Не установлена</b></a>
                    </td>
                @elseif($product->one_cost_sell_opt_id == 0 & $product->many_cost_sell_opt_id > 0 )
                    <td rowspan="1" colspan="1">
                        <a class="ui label red"><b>Не установлена</b></a>
                        <a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.
                            <div class="detail">>{{ $product->many_cost_sell_opt_id }}р.</div>
                        </a>
                    </td>
                @else
                    <td rowspan="1" colspan="1">
                        <a class="ui label small blue"><b>1 {{ $product->good_model->one_name_model->name_short }}</b>.
                            <div class="detail">{{ $product->one_cost_sell_opt_id }}р.</div>
                        </a>
                        <a class="ui label small blue"><b>1 {{ $product->good_model->many_name_model->name_short }}</b>.
                            <div class="detail">{{ $product->many_cost_sell_opt_id }}р.</div>
                        </a>
                    </td>
                @endif
            @endif
        </tr>
    @endif
@endforeach