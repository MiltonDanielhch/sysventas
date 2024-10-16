<select name="ciudad" id="select_ciudades" class="form-control">
    @foreach ($ciudades as $ciudad)
    <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>
@endforeach
</select>
