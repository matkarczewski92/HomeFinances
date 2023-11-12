@extends('layouts.app')

@section('content')


    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#2E3192, #1BFFFF);', 'title' => 'Mapa przepływów',
    'additionalButtons' => '','additionalInfo' => '',])
    @include('components.info-shot')


  <div class="row contentMainBox ">
    <div class="row contentGroup ">
      <div class="col content rounded-2 shadow me-3">
        1tresc
      </div>
      <div class="col content rounded-2 shadow ms-3">
        1tresc
      </div>
    </div>
    <div class="row contentGroup  ">
      <div class="col content rounded-2 shadow me-3">
        1tresc
      </div>
      <div class="col content rounded-2 shadow">
        1tresc
      </div>
      <div class="col content rounded-2 shadow ms-3">
        1tresc
      </div>
    </div>
    <div class="row contentGroup  ">
      <div class="col content rounded-2 shadow">
        1tresc
      </div>
    </div>
  </div>

@endsection
