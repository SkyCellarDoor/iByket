<label>Подкатегория</label>
<select id="sub_category" class="selectpicker" name="sub_category" title="Выберите подкатегорию">
    @foreach( $sub_cats as $sub_cat )
        <option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
    @endforeach
</select>