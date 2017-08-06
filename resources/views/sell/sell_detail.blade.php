@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">

        <div class="item">&nbsp;Продажа № {{ $sell->id }}
        </div>
        <div class="right item">
            @if($sell->client_id == NULL)
                Без клиента
            @else
                <a href="{{ route('detail_view') }}/{{ $sell->client_id }}">{{ $sell->client_sell_model->name }}</a>
            @endif
        </div>


    </div>
    <div class="ui bottom attached segment">

        <div class="ui grid">
            <div class="ui twelve wide column">

                <div id="loader" class="ui segment">
                    <table id="result" class="ui fluid very basic collapsing celled table" style="width: 100%">
                        <thead>
                        <tr>
                            <th style="width:40%;">Товар</th>
                            <th style="width:20%;">Количество</th>
                            <th style="width:5%;">Цена</th>
                            <th class="left aligned" style="width:5%;">Общая</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->product_model->good_model->name}}</td>
                                <td>{{$product->amount}}</td>
                                <td>{{$product->price}} p.</td>
                                <td>{{$product->amount * $product->price}} p.</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="ui four wide column">
                <div class="ui centered card" style="width: 100%;">
                    <div class="content">
                        <div class="summary">
                            <span class="right floated">
                                    <div class="ui mini horizontal statistic">
                                    <div class="value">
                                        <span id="all_summ">{{ $sell->summa }}</span>
                                    </div>
                                    <div class="label">
                                        руб.
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    @if($sell->discount == 0 || $sell->discount == null)

                    @else
                        <div class="content">
                            <div class="ui small feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="extra text">
                                            <div class="ui tiny form">
                                                <div class="five wide inline field">
                                                    <label>Cкидка</label>
                                                    <div class="ui icon input error">
                                                        <input value="{{ $sell->discount }}" type="text"
                                                               disabled="disabled">
                                                        <i class="percent icon"></i>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <label>Причина скидки</label>
                                                    <textarea rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="content">
                        <div class="ui small feed">
                            <div class="event">
                                <div class="content">
                                    Магазин: <b>{{ $sell->storage_model->name }}</b>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                    Сотрудник: <b>{{ $sell->user_id }}</b>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--модальное окно окончания продажи--}}

@endsection


@section('page_scripts')


@endsection


@section('script')
    <script>

    </script>
@endsection


