<div>
    <p class="title-center">@if (empty($editId))
        Dodaj transakcje
        @else
        Edycja traksakcji
    @endif</p>
    @if (empty($editId))
        <form action="{{ route('transactions.store') }}" method="POST" >
    @else
        <form action="{{ route('transactions.update', $editId) }}" method="POST" >
            @method('patch')
    @endif

        @csrf
        <div class="strike mb-2">
            <span>Informacje ogólne</span>
        </div>

            @include('livewire.components.select', ['data' => $groups,'dbtitle' => 'name','name' => 'group', 'change' => 'group', 'model' => 'formGroup', 'title' => 'Grupa '])

        @if (!empty($formGroup) or !empty($edit))
            <div class="mb-3">
                <label for="inputState" class="form-label">Typ transakcji</label>
                <select id="inputState" class="form-select" name="type" wire:change="type" wire:model="formType" >
                    <option value="">Wybierz typ transakcji</option>
                    <option value="i"  @if ($formType == 'i') selected @endif>Dochód</option>
                    <option value="c" @if ($formType == 'c') selected @endif>Koszt</option>
                </select>
            </div>


            @if (!empty($formType) AND $this->formGroup != 4)
                @include('livewire.components.select', ['data' => $categories,'dbtitle' => 'name','name' => 'category', 'change' => 'category', 'model' => 'formCategory', 'title' => 'Kategoria '])
            @endif

            @if (!empty($formSavingsShow) AND !empty($formType))
                @include('livewire.components.select', ['data' => $savings,'dbtitle' => 'title', 'name' => 'saving', 'change' => 'savings', 'model' => 'formSavings', 'title' => 'Oszczędności '])
            @endif

            @if (!empty($formType) AND !empty($formGroup) AND (!empty($formSavings) OR !empty($formCategory)))

                <div class="strike mb-2">
                    <span>Informacje szczegółowe</span>
                </div>

                <div class="mb-3">
                    @include('livewire.components.input', ['title' => 'Tytuł transakcji', 'type' => 'text', 'name' => 'title', 'model' => 'title', 'required' => 'required'])
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        @include('livewire.components.input', ['title' => 'Kwota', 'type' => 'number', 'name' => 'value', 'model' => 'value', 'min' => '0.01', 'step' => '0.01', 'required' => 'required'])
                    </div>
                    <div class="col-md-4">
                        @include('livewire.components.input', ['title' => 'Data transakcji', 'type' => 'date', 'name' => 'created_at', 'model' => 'date',])
                    </div>
                    @if ($this->formGroup == 1 OR $this->formGroup == 3)
                        <div class="col-md-4">
                            @include('livewire.components.input', ['title' => 'Dzień płatności (cykliczny)', 'type' => 'number', 'name' => 'payment_day', 'model' => 'payment_day', 'min' => '1', 'max' => '31', 'required' => 'required'])
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Adnotacje </label>
                    <textarea name="annotations" wire:model="annotations" class="form-control mb-4"></textarea>
                </div>

                <div class="mb-3">
                    <button class="btn btn-outline-success w-100" >@if (empty($editId)) Dodaj @else Edytuj @endif</button>
                </div>
            @endif
        @endif
    </form>
</div>
