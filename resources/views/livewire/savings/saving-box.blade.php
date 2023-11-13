<div class="col col-lg-3 content rounded-2 shadow me-3">
    <p class="titleSm">{{$data->title}}</p>
    @php
        $percent = ($data->getSum->where('type', 'c')->sum('value')*100/$data->value<100) ? number_format($data->getSum->where('type', 'c')->sum('value')*100/$data->value,0) : 100;
        $toColect = $data->value-$data->getSum->where('type', 'c')->sum('value');
    @endphp
    <div class="progress mt-3 mb-3" role="progressbar" aria-label="Animated striped example" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: {{$percent}}%">{{$percent}}%</div>

      </div>

    <div class="row">
        <div class="col"><p class="title text-center">Cel: {{ number_format($data->value, '2', ',', '.') }} zł</p> </div>
    </div>
    <div class="row">
        <div class="col">@if ($toColect < 0)
            <p class="title text-center" style="color: green !important;"> Ponad cel: {{ number_format($toColect*-1, '2', ',', '.') }} zł</p>
            @else
            <p class="title text-center" style="color: red !important;">Pozostało: {{ number_format($toColect, '2', ',', '.') }} zł</p>
        @endif  </div>
    </div>

    <div class="row">
        <div class="col">Zebrano: {{number_format($data->getSum->where('type', 'c')->sum('value'), '2', ',', '.')}} zł</div>
        <div class="col text-end">Limit czasowy: {{$data->exp_date ?? 'brak'}}</div>
    </div>
    <div class="row mt-3 mb-3 text-center">
        <div class="col"><a type="button" href="{{ route('savings.create', ['saving' => $data->id]) }}" class="btn btn-outline-primary w-100">Edytuj</a></div>
        <div class="col"><a type="button" href="{{ route('transactions.create', ['saving' => $data->id]) }}" class="btn btn-outline-success w-100">Wpłać</a></div>
        <div class="col">
            <form action="{{ route('savings.destroy', $data->id) }}" method="POST" >
                @method('delete') @csrf
                <button class="btn btn-outline-danger w-100" type="submit">@if ($data->colected != null) Usuń @else Zakończ @endif</button>
            </form>
        </div>
        @if ($data->colected != null)
            <div class="col"><a type="button" href="{{ route('savings.edit', ['saving' => $data->id]) }}" class="btn btn-outline-warning w-100">Przywróć</a></div>
        @endif
    </div>
  </div>
