@extends('layouts.app')

@section('content')


  @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#6C5F5B, #ED7D31);', 'title' => 'Kredyty',
  'additionalButtons' => '','additionalInfo' => ''])
  @livewire('finances.info-shot')


  <div class="row contentMainBox ">
    @livewire('finances.transactions-list', ['data' => '', 'type' => 'c', 'group' => 3, 'filters'=> 'no'])
  </div>


@endsection
