    <label for="title" class="form-label">{{$title}}</label>
    <input type="{{$type}}" name="{{$name}}" min="{{$min ?? ''}}" wire:model="{{$model ?? ''}}"  step="{{$step ?? ''}}" max="{{$max ?? ''}}" class="form-control" id="title" placeholder="{{$placeholder ?? ''}}" {{$required ?? ''}}>
