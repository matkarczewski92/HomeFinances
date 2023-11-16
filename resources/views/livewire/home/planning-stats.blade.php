<div class="row contentGroup  ">
    <div class="strike m-3">
        <span>Płatności planowane (zmienna wysokość)</span>
     </div>
    @foreach ($categories as $d)
    @php
        $percent = number_format($d[2]/$d[1]*100, 0);
        $color = ($percent>=100) ? 'red' : 'green';
    @endphp
    @if ($d[0]->value>0)

    <div class="col-lg-2 me-2 content rounded-2 shadow">
        <p class="titleSm mb-3" style="text-align: center !important">{{$d[0]->categoryDetails->name}} </p>
        <center>
            <div class="pie animate no-round" style="--p:{{$percent}};--c:{{$color}};">{{$percent}}%</div>
        </center>
        <p class="text-center">
            <br/>
            Planowane: {{number_format($d[1],2, ',','.')}} zł<br/>
            Zrealizowane: {{number_format($d[2],2, ',','.')}} zł<br/>
        </p>

    </div>
    @endif
    @endforeach



</div>
