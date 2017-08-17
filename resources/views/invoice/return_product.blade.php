@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Возрат товара</div>
    </div>

    <div class="ui bottom attached segment">
        <table id="table_invoices" class="ui compact selectable celled table">
            <thead>
            <tr>
                <th class="collapsing" nowrap>№</th>
                <th>Поставщик</th>
                <th class="collapsing">Дата возрата</th>
                <th class="collapsing">Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoice_list as $item)
                <tr>
                    <td><a>{{ $item->id }}</a></td>
                    <td>
                        <a href="{{ route('detail_provider') }}/{{ $item->provider_id }}">{{ \App\ClientModel::find($item->provider_id)->providers_model->company }}</a>
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


