@extends('layouts.app')

@section('content')


  @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#662D8C, #ED1E79);', 'title' => 'Podsumowanie kosztów',
  'additionalButtons' => '','additionalInfo' => '',])
  @livewire('finances.info-shot')


  <div class="row contentMainBox ">
    @livewire('finances.transactions-list', ['data' => $data, 'type' => 'c', 'group' => 2])
  </div>

@endsection
