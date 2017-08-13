@extends('skyapp.index')

@section('page_css')

    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.css"
          rel="stylesheet" type="text/css"/>

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Приходные накладные</div>
        <a id="add" class="item">
            <i class="plus green icon"></i>
            Принять товар
        </a>
    </div>

    <div class="ui bottom attached segment">
        <table id="table_invoices" class="ui compact selectable celled table">
            <thead>
            <tr>
                <th class="collapsing">№</th>
                <th>Поставщик</th>
                <th class="collapsing">Дата поступления</th>
                <th class="collapsing">Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoice_list as $item)
                <tr>
                    <td><a href="{{ route('invoice_detail') }}/{{ $item->id }}">{{ $item->id }}</a></td>
                    <td>
                        <a href="{{ route('detail_provider') }}/{{ $item->provider_id }}">{{ \App\ClientModel::find($item->provider_id)->providers_model->company }}</a>
                    </td>
                    <td>{{ substr($item->created_at, 0, 10) }}</td>

                    <td nowrap>{{ $item->summa }} p.</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="add_modal" class="ui small modal">

        <i class="close icon"></i>
        <div class="header">
            Header
        </div>

        <div class="content">
            <form action="{{ route('invoice_create') }}" method="post">
                {{ csrf_field() }}
                <div class="ui form">
                    <div class="three fields">
                        <div class="field">
                            <label>Поставщик</label>
                            <div class="ui input">
                                <select name="provider" class="ui dropdown">
                                    <option value="">Выберите поставщика</option>
                                    @foreach( $providers as $provider )
                                        <option value="{{ $provider->id }}">{{ $provider->providers_model->type_company_model->name }} {{ $provider->providers_model->company }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="field">
                            <label>Дата поступления</label>
                            <div class="ui input">
                                <input type="text" name="real_date" value=""/>
                                <input type="hidden" name="bill_use" value="1"/>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="actions">
            <div class="ui cancel black button">
                Cancel
            </div>
            <input type="submit" class="ui ok teal button" value="Продолжить">

            </form>
        </div>
    </div>

@endsection

@section('page_scripts')
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.js"></script>
@endsection



@section('script')
    <script type="text/javascript">

        $('#table_invoices').DataTable({
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

        $('#add').on('click', function () {

            $('#add_modal').modal('show');

            $(function () {
                $('input[name="real_date"]').daterangepicker({
                    format: 'YYYY-MM-DD',
                    "singleDatePicker": true,
                });
            });

        });


    </script>
@endsection