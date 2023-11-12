<div class="row mainBox shadow-lg " style="{{ $bg }}">
    <div class="inMainBox ms-5">
        <span class="title text-light pageTitle"> <i class="bi bi-wallet2"></i> {{ $title }}</span>
    </div>
    <div class="inMainBoxNav">
        <div class="row">
            <div class="col-lg-6 mt-5">
                <p class="ms-4">{!! $additionalInfo ?? '' !!}</p>
            </div>
            <div class="col-lg-6 text-end mt-5 ">
                {!! $additionalButtons ?? '' !!}
                {{-- @livewire('modals.category') --}}
                <a type="button" href="{{ route('transactions.create') }}" class="btn btn-light me-3">Dodaj transakcje</a>

            </div>
        </div>
    </div>
</div>
