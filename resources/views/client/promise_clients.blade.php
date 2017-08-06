@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Должники</div>
    </div>

    <div class="ui bottom attached segment">
        <table class="ui red selectable celled table">
            <thead>
            <tr>
                <th>
                    Имя
                </th>
                <th class="collapsing">
                    Сумма
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($clients as $client)
                <tr>
                    <td>
                        <a href="{{ route('detail_view') }}/{{ $client->id }}">{{ $client->name }}</a>
                    </td>
                    <td>
                        {{ $client->bill }}&nbsp;p.
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
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


