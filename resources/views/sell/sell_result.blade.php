<thead>
<tr>
    <th style="width:40%;">
        Товар
    </th>
    <th style="width:10%;">Количество</th>
    <th style="width:10%;">Цена</th>
    <th class="left aligned" style="width:5%;">Общая</th>
    <th class="left aligned" style="width:3%;"></th>
</tr>
</thead>
<tbody>

@foreach($products as $product)
    <tr>
        @if($product->product_model->consist_amount == NULL || $product->product_model->consist_amount == 0)
            @if($product->product_model->promotion_deny === 1)
                <td style="padding: 0em !important; ">
                    <div class="ui content">
                        <div class="ui basic segment">
                            <div class="ui small feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="summary">
                                            <a class="user">  {{ $product->product_model->good_model->name }} </a>
                                            <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                                            <a class="" href=""></a>
                                            <div class="date">
                                                <i class="cube icon"></i>
                                                {{ $product->product_model->amount }}
                                                {{ $product->product_model->good_model->one_name_model->name_short }}.
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="ui top right attached tiny label"
                                     style="margin-top: -3px !important; margin-right: -1px !important;"><a href="#">Скидка
                                        запрещена</a></div>
                            </div>
                        </div>
                    </div>
                </td>
            @elseif($product->product_model->promotion_id > 0 && $product->product_model->promotion_model->active == 1)
                <td style="padding: 0em !important; ">
                    <div class="ui content">
                        <div class="ui basic segment">
                            <div class="ui small feed">
                                <div class="event">
                                    <div class="content">

                                        <div class="summary">
                                            <a class="user">  {{ $product->product_model->good_model->name }} </a>
                                            <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                                            <a class="" href=""></a>
                                            <div class="date">
                                                <i class="cube icon"></i>
                                                {{ $product->product_model->amount }}
                                                {{ $product->product_model->good_model->one_name_model->name_short }}.
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="ui top right attached tiny label"
                                     style="margin-top: -3px !important; margin-right: -1px !important;">
                                    <a id="popup_test" data-position="left center" data-variation="tiny">
                                        {{ $product->product_model->promotion_model->name }}
                                        - {{ $product->product_model->promotion_model->percent }}%
                                    </a>
                                    <div class="ui flowing popup transition hidden">
                                        <div class="ui grid">
                                            <div class="ui five wide column center aligned" style="min-width: 200px;">
                                                <h4 class="ui header">{{ $product->product_model->promotion_model->name }}
                                                    - {{ $product->product_model->promotion_model->percent }}%</h4>
                                                <span>{{ $product->product_model->promotion_model->description }}</span><br/>
                                                <span><b>Начало:</b> {{ $product->product_model->promotion_model->on_date }}
                                                    <b>Конец:</b> {{ $product->product_model->promotion_model->off_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            @else
                <td style="padding: 0em !important; ">
                    <div class="ui content">
                        <div class="ui basic segment">
                            <div class="ui small feed">
                                <div class="event">
                                    <div class="content">

                                        <div class="summary">
                                            <a class="user">  {{ $product->product_model->good_model->name }} </a>
                                            <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                                            <a class="" href=""></a>
                                            <div class="date">
                                                <i class="cube icon"></i>
                                                {{ $product->product_model->amount }}
                                                {{ $product->product_model->good_model->one_name_model->name_short }}.
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </td>
            @endif
            <td id="one">
                <div class="ui mini right labeled left icon fluid input ">
                    <i class="cube icon"></i>
                    @if($product->amount === NULL )
                        <input id="count_{{ $product->id }}" name="value_one[]" type="number" min="0"
                               data-id="{{ $product->id }}"
                               oninput="price_count($(this).val(), $(this).data('id'))" value="1">
                    @else
                        <input id="count_{{ $product->id }}" name="value_one[]" type="number" min="0"
                               data-id="{{ $product->id }}"
                               oninput="price_count($(this).val(), $(this).data('id'))" value="{{ $product->amount }}">
                    @endif
                    <input name="value_many[]" type="hidden" value="0">
                    <div class="ui left label">
                        {{ $product->product_model->good_model->one_name_model->name_short }}.
                    </div>
                </div>
            </td>
            <td style="padding: 0em !important;">
                @if($product->product_model->promotion_deny === 1)
                    <div class="ui content">
                        <div class="ui basic segment">
                            <span style="margin-right: 25px">{{ $product->product_model->one_cost_sell_id }}
                                &nbsp;p.</span>
                            <div class="ui top right attached tiny label"
                                 style="margin-top: -4px !important; margin-right: -1px !important;">{{ $product->product_model->one_cost_sell_id }}
                                &nbsp;p.
                            </div>
                        </div>
                    </div>
                    <input id="price_{{ $product->id }}" name="price[]" data-id="{{ $product->id }}" data-promotion="0"
                           type="hidden" value="{{ $product->product_model->one_cost_sell_id }}">
                @elseif($product->product_model->promotion_id > 0  && $product->product_model->promotion_model->active == 1)
                    <div class="ui content">
                        <div class="ui basic segment">
                            <span style="margin-right: 25px">{{ $product->product_model->one_cost_sell_id - ( $product->product_model->one_cost_sell_id * $product->product_model->promotion_model->percent / 100)}}
                                &nbsp;p.</span>
                            <div class="ui top right attached tiny label"
                                 style="margin-top: -4px !important; margin-right: -1px !important;">{{ $product->product_model->one_cost_sell_id }}
                                &nbsp;p.
                            </div>
                        </div>
                    </div>
                    <input id="price_{{ $product->id }}" name="price[]" data-id="{{ $product->id }}" data-promotion="0"
                           type="hidden"
                           value="{{ $product->product_model->one_cost_sell_id - ( $product->product_model->one_cost_sell_id * $product->product_model->promotion_model->percent / 100) }}">
                @else
                    <div class="ui content">
                        <div class="ui basic segment">
                            <span style="margin-right: 25px" id="one_price_{{ $product->id }}">{{ $product->product_model->one_cost_sell_id }}
                                &nbsp;p.</span>
                            <div class="ui top right attached tiny label"
                                 style="margin-top: -4px !important; margin-right: -1px !important;">{{ $product->product_model->one_cost_sell_id }}
                                &nbsp;p.
                            </div>
                        </div>
                    </div>
                    <input id="price_{{ $product->id }}" name="price[]" data-promotion="1" type="hidden"
                           value="{{ $product->product_model->one_cost_sell_id }}">
                @endif

            </td>
            <td>
                <span id="sum_{{ $product->id }}"> 1</span> р.
                <input id="h_sum_{{ $product->id }}" data-id="{{ $product->id }}" name="h_sum_price" type="hidden"
                       value="">
            </td>
        @else
            <td>
                <div class="ui small feed">
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <a class="user">  {{ $product->product_model->good_model->name }} </a>
                                <input name="id[]" type="hidden" value="{{ $product->id }}">
                                <div class="date">
                                    <i class="cube icon"></i> 1
                                    {{ $product->product_model->good_model->one_name_model->name_short }}.
                                    <i class="sign out icon"></i><i class="cubes icon"></i>
                                    {{ $product->product_model->consist_amount }}
                                    /
                                    {{ $product->product_model->consist_amount_was }}

                                    {{ $product->product_model->good_model->many_name_model->name_short }}.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td id="one">
                <div class="ui mini right labeled left icon fluid input">
                    <i class="cubes icon"></i>
                    <input name="value_one" type="hidden" value="0">
                    @if($product->amount_consist === NULL )
                        <input name="value_many[]" type="number" min="0" data-id="{{ $product->id }}"
                               oninput="price_count($(this).val(), $(this).data('id'))" value="1">
                    @else
                        <input name="value_many[]" type="number" min="0" data-id="{{ $product->id }}"
                               oninput="price_count($(this).val(), $(this).data('id'))"
                               value="{{ $product->amount_consist }}">
                    @endif
                    <div name="value_one[]" class="ui left label">
                        {{ $product->product_model->good_model->many_name_model->name_short }}.
                    </div>
                </div>
            </td>
            <td>
                {{ $product->product_model->many_cost_sell_id }} р.
                <input id="price_{{ $product->id }}" name="many_price[]" type="hidden"
                       value="{{ $product->product_model->many_cost_sell_id }}">

            </td>
            <td>
                @if($product->amount_consist === NULL )
                    <span id="sum_{{ $product->id }}">{{ $product->product_model->many_cost_sell_id * 1 }} </span>р.
                    <input id="h_sum_{{ $product->id }}" name="h_sum_price" type="hidden"
                           value="{{ $product->product_model->many_cost_sell_id * 1 }}">
                @else
                    <span id="sum_{{ $product->id }}">{{ $product->product_model->many_cost_sell_id * $product->amount_consist }} </span>
                    р.
                    <input id="h_sum_{{ $product->id }}" name="h_sum_price" type="hidden"
                           value="{{ $product->product_model->many_cost_sell_id * $product->amount_consist }}">
                @endif
            </td>
        @endif
        <td>
            <a href="#" data-id="{{ $product->id }}" onclick="delete_product($(this).data('id'))">
                <i class="remove red icon"></i>
            </a>
        </td>
    </tr>
@endforeach

</tbody>
<tfoot>

</tfoot>
