@if($product->consist == 0)
    <tr id="tr_{{ $rnd }}">
        <td>
            <div class="ui small feed">
                <div class="event">
                    <div class="content">
                        <div class="summary">
                            <span>{{ $product->name }}</span>
                            <input name="id_product[]" type="hidden" data-id="{{ $rnd }}" value="{{ $product->id }}"
                                   class="id_product">
                            <div class="date">
                                <i class="cube icon"></i>
                                {{ $product->one_name_model->name_short }}.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td colspan="2" class="two wide">
            <div class="ui mini right labeled left icon input">
                <i class="cube icon"></i>
                <input name="count[]" id="count_{{ $rnd }}" min="1" max="999999" type="number" class="input_area"
                       value="1">
                <input name="count_many[]" value="" type="hidden">
                <div class="ui left label">
                    {{ $product->one_name_model->name_short }}.
                </div>
            </div>
        </td>
        <td colspan="2" class="two wide">
            <div class="ui mini right labeled left icon input">
                <i class="cube icon"></i>
                <input name="price_one[]" id="price_{{ $rnd }}" class="input_area" value="">
                <input name="price_many[]" value="" type="hidden">
                <div class="ui left label">
                    p.
                </div>
            </div>
        </td>
        <td style="width: 1%">
            <a href="#" class="del" data-del="{{ $rnd }}"><i class="remove red icon"></i></a>
        </td>
    </tr>
@else
    <tr id="tr_{{ $rnd }}">
        <td>
            <div class="ui small feed">
                <div class="event">
                    <div class="content">
                        <div class="summary">
                            <span>{{ $product->name }}</span>
                            <input name="id_product[]" type="hidden" data-id="{{ $rnd }}" value="{{ $product->id }}"
                                   class="id_product">
                            <div class="date">
                                <i class="cube icon"></i>
                                {{ $product->one_name_model->name_short }}.&nbsp;
                                <i class="arrow right icon"></i>
                                <i class="cubes icon"></i>
                                {{ $product->many_name_model->name_short }}.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        {{--количество одного--}}
        <td class="two wide">
            <div class="ui mini right labeled left icon input">
                <i class="cube icon"></i>
                <input name="count[]" id="count_{{ $rnd }}" min="1" max="999999" type="number" class="input_area"
                       value="1">
                <div class="ui left label">
                    {{ $product->one_name_model->name_short }}.
                </div>
            </div>
        </td>
        {{--количество многих--}}
        <td class="two wide">
            <div class="ui mini right labeled left icon input">
                <i class="cubes icon"></i>
                <input name="count_many[]" id="count_many_{{ $rnd }}" min="1" max="999999" type="number" value="1"
                       class="input_area">
                <div class="ui left label">
                    {{ $product->many_name_model->name_short }}.
                </div>
            </div>
        </td>
        {{--цена одной--}}
        <td class="two wide">
            <div class="ui mini right labeled left icon input">
                <i class="cube icon"></i>
                <input name="price_one[]" id="price_{{ $rnd }}" min="1" max="999999" type="number" class="input_area"
                       value="">
                <div class="ui left label">
                    р.
                </div>
            </div>
        </td>
        {{--цена многих--}}
        <td class="two wide">
            <div class="ui mini right labeled left icon input">
                <i class="cubes icon"></i>
                <input name="price_many[]" id="price_many_{{ $rnd }}" min="1" max="999999" type="number" value="0"
                       class="disabled" readonly style="background: #E8E8E8; border-color: #E8E8E8;">
                <div class="ui left label">
                    р.
                </div>
            </div>
        </td>
        <td style="width: 1%">
            <a href="#" class="del" data-del="{{ $rnd }}"><i class="remove red icon"></i></a>
        </td>
    </tr>
@endif