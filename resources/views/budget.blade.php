@extends('layouts.app')

@section('content')

    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#09203F, #537895);', 'title' => 'Budżet',
    'additionalButtons' => '','additionalInfo' => '',])

    @livewire('finances.info-shot')


    <div class="row contentMainBox ">
        @livewire('budget.sheet')
    </div>



@endsection
