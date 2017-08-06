<thead>
<tr>
    <th>Имя</th>
    <th>Скидка</th>
    <th>Начало</th>
    <th>Конец</th>
    <th>Розница</th>
    <th>Опт</th>
    <th>

    </th>
</tr>
</thead>
<tbody>
@foreach($list_promotions as $promotion)
    <tr>
        <td> {{ $promotion->name }} </td>
        <td> {{ $promotion->percent }} </td>
        <td> {{ $promotion->on_date }} </td>
        <td> {{ $promotion->off_date }} </td>
        <td> {{ $promotion->on_retail }} </td>
        <td> {{ $promotion->on_wholesale }} </td>
        <td class="center aligned">
            <div class="ui icon tiny buttons">
                <a class="ui button" onclick="stop_promotion({{ $promotion->id }})">
                    <i class="stop icon"></i>
                </a>
                <a class="ui button">
                    <i class="edit icon"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
</tbody>