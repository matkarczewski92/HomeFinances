<div>
    <span class="title-center">{{ $title }}</span>
<table class="detailsTable">
    <thead>
        <td>Nazwa kategorii</td>
        <td style="width:10%">Opcje</td>
    </thead>
    @foreach ($data ?? [] as $value)
    <tr>
        <td> @if ($editId===$value->id)
            <div class="input-group mb-3">
                <input type="text" class="form-control" wire:model="editName">
                <input type="hidden" class="form-control" wire:model="editId">
                <button type="submit" class="btn btn-outline-success" wire:click="save()">Zapisz</button>
              </div>
        @else
        {{ $value->name }}
        @endif </td>
        <td>
            <a href="#"  wire:click="editMode({{ $value->id }})"><i class="bi bi-pencil-fill me-2"></i></a>
            <a href="#"  wire:click="delete({{ $value->id }})"><i class="bi bi-trash3 "></i></a>
        </td>
    </tr>
    @endforeach
</table>

</div>
