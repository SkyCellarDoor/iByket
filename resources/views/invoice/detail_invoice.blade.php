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
        <div class="ui grid">
            <div class="ui twelve wide column">
                <div id="loader" class="ui segment" style="min-height: 200px;">
                    <table id="result_table" class="ui very basic celled table fluid" style="width: 100%">
                        <thead>
                        <tr>
                            <th>Товар</th>
                            <th colspan="2">Количество</th>
                            <th colspan="2">Цена</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $products as $product)
                            <tr>
                                <td>{{ $product->invoice_product_good_model->name }}</td>
                                <td colspan="2">{{ $product->amount }}</td>
                                <td colspan="2">{{ $product->cost_end }} p.</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ui four wide column">
                <div class="ui centered card" style="width: 100%;">
                    <div class="content">
                        <div class="summary">
                            <span class="right floated">
                                    <div class="ui horizontal statistic">
                                    <div class="value">
                                        <span id="all_summ">{{ $invoice->summa }}</span>
                                    </div>
                                    <div class="label">
                                        руб.
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
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

    </script>
@endsection


