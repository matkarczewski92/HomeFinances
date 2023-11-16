@extends('layouts.app')

@section('content')

    @php
        $title = (empty($edit)) ? 'Dodaj stan konta' : 'Edytuj stan konta'
    @endphp

    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#FF512F   , #DD2476);', 'title' => $title, 'icon'=>'<i class="bi bi-thermometer-low"></i>',
    'additionalButtons' => '','additionalInfo' => '',])
    {{-- @include('components.info-shot') --}}


  <div class="row contentMainBox " style='margin-top:-75px; min-height:200px'>
    <div class="row contentGroup ">
      <div class="col content rounded-2 shadow me-3">
            @livewire('acc-balance.create-acc-balance', ['edit' => $edit ?? ''])
      </div>
    </div>
  </div>

@endsection
