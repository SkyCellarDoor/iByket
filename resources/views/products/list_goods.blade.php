@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui grid">
        <div class="ui sixteen wide column">
            <div class="ui segment">

            </div>
        </div>
    </div>


    <div class="ui top attached menu">
        <div class="item">&nbsp;Название раздела</div>
    </div>



    <div class="ui bottom attached segment">
        <table class="ui very compact small selectable celled table dimmable">
            <thead>
            <tr>
                <th width="1%">
                    <input type="checkbox">
                </th>
                <th>
                    Название
                </th>
                <th>
                    Категория
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($goods as $good)
                <tr>
                    <td><input type="checkbox"></td>
                    <td><a href="{{ route('detail_products') }}/{{ $good->id }}">{{ $good->name }}</a></td>
                    @if ($good->main_cat == NULL)
                        <td>Без категории</td>
                    @else
                        <td>{{ $good->main_cat->name }}</td>
                    @endif
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


