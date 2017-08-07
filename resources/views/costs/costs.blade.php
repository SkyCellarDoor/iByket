@extends('skyapp.index')

@section('page_css')

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Расходы</div>
        <a id="new_spend" class="item">
            Новый расход &nbsp; <i class="plus red icon"></i>
        </a>
    </div>

    <div class="ui bottom attached segment">
        <table class="ui very compact celled striped table">
            <thead>
            <tr>
                <th class="text-center">
                    Дата
                </th>
                <th class="text-center">
                    Категория
                </th>
                <th>
                    Комментарий
                </th>
                <th class="text-center">
                    Счет
                </th>
                <th class="text-center">
                    Сумма
                </th>
                <th class="text-center">
                    Файл
                </th>

            </tr>
            </thead>
            <tbody>

            @foreach($spends as $spend)
                <tr>
                    <td class="text-center" style="vertical-align:middle">
                        {{ $spend->created_at }}
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        {{ $spend->category}}
                    </td>
                    <td>
                        {{ $spend->comments }}
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        {{ $spend->bill }}
                    </td>
                    <td class="text-center" style="vertical-align:middle;">
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

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" name="hidden_search" id="hidden_search" value="{{ route('sub_cat') }}">

    {{--модальное окно нового расхода--}}

    <div id="new_spend_modal" class="ui modal">
        <i class="close icon"></i>
        <div class="header">
            Новый Расход
        </div>
        <div class="content">
            <form action="{{ route('new_cost') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="ui grid">
                    <div class="five wide column">
                        <div class="ui right labeled input">
                            <input name="value" type="text" placeholder="Введите сумму">
                            <div class="ui basic label">
                                руб.
                            </div>
                        </div>
                    </div>
                    <div class="four wide column">
                        <select id="main_cat" class="ui dropdown" name="category" title="">
                            <option value="">Категория</option>
                            @foreach( $cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="four wide column" id="sub_cat">

                    </div>
                </div>
                <div class="ui grid">
                    <div class="four wide column">
                        <select class="ui dropdown" name="bill" title="Откуда">
                            <option value="">Откуда</option>
                            @foreach( $bills as $bill)
                                <option value="{{ $bill->id }}"
                                        data-icon="fa fa-{{ $bill->image }}">{{ $bill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="four wide column">
                        <div class="ui action input">
                            <input name="spend_doc" type="file">
                            <div class="ui icon button">
                                <i class="attach icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <div class="ui form">
                            <div class="field">
                                <textarea rows="2" placeholder="Комментарий"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="actions">
            <a class="ui black deny cancel button">
                Отмена
            </a>
            <button class="ui positive ok right labeled icon button">
                Провести
                <i class="checkmark icon"></i>
            </button>
            </form>
        </div>
    </div>


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


        $("#new_spend").click(function () {
            $("#new_spend_modal").modal('show');

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function img(id) {
            $("#file_view").modal('show');
            $("#img").prop('src', 'img/spends/spends_' + id + '.jpg');
        }


        $('#main_cat').on('change', function () {
            var selected = $(this).find("option:selected").val();

            var search_url = $("#hidden_search").val();

            $.ajax({
                url: search_url,
                type: "POST",
                data: {
                    "category": selected,
                },
                beforeSend: function () {
                    // $('#sub_cat').replaceWith(' ')
                    //$('#main_cat').addClass('loading');

                },
                success: function (response) {
                    $('#sub_cat').html(response);
                    $('#sub_cat_select').dropdown('refresh');
                    $('#main_cat').removeClass('loading');
                }
            });
        });

    </script>
@endsection


