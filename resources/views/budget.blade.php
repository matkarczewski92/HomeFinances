@extends('layouts.app')

@section('content')

    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#09203F, #537895);', 'title' => 'Budżet',
    'additionalButtons' => '','additionalInfo' => '',])

    @livewire('finances.info-shot')


<div class="row contentMainBox ">
    <div class="row contentGroup ">
        <div class="col-xl content rounded-2 shadow me-3">

            @livewire('budget.sheet')


        </div>
    </div>
</div>

@endsection
