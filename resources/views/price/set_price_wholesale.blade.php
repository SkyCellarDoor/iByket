@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Установка оптовых цен</div>
        <div class="right item">
            <div class="ui mini input">
                <input class="all_percent" type="number" min="0" placeholder="Общий процент" style="width: 120px">
            </div>
        </div>
    </div>
    <div class="ui bottom attached segment">
        <table class="ui very compact small selectable celled table dimmable">
            <thead>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Товар
                </th>
                <th colspan="2">
                    Себестоимость
                </th>
                <th colspan="2">
                    Последняя цена
                </th>
                <th colspan="2">
                    Цена
                </th>
                <th colspan="2" style="width:15%;">
                    Изменение
                </th>
            </tr>
            </thead>
            <tbody>
            <form action="{{ route('set_cost_wholesale_complete') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="back_url" value="{{ $back_url }}">
                @foreach($products as $product)
                    <tr>
                        <td>
                            {{ $product->id }}
                        </td>
                        @if( $product->consist_amount_was == NULL)
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
                            <td colspan="2" class="collapsing">
                                <div style="font-size: 0.85714286em;">
                                    <i class="cube grey icon"></i>
                                    <span id="prime_cost_one_{{ $product->id }}">
                                    {{ $product->cost_end }}
                                </span> p.
                                </div>
                            </td>
                            <td colspan="2" nowrap>
                                @if( $product->one_cost_sell_opt_id == NULL)
                                    -
                                @else
                                    <div style="font-size: 0.85714286em;">
                                        <i class="cube grey icon"></i>
                                        {{ $product->one_cost_wholesale_model->cost}} p.
                                    </div>
                                @endif
                            </td>
                            <td colspan="2" class="collapsing" style="padding: 1px;">
                                <div class="ui mini labeled left icon input">
                                    <i class="cube grey icon"></i>
                                    <input name="new_price_one[]" class="cost"
                                           data-role="one"
                                           data-id="{{ $product->id }}" type="text"
                                           style="width:143px; box-sizing: border-box;">
                                    <input type="hidden" name="new_price_many[]" value="">
                                </div>
                            </td>
                            <td class="collapsing" colspan="2">
                                <div style="font-size: 0.85714286em;">
                                    <i class="cube grey icon"></i>
                                    <span id="change_price_one_{{ $product->id }}"></span>
                                </div>
                            </td>
                        @else
                            <td>
                                <div class="ui small feed">
                                    <div class="event">
                                        <div class="content">
                                            <div class="summary">
                                                <a class="user">  {{ $product->good_model->name }} </a>
                                                <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                                                <a class="" href=""></a>
                                                <div class="date">
                                                    <i class="cube icon"></i>
                                                    {{ $product->amount }}
                                                    {{ $product->good_model->one_name_model->name_short }}.
                                                </div>
                                                <div class="date">
                                                    <i class="cubes icon"></i>
                                                    {{ $product->consist_amount }} / {{ $product->consist_amount_was }}
                                                    {{ $product->good_model->many_name_model->name_short }}.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            {{--за единицу--}}
                            <td nowrap class="collapsing">
                                <div style="font-size: 0.85714286em;">
                                    <i class="cube grey icon"></i>
                                    <span id="prime_cost_one_{{ $product->id }}">
                                    {{ $product->cost_end }}
                                </span> p.
                                </div>
                            </td>
                            {{--за составляющую--}}
                            <td nowrap class="collapsing">
                                <div style="font-size: 0.85714286em;">
                                    <i class="cubes grey icon"></i>
                                    <span id="prime_cost_many_{{ $product->id }}">
                                    {{ $product->consist_cost_end }}
                                </span> p.
                                </div>
                            </td>
                            {{--за единицу--}}
                            <td class="collapsing">
                                @if( $product->one_cost_sell_opt_id == NULL)
                                    -
                                @else
                                    <div style="font-size: 0.85714286em;">
                                        <i class="cube grey icon"></i>
                                        {{ $product->one_cost_wholesale_model->cost}} p.
                                    </div>
                                @endif
                            </td>
                            {{--за составляющую--}}
                            <td class="collapsing">
                                @if( $product->many_cost_sell_opt_id == NULL)
                                    -
                                @else
                                    <div style="font-size: 0.85714286em;">
                                        <i class="cubes grey icon"></i>
                                        {{ $product->many_cost_wholesale_model->cost}} p.
                                    </div>
                                @endif
                            </td>
                            {{--за единицу--}}
                            <td class="collapsing" style="padding: 1px;">
                                <div class="ui mini labeled left icon input">
                                    <i class="cube grey icon"></i>
                                    <input name="new_price_one[]" class="cost"
                                           data-id="{{ $product->id }}" type="text"
                                           data-role="one"
                                           style="width:70px; box-sizing: border-box;">
                                </div>
                            </td>
                            {{--за составляющую--}}
                            <td class="collapsing" style="padding: 1px;">
                                <div class="ui mini labeled left icon input">
                                    <i class="cubes grey icon"></i>
                                    <input name="new_price_many[]" class="cost"
                                           data-id="{{ $product->id }}" type="text"
                                           data-role="many"
                                           style="width:70px; box-sizing: border-box;">
                                </div>
                            </td>
                            {{--за единицу--}}
                            <td class="collapsing" nowrap>
                                <div style="font-size: 0.85714286em; width: 70px;">
                                    <i class="cube grey icon"></i>
                                    <span id="change_price_one_{{ $product->id }}"></span>
                                </div>
                            </td>
                            {{--за составляющую--}}
                            <td class="collapsing" nowrap>
                                <div style="font-size: 0.85714286em;width: 70px;">
                                    <i class="cubes grey icon"></i>
                                    <span id="change_price_many_{{ $product->id }}"></span>
                                </div>
                            </td>
                        @endif
                    </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="10" class="ui right aligned">
                    <input type="submit" class="ui small teal button" value="Сохранить">
                </th>
            </tr>
            </tfoot>
            </form>
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
        $('.cost').on('input', function () {

            var id = $(this).data('id');

            if ($(this).data('role') == 'one') {

                var prime_cost_one = parseFloat($('#prime_cost_one_' + id).text());

                var new_cost_one = parseFloat($(this).val());

                var percent_one = parseInt((new_cost_one / prime_cost_one * 100) - 100);

                if (percent_one >= 0) {
                    $('#change_price_one_' + id).text(percent_one + ' %');
                }
                else {
                    $('#change_price_one_' + id).text('');
                }
            }

            else {

                var prime_cost_many = parseFloat($('#prime_cost_many_' + id).text());

                var new_cost_many = parseFloat($(this).val());

                var percent_many = parseInt((new_cost_many / prime_cost_many * 100) - 100);

                if (percent_many >= 0) {
                    $('#change_price_many_' + id).text(percent_many + ' %');
                }
                else {
                    $('#change_price_many_' + id).text('');
                }
            }


        });

        $('.all_percent').on('input', function () {

            var all_percent = parseInt($('.all_percent').val());

            $(".cost").each(function () {

                var id = $(this).data('id');
                if ($(this).data('role') == 'one') {

                    var prime_cost_one = parseFloat($('#prime_cost_one_' + id).text());
                    var new_cost_one = parseInt((prime_cost_one * (all_percent + 100)) / 100);
                    var percent_one = parseInt((new_cost_one / prime_cost_one * 100) - 100);


                    if (new_cost_one >= 0 && percent_one >= 0) {
                        $(this).val(new_cost_one);
                        $('#change_price_one_' + id).text(percent_one + ' %');
                    }
                    else {
                        $(this).val('');
                        $('#change_price_one_' + id).text('');

                    }
                }
                else {
                    var prime_cost_many = parseFloat($('#prime_cost_many_' + id).text());
                    var new_cost_many = parseInt((prime_cost_many * (all_percent + 100)) / 100);
                    var percent_many = parseInt((new_cost_many / prime_cost_many * 100) - 100);


                    if (new_cost_many >= 0 && percent_many >= 0) {
                        $(this).val(new_cost_many);
                        $('#change_price_many_' + id).text(percent_many + ' %');
                    }
                    else {
                        $(this).val('');
                        $('#change_price_many_' + id).text('');

                    }

                }


            });


        });
    </script>
@endsection


