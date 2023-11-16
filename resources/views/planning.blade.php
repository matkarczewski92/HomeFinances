    @extends('layouts.app')

@section('content')

    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#09203F, #537895);', 'title' => 'Planowanie',
    'additionalButtons' => '','additionalInfo' => '',])

    @livewire('finances.info-shot')

    @php
        $now = date("Y-m-d");
        $lastDay = date("Y-m-t");
        $firstDay = date("Y-m-01");

    @endphp

    <div class="row contentMainBox ">
        <div class="row contentGroup ">
            <div class=" content rounded-2 shadow ms-3">
                <p class="title-center">Dochody</p>
                @include('livewire.planning.component.table-list', ['data' =>$catArray['i']])
                </div>
            <div class=" content rounded-2 shadow ms-3">
                <p class="title-center">Koszty</p>
                @include('livewire.planning.component.table-list', ['data' =>$catArray['c']])
            </div>

    </div>
@endsection
