@if ($paginator->lastPage() > 1)
<select class="pagination">
    <option data-url="{{$paginator->url(1)}}" onclick="window.location.assign('{{ $paginator->url(1) }}')" {{ ($paginator->currentPage() == 1) ? 'selected' : '' }}>
        <a href="{{ $paginator->url(1) }}">Previous</a>
    </option>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <option data-url="{{$paginator->url($i)}}"  onclick="window.location.assign('{{ $paginator->url($i) }}')" {{ ($paginator->currentPage() == $i) ? 'selected' : '' }}>
            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </option>
    @endfor
    <option  data-url="{{$paginator->url($paginator->currentPage()+1)}}"  onclick="window.location.assign('{{ $paginator->url($paginator->currentPage()+1) }}')" {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'selected' : '' }}>
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >Next</a>
    </option>
</select>
@endif
