<div>
    <p class="title-center">@if (empty($edit))
        Dodaj stan konta
        @else
        Edycja stan konta
    @endif</p>
    @if (empty($edit))
    <form action="{{ route('accbalance.store') }}" method="POST" >
@else
    <form action="{{ route('accbalance.update', $edit) }}" method="POST" >
        @method('patch')
@endif
    @csrf

    <div class="mb-3">
        @include('livewire.components.select', ['data' => $accounts, 'dbtitle' => 'name','name' => 'account_id', 'change' => 'check', 'model' => 'title', 'title' => 'Konto bankowe '])
    </div>
    @if ($showForm == 1)
        <div class="mb-3">
            @include('livewire.components.input', ['title' => 'Kwota', 'type' => 'number', 'name' => 'value', 'model' => 'value', 'required' => 'required', 'min' => '0.01', 'step'=>'0.01'])
        </div>
        <div class="mb-3">
            @include('livewire.components.input', ['title' => 'Data stanu', 'type' => 'date', 'name' => 'exp_date', 'model' => 'date'])
        </div>
        <div class="mb-3">
            <button class="btn btn-outline-success w-100" >@if (empty($edit)) Dodaj @else Edytuj @endif</button>
        </div>
    @endif
</div>
