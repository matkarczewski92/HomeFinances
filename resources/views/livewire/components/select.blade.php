<div class="mb-3">
    <label for="inputState" class="form-label">{{$title}}</label>
    <select id="inputState" class="form-select" name="{{$name}}" wire:change="{{$change}}" wire:model="{{$model}}" >
        <option value="">Wybierz typ transakcji</option>
        @foreach ($data ?? [] as $gr)
            <option value="{{$gr->id}}" >{{$gr->$dbtitle}}</option>
        @endforeach
    </select>
</div>
