<tbody align="center">
@foreach($results as $result)
    <tr>
        <td style="vertical-align: middle" align="left">{{ $result -> name }}</td>
        <td style="vertical-align: middle;">
            <div class="raw" style=" width: 130px !important;">+7 {{ $result -> phone }}</div>
        </td>
        <td style="vertical-align: middle">
            <div class="input-group" style="width: 155px !important;">
                <div class="input-group-btn">
                    <a class="btn red" id="spend" data-toggle="modal" data-id="{{ $result -> id }}"
                       data-title="{{ $result -> name }}" href="#spend_from_bill"
                       onclick="spend_from_bill($(this).attr('data-id'), $(this).attr('data-title'))">
                        <i class="fa fa-minus"></i></a>
                </div>
                <!-- /btn-group -->
                <input type="text" class="form-control" style="text-align: center; " readonly
                       value="{{ $result -> bill }} р.">
                <div class="input-group-btn">
                    <a class="btn green-meadow" id="add" data-toggle="modal" data-id="{{ $result -> id }}"
                       data-title="{{ $result -> name }}" href="#add_to_bill"
                       onclick="add_to_bill($(this).attr('data-id'), $(this).attr('data-title'))">
                        <i class="fa fa-plus"></i></a>
                </div>
                <!-- /btn-group -->
            </div>
        <td>
            <div class="btn-group">
                <a href="/order/new?user_id={{ $result -> id }}" class="btn btn-primary btn-sm" role="button">Заказ</a>
                <a href="{{ route('detail_view') }}/{{ $result -> id }}" class="btn btn-primary btn-sm" role="button">Просмотр</a>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown">
                        Продажа <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Списать со счета</a></li>
                        <li><a href="#">Без счета</a></li>
                    </ul>
                </div>
            </div>
        </td>
    </tr>
@endforeach

</tbody>
