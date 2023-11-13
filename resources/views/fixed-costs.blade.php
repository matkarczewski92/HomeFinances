@extends('layouts.app')

@section('content')

    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#464545, #F0F3B0);', 'title' => 'Transakcje cykliczne',
    'additionalButtons' => '','additionalInfo' => '',])

@livewire('finances.info-shot')


    <div class="row contentMainBox ">
        @livewire('finances.transactions-list', ['data' => '', 'type' => 'c', 'group' => 1, 'title' => 'Koszty'])
      </div>
      <div class="row contentMainBox ">
        @livewire('finances.transactions-list', ['data' => '', 'type' => 'i', 'group' => 1, 'title' => 'Dochody'])
      </div>

@endsection
