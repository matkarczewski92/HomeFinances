<div>

    <p class="title-center">
        @if (empty($editId))
            Dodaj plan budżetu
        @else
            Edycja planu budżetu
        @endif
    </p>

    @if (empty($editId))
    <form action="{{ route('planning.store') }}" method="POST" class="needs-validation" novalidate>
    @else
    <form action="{{ route('planning.update', $editId) }}" method="POST" class="needs-validation" novalidate>
    @method('patch')
    @endif
    @csrf


    <div class="mb-3">
        <label for="inputState" class="form-label">Typ transakcji</label>
        <select id="inputState" class="form-select" name="type" wire:change="type" wire:model="formType" >
            <option value="">Wybierz typ transakcji</option>
            <option value="i"  @if ($formType == 'i') selected @endif>Dochód</option>
            <option value="c" @if ($formType == 'c') selected @endif>Koszt</option>
        </select>
    </div>

    @if (!empty($formType))
        @include('livewire.components.select', ['data' => $categories,'dbtitle' => 'name','name' => 'category', 'change' => 'category', 'model' => 'formCategory', 'title' => 'Kategoria '])
    @endif


    @if (!empty($formShow))

    <div class="row g-3 mb-3">
        <div class="mb-1">
            @include('livewire.components.input', ['title' => 'Tytuł transakcji', 'type' => 'text', 'name' => 'title', 'model' => 'title', 'required' => 'required'])
        </div>
        <div class="col-md-6">
            @include('livewire.components.input', ['title' => 'Kwota', 'type' => 'number', 'name' => 'value', 'model' => 'value',  'step' => '0.01', 'required' => 'required'])
        </div>
        <div class="col-md-3">
            @include('livewire.components.input', ['title' => 'Obowiązuje od', 'type' => 'month', 'name' => 'created_at', 'model' => 'dateFrom','min' => $dateFrom])
            <div class="invalid-feedback">
                Istnieje plan obowiazujący do podanej daty. Najwcześniejszą początkową datą może być {{$dateFrom}}
              </div>
        </div>
        <div class="col-md-3">
            @include('livewire.components.input', ['title' => 'Obowiązuje do', 'type' => 'month', 'name' => 'exp_date', 'model' => 'dateTo', 'min' => $dateTo])
        </div>
    </div>

    <div class="mb-3">
        <button class="btn btn-outline-success w-100" >@if (empty($editId)) Dodaj @else Edytuj @endif</button>
    </div>
    @endif
    </form>
</div>
