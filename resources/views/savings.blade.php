@extends('layouts.app')

@section('content')


    @include('components.top', [
        'bg' => 'background-image: linear-gradient(0.15turn,#8095c5 , #afcfbd);',
        'title' => 'Oszczędności',
        'additionalButtons' => '',
        'additionalInfo' => '',
        ])
    @livewire('finances.info-shot')


<div class="row contentMainBox ">
    @if ($toColect->count() != 0)
        <div class="strike mb-2 mt-3">
            <span>Aktualne</span>
        </div>
        @foreach ($toColect ?? [] as $col)
            @include('livewire.savings.saving-box', ['data' => $col])
        @endforeach
    @else
        <div class="w-50 mt-4 ">
            <div class="alert alert-danger text-center mt-5" role="alert">
                <p class="mb-3">Brak aktywnego celu oszczędzania.</p>
                <a type="button" href="{{ route('savings.create') }}" class="btn btn-light mb-2">Dodaj cel oszczędności</a>
            </div>
        </div>
    @endif
    @if ($colected->count() != 0)
        <div class="strike mb-2 mt-5">
            <span>Zakończone</span>
        </div>
        @foreach ($colected ?? [] as $end)
            @include('livewire.savings.saving-box', ['data' => $end])
        @endforeach
    @endif
</div>

@endsection
