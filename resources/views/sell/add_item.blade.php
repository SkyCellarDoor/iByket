@if($product->good_model->consist == 0)
    <tr id="tr_{{ $rnd }}">
        <td>
            <div class="ui small feed">
                <div class="event">
                    <div class="content">
                        <div class="summary">
                            <a class="user">  {{ $product->good_model->name }} </a>
                            <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                            <div class="date">
                                <i class="cube icon"></i>
                                {{ $product->amount }}
                                {{ $product->good_model->one_name_model->name_short }}.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td style="padding: 3px !important;">
            <div class="ui mini right labeled left icon fluid input" style="margin: 0px;">
                <i class="cube icon"></i>
                <input id="count_{{ $rnd }}" name="value_one[]" type="number" min="0" max="{{ $product->amount }}"
                       data-id="{{ $rnd }}" value="1" class="area_input">
                <input name="value_many[]" type="hidden" value="">
                <div class="ui left label">
                    {{ $product->good_model->one_name_model->name_short }}.
                </div>
            </div>
        </td>
        <td style="padding: 0px !important;">
            <div class="ui content">
                <div class="ui basic segment">
                    <span id="span_price_{{ $rnd }}" style="margin-right: 25px">{{ $product->one_cost_retail_model->cost }}
                        &nbsp;p.</span>
                    <div class="ui top right attached tiny label"
                         style="margin-top: -1px !important; margin-right: -1px !important;">{{ $product->one_cost_retail_model->cost }}
                        &nbsp;p.
                    </div>
                </div>
            </div>
            <input id="price_{{ $rnd }}" name="price[]" data-id="{{ $rnd }}" data-promotion="0" type="hidden"
                   value="{{ $product->one_cost_retail_model->cost }}" class="price">
            <input id="default_price_{{ $rnd }}" type="hidden" value="{{ $product->one_cost_retail_model->cost }}">
        </td>
        <td>
            <span id="span_sum_{{ $rnd }}">0.00&nbsp;p.</span>
            <input id="sum_{{ $rnd }}" class="sum" type="hidden" value="">
        </td>
        <td>
            <a href="#" data-id="{{ $rnd }}" class="remove"><i class="remove red icon"></i></a>
        </td>
    </tr>
@else
    <tr id="tr_{{ $rnd }}">
        <td>
            <div class="ui small feed">
                <div class="event">
                    <div class="content">
                        <div class="summary">
                            <a class="user">  {{ $product->good_model->name }} </a>
                            <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                            <div class="date">
                                <i class="cube icon"></i>
                                {{ $product->amount }}
                                {{ $product->good_model->one_name_model->name_short }}.&nbsp;
                                <i class="cubes icon"></i>
                                {{ $product->consist_amount }}/{{ $product->consist_amount_was }}
                                {{ $product->good_model->many_name_model->name_short }}.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td style="padding: 3px !important;">
            <div class="ui mini right labeled left icon fluid input" style="margin: 0px;">
                <i class="cubes icon"></i>
                <input name="value_one[]" type="hidden" value="">
                <input id="count_{{ $rnd }}" name="value_many[]" type="number" min="0"
                       max="{{ $product->consist_amount }}" data-id="{{ $rnd }}" value="1" class="area_input">
                <div class="ui left label">
                    {{ $product->good_model->many_name_model->name_short }}.
                </div>
            </div>
        </td>
        <td style="padding: 0px !important;">
            <div class="ui content">
                <div class="ui basic segment">
                    <span id="span_price_{{ $rnd }}" style="margin-right: 25px">{{ $product->many_cost_retail_model->cost }}
                        &nbsp;p.</span>
                    <div class="ui top right attached tiny label"
                         style="margin-top: -1px !important; margin-right: -1px !important;">{{ $product->many_cost_retail_model->cost }}
                        &nbsp;p.
                    </div>
                </div>
            </div>
            <input id="price_{{ $rnd }}" name="price[]" data-id="{{ $rnd }}" data-promotion="0" type="hidden"
                   value="{{ $product->many_cost_retail_model->cost }}" class="price">
            <input id="default_price_{{ $rnd }}" type="hidden" value="{{ $product->many_cost_retail_model->cost }}">
        </td>
        <td>
            <span id="span_sum_{{ $rnd }}">0.00&nbsp;p.</span>
            <input id="sum_{{ $rnd }}" class="sum" type="hidden" value="">
        </td>
        <td>
            <a href="#" data-id="{{ $rnd }}" class="remove"><i class="remove red icon"></i></a>
        </td>
    </tr>
@endif