<div class="row contentGroup">
    <div class="col content rounded-2 shadow ms-3" style="position: relative;">
        <div class="row" style="margin-bottom: 75px">
            @include('livewire.settings.components.category-table', ['title' => 'Kategorie dochodów', 'data' => $category->where('type', 'i')])
        </div>

        <div class="row">
            <div class="w-100 text-center" style="position: absolute; bottom: 0 ">@include('livewire.settings.components.category-create', ['type' => 'i'])</div>
        </div>
    </div>
    <div class="col content rounded-2 shadow ms-3" style="position: relative;">
        <div class="row" style="margin-bottom: 75px">
            @include('livewire.settings.components.category-table', ['title' => 'Kategorie kosztów', 'data' => $category->where('type', 'c')])
        </div>
        <div class="row">
            <div class="w-100 text-center" style="position: absolute; bottom: 0 ">@include('livewire.settings.components.category-create', ['type' => 'c'])</div>
        </div>
    </div>
</div>
