<label>Подкатегория</label>
<select id="sub_cat_select" class="ui dropdown" name="subcategory">
    <option value="">Подкатегория</option>
    @foreach( $sub_cats as $sub_cat)
        <option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
    @endforeach
</select>
