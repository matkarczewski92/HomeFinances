    <label for="title" class="form-label">{{$title}}</label>
    <input type="{{$type}}" name="{{$name}}" wire:model="{{$model ?? ''}}" min="{{$min ?? ''}}" step="{{$step ?? ''}}" max="{{$max ?? ''}}" class="form-control" id="title" placeholder="{{$placeholder ?? ''}}" {{$required ?? ''}}>
