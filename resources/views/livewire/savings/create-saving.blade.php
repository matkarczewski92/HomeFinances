<div>
    <p class="title-center">@if (empty($editId))
        Dodaj cel oszczędności
        @else
        Edycja cel oszczędności
    @endif</p>
    @if (empty($editId))
    <form action="{{ route('savings.store') }}" method="POST" >
@else
    <form action="{{ route('savings.update', $editId) }}" method="POST" >
        @method('patch')
@endif
    @csrf

    <div class="mb-3">
        @include('livewire.components.input', ['title' => 'Tytuł', 'type' => 'text', 'name' => 'title', 'model' => 'title', 'required' => 'required'])
    </div>
    <div class="mb-3">
        @include('livewire.components.input', ['title' => 'Kwota', 'type' => 'number', 'name' => 'value', 'model' => 'value', 'required' => 'required', 'min' => '0.01', 'step'=>'0.01'])
    </div>
    <div class="mb-3">
        @include('livewire.components.input', ['title' => 'Limi czasowy', 'type' => 'date', 'name' => 'exp_date', 'model' => 'expDate'])
    </div>
    <div class="mb-3">
        <button class="btn btn-outline-success w-100" >@if (empty($editId)) Dodaj @else Edytuj @endif</button>
    </div>
</div>
