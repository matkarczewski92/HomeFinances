<div class="row contentGroup ">
    <div class="col-xl-8 content rounded-2 shadow me-3">
      <span class="title">{{ $title }}</span>
        <table class="detailsTable mb-3" >
            <thead>
                <td>Tytuł</td>
                <td>Kwota</td>
                <td>Kategoria</td>
                @if($group != 1 && $group != 3) <td>Data</td>@endif
                @if($group == 1 || $group == 3) <td>Dzień płatności</td>@endif
                <td style="width:4%; text-align: right"></td>
                <td style="width:4%; text-align: right"></td>
            </thead>
            @foreach ($datas ?? [] as $d)
                <tr>
                    <td>{{ $d->title }}</td>
                    <td>{{ number_format($d->value, 2,',','.') }} zł</td>
                    <td>{{ $d->categoryDetails?->name }}</td>
                    @if($group != 1 && $group != 3) <td>{{ $d->created_at->format("Y-m-d") }}</td>@endif
                    @if($group == 1 or $group == 3)<td>{{ $d?->payment_day }}</td>@endif
                    <td style="text-align: right">
                        <a href="{{ route('transactions.edit', $d->id) }}"><i class="bi bi-pencil-fill me-2"></i></a>
                    </td>
                    <td style="text-align: right">
                        <form action="{{ route('transactions.destroy', $d->id) }}" method="POST" >
                            @method('delete') @csrf
                            <button class="btn btn-sm" type="submit"><i class="bi bi-trash3 "></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="row me-4 " >
            {{$datas->links()}}
        </div>
    </div>

    <div class="col-xl-3 content rounded-2 shadow">
        <span class="title">Filtry</span>
        <div class="mb-3">
            <label for="inputState" class="form-label">Kategoria transakcji</label>
            <select id="inputState" class="form-select" name="category" wire:change="" wire:model.live="filterCategory">
            <option value="">Wybierz kategorie transakcji</option>
            @foreach ($categories ?? [] as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="inputState" class="form-label">Data od</label>
            <input type="date" class="form-control" wire:model.live="filterDateFrom">
        </div>
        <div class="mb-3">
            <label for="inputState" class="form-label">Data do</label>
            <input type="date" class="form-control" wire:model.live="filterDateTo">
        </div>

    </div>

</div>
