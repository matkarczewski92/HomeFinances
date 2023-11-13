@extends('layouts.app')

@section('content')


    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#009245 , #FCEE21);', 'title' => 'Dochody',
    'additionalButtons' => '','additionalInfo' => '',])

    @livewire('finances.info-shot')


  <div class="row contentMainBox ">
    @livewire('finances.transactions-list', ['data' => $data, 'type' => 'i', 'group' => 2])
  </div>

@endsection
