@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        @if ($provider->providers_model->type == 1)
            <div class="item">ООО "<b>{{ $provider->providers_model->company }}</b>"</div>

        @else
            <div class="item">ИП "<b>{{ $provider->providers_model->company }}</b>"</div>

        @endif
        <a class="item">
            <i class="plus green icon"></i>
            Поступление товара
        </a>

        <div class="right menu">
            <a class="item" data-type="1" href="#fin_modal" onclick="new_fin($(this).attr('data-type'))"> <i
                        class="minus icon red "></i></a>
            <div class="item">
                @if ( $provider->bill < 0 )
                    <div class="ui red mini horizontal statistic">
                        <div class="value">
                            {{ $provider->bill }}
                        </div>
                        <div class="label">
                            руб.
                        </div>
                    </div>
                @elseif( $provider->bill > 0 )
                    <div class="ui green mini horizontal statistic">
                        <div class="value">
                            {{ $provider->bill }}
                        </div>
                        <div class="label">
                            руб.
                        </div>
                    </div>
                @else
                    <div class="ui mini horizontal statistic">
                        <div class="value">
                            0
                        </div>
                        <div class="label">
                            руб.
                        </div>
                    </div>
                @endif
            </div>
            <a class="item" data-type="0" href="#fin_modal" onclick="new_fin($(this).attr('data-type'))"> <i
                        class="plus icon green"></i></a>
        </div>


    </div>



    <div class="ui bottom attached segment">
        1
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


