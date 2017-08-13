@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')


    <div class="ui top attached menu">
        <div class="item">&nbsp;Список продаж</div>
    </div>

    <div class="ui bottom attached segment">
        <table id="sells" class="ui fluid very compact collapsing celled table" style="width: 100%">
            <thead>
            <tr>
                <th style="width: 1%">
                    №
                </th>
                <th>
                    Имя
                </th>
                <th>
                    Магазин
                </th>
                <th>
                    Сумма
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($workers as $worker)
                <tr>
                    <td>
                        <a href="{{ route('worker_detail') }}/{{ $worker->id }}">{{ $worker->id }}</a>
                    </td>

                    <td>
                        {{ $worker->name }}
                    </td>
                    <td>
                        {{ $worker->sell_storage_model->name }}
                    </td>
                    <td nowrap>
                        {{ $worker->bill }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>

            </tfoot>
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
        $(document).ready(function () {

            $('#sells').DataTable({
                "lengthMenu": [[25, 50, -1], [25, 50, "Все"]],
                "language": {
                    "lengthMenu": "_MENU_  &nbsp;&nbsp;записей на страницу",
                    "zeroRecords": "Ничего не найдено",
                    "info": "Старница _PAGE_ из _PAGES_",
                    "search": "Поиск:",
                    "paginate": {
                        "first": "Начало",
                        "last": "Конец",
                        "next": "Вперед",
                        "previous": "Назад"
                    },
                }
            });

        });
    </script>
@endsection


