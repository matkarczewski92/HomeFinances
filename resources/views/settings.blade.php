@extends('layouts.app')

@section('content')


    @include('components.top', [
        'bg' => 'background-image: linear-gradient(0.15turn,#868F96, #596164);',
        'title' => 'Ustawienia',
        'additionalButtons' => '',
        'additionalInfo' => '',
        ])
    @livewire('finances.info-shot')

  <div class="row contentMainBox ">

        @livewire('settings.settings')


    <div class="row contentGroup ">
      <div class="col content rounded-2 shadow ms-3">
        1tresc
      </div>
      <div class="col content rounded-2 shadow ms-3">
        1tresc
      </div>
    </div>
  </div>

@endsection
