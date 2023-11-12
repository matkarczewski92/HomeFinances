@extends('layouts.app')

@section('content')


    @include('components.top', [
        'bg' => 'background-image: linear-gradient(0.15turn,#8095c5 , #afcfbd);',
        'title' => 'Oszczędności',
        'additionalButtons' => '',
        'additionalInfo' => '',
        ])
    @include('components.info-shot')


  <div class="row contentMainBox ">


    @foreach ($toColect ?? [] as $col)
        @include('livewire.savings.saving-box', ['data' => $col])
    @endforeach

  </div>

@endsection
