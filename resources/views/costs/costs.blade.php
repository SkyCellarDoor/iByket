@extends('skyapp.index')

@section('page_css')

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Расходы</div>
        <a id="new_spend" class="item" href="{{ route('create_spends') }}">
            Новый расход &nbsp; <i class="plus red icon"></i>
        </a>
    </div>

    <div class="ui bottom attached segment">
        <table id="spends_table" class="ui very compact celled striped table">
            <thead>
            <tr>
                <th class="collapsing">
                    Дата
                </th>
                <th class="text-center">
                    Категория
                </th>
                <th>
                    Комментарий
                </th>
                <th class="collapsing">
                    Счет
                </th>
                <th class="collapsing">
                    Сумма
                </th>
                <th class="collapsing">
                    Файл
                </th>

            </tr>
            </thead>
            <tbody>

            @foreach($spends as $spend)
                <tr>
                    <td nowrap>
                        {{ $spend->created_at }}
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        {{ $spend->spend_category_model->name}}
                        /{{ $spend->spend_subcategory_model != NULL ? $spend->spend_subcategory_model->name : "-" }}
                    </td>
                    <td>
                        {{ $spend->comments }}
                    </td>
                    <td nowrap>
                        {{ $spend->bill_model->name }}
                    </td>
                    <td nowrap>
                        <b>{{ $spend->value }} р.</b>
                    </td>
                    <td class="text-center" style="vertical-align:middle;">
                        <a data-toggle="modal" data-id="{{ $spend->id }}" href="#show_file"
                           onclick="img($(this).data('id'))"><i class="unhide icon"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    {{--модальное окно нового расхода--}}


    {{--модальное окно нового расхода--}}
    {{--модальное окно показа файла расхода--}}

    <div id="file_view" class="ui modal">
        <div class="header">Документ расхода</div>
        <div class="image content">
            <img id="img" src="" style="width: 580px;">
        </div>
    </div>

    {{--модальное окно показа файла расхода--}}

@endsection


@section('page_scripts')


@endsection


@section('script')
    <script>

        $('.dropdown').dropdown();

        function img(id) {
            $("#file_view").modal('show');
            $("#img").prop('src', 'img/spends/spends_' + id + '.jpg');
        }

        $('#spends_table').DataTable({
            "aaSorting": [],
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

    </script>
@endsection


