@extends('layouts.app')

@section('content')

  @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#11998E, #38EF7D);', 'title' => 'Manager finansów',
  'additionalButtons' => '','additionalInfo' => '',])
  @livewire('finances.info-shot')


  <div class="row contentMainBox ">
    @livewire('home.planning-stats')
  </div>

@endsection
