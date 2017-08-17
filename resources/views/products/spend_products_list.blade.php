@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Накладные на списание</div>
    </div>

    <div class="ui bottom attached segment">
        <table id="table_invoices" class="ui compact selectable celled table">
            <thead>
            <tr>
                <th class="collapsing" nowrap>№</th>
                <th>Причина списания</th>
                <th class="collapsing">Дата списания</th>
                <th class="collapsing">Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($spends as $item)
                <tr>
                    <td>
                        <a>
                            {{ $item->id }}
                        </a>
                    </td>

                    <td>
                        {{ $item->comment }}
                    </td>

                    <td>{{ substr($item->created_at, 0, 10) }}</td>

                    <td nowrap>{{ $item->sum }} p.</td>
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


