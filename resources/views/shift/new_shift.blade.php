@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Новая смена</div>
    </div>

    <div class="ui bottom attached segment">
        <div class="page-content-row">
            <div class="col-md-12"
                 style="display: flex; justify-content: center; align-items: center; margin-top: 200px;">
                <form action="{{ route('new_shift') }}" method="post">
                    <input type="hidden" name="cash" value="{{ $last_shift_cash->last_cash }}">
                    {{ csrf_field() }}
                    <input class="btn btn-lg btn-primary" style="width: 200px; height: 100px;" type="submit"
                           value="Новая смена">
                </form>
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


