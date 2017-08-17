@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu" style="height: 48px;">
        <div class="item">&nbsp;Накладная № {{ $invoice->id }}</div>
        <div class="item">Поставщик&nbsp;<b>{{ $invoice->user_provider_model->providers_model->company }}</b></div>
    </div>

    <div class="ui bottom attached segment">
        <form action="{{ route('return_complete') }}" method="post" class="">
            {{ csrf_field() }}
            <div class="ui grid">
                <div class="ui twelve wide column">
                    <div id="loader" class="ui segment">
                        <input name="invoice_id" type="hidden" value="{{ $invoice->id }}">
                        <input name="provider_id" type="hidden" value="{{ $invoice->provider_id }}">
                        <table id="result_table" class="ui compact celled table fluid" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Товар</th>
                                <th colspan="2" style="width: 1%" nowrap>Кол-во</th>
                                <th style="width: 1%" nowrap>Кол-во на возврат</th>
                                <th colspan="2" style="width: 1%">Себестоимость</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@foreach( $products as $product)--}}
                            @if ($product->good_model->consist == 0)
                                <tr>
                                    <td>
                                        {{ $product->good_model->name }}
                                        <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                                    </td>
                                    <td colspan="2" class="collapsing">
                                        {{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}.
                                    </td>
                                    <td>
                                        <div class="ui transparent input two wide">
                                            <input name="count[]" id="value_{{ $product->id }}" class="value"
                                                   data-id="{{ $product->id }}" type="number"
                                                   max="{{ $product->amount }}" placeholder="Кол-во">
                                        </div>
                                    </td>
                                    <td colspan="2" class="collapsing">
                                        {{ $product->cost_end }} p.
                                        <input data-id="{{ $product->id }}" name="value[]" class="cost" type="hidden"
                                               value="{{ $product->cost_end }}">
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        {{ $product->good_model->name }}
                                        <input name="id_product[]" type="hidden" value="{{ $product->id }}">
                                    </td>
                                    <td class="collapsing">{{ $product->amount }} {{ $product->good_model->one_name_model->name_short }}
                                        .
                                    </td>
                                    <td class="collapsing"><span
                                                style="color:lightgray">{{ $product->consist_amount }} {{ $product->good_model->many_name_model->name_short }}
                                            .</span></td>
                                    <td>
                                        <div class="ui transparent input two wide">
                                            <input name="count[]" id="value_{{ $product->id }}" class="value"
                                                   data-id="{{ $product->id }}" type="number"
                                                   max="{{ $product->amount }}" placeholder="Кол-во">
                                        </div>
                                    </td>
                                    <td class="collapsing">
                                        {{ $product->cost_end }} p.
                                        <input data-id="{{ $product->id }}" name="value[]" class="cost" type="hidden"
                                               value="{{ $product->cost_end }}">
                                    </td>
                                    <td class="collapsing"><span style="color:lightgray">{{ $product->consist_cost_end }}
                                            p.</span></td>
                                </tr>
                            @endif
                            {{--@endforeach--}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="ui four wide column">
                    <div class="ui centered card" style="width: 100%;">
                        <div class="content">
                            <div class="summary">
                                Сумма возврата
                            </div>
                        </div>
                        <div class="content">
                            <div class="summary">
                            <span class="right floated">
                                    <div class="ui horizontal statistic">
                                    <div class="value">
                                        <span id="all_summ">0.00</span>
                                        <input name="sum" id="all_summ_input" type="hidden" value="">
                                    </div>
                                    <div class="label">
                                        руб.
                                    </div>
                                </div>
                            </span>
                            </div>
                        </div>
                        <div class="extra content">
                            <div class="ui input right floated">
                                <input type="submit" class="ui green button" value="Выполнить">
                            </div>
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
        $('.value').on('input', function () {

            let sum = 0;

            $('.cost').each(function () {

                let id = $(this).data('id');
                let cost = parseFloat($(this).val());
                let value = parseFloat($('#value_' + id).val());

                if (isNaN(value)) {
                    value = 0;
                }

                sum += cost * value;
                $('#all_summ').text(sum.toFixed(2));
                $('#all_summ_input').val(sum.toFixed(2));


            });
        });

    </script>
@endsection


