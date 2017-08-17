@extends('skyapp.index')

@section('page_css')

    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset("assets/") }}/global/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />--}}

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Новый расход</div>
    </div>



    <div class="ui bottom attached segment">
        <div class="ui grid">
            <div class="ten wide column">
                <div class="ui segment">
                    <div id="form_">
                        <form id="new_spend_form" class="ui form" action="{{ route('new_cost') }}" method="POST"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="fields">
                                <div class="field">
                                    <label>Сумма</label>
                                    <div class="ui input">
                                        <input id="value" type="number" step="0.01" max="" name="value"
                                               placeholder="Введите сумму">
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Категория</label>
                                    <select id="main_cat" class="ui dropdown" name="category">
                                        <option value="">Категория</option>
                                        @foreach( $cats as $cat )
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="field">
                                    <div id="sub_cat" class="field">
                                        <label>Подкатегория</label>
                                        <select id="sub_cat_select" class="ui dropdown" name="sub_category">
                                            <option value="">Подкатегория</option>
                                            @foreach( $cats as $cat )
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Откуда</label>
                                    <select id="bill" name="bill" class="ui dropdown">
                                        <option value="">Выберите счет</option>
                                        @foreach( $bills as $bill )
                                            <option value="{{ $bill->id }}">{{ $bill->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Сумма на счету</label>
                                    <input id="count_sum" value="" readonly>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field sixteen wide column">
                                    <label>Описание</label>
                                    <textarea name="comments" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field sixteen wide column">
                                    <div class="ui action input">
                                        <input name="spend_doc" type="file">
                                        <div class="ui icon button">
                                            <i class="attach icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <input class="ui button" type="submit" value="Создать">
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field sixteen wide column">
                                    <div class="ui error prompt message"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

        $('#main_cat').on('change', function () {
            var selected = $(this).find("option:selected").val();

            $.ajax({
                url: "{{ route('sub_cat_spends') }}",
                type: "POST",
                data: {
                    "category": selected,
                },
                beforeSend: function () {

                },
                success: function (response) {
                    $('#sub_cat').html(response);
                    $('#sub_cat_select').dropdown('refresh');
                }
            });
        });

        $('#bill').on('change', function () {
            var bill = $(this).find("option:selected").val();

            $.ajax({
                url: "{{ route('count_max_bill_spends') }}",
                type: "POST",
                data: {
                    "bill": bill,
                },
                beforeSend: function () {
                    $('#form_').addClass('loading');

                },
                success: function (response) {
                    $('#count_sum').val(response + " p.");
                    $("#value").attr({'max': response});
                    $('#form_').removeClass('loading');

                }
            });
        });

        $("#new_spend_form").form({
            fields: {
                value: {
                    identifier: 'value',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Введите сумму'
                        },
                    ]
                },
                comment: {
                    identifier: 'comments',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Введите описание'
                        }
                    ]
                },
                main_cat: {
                    identifier: 'main_cat',
                    rules: [
                        {
                            type: 'minCount[1]',
                            prompt: 'Выберите категорию'
                        }
                    ]
                },
                bill: {
                    identifier: 'bill',
                    rules: [
                        {
                            type: 'minCount[1]',
                            prompt: 'Выберите счет'
                        }
                    ]
                },
            },
//                    inline : true,
//                    on     : 'blur',
        });

    </script>
@endsection


