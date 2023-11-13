<div>
    @php
          $inc = 0;
          $incArray = [];
          $current = date("m-Y");
    @endphp
    <table class="table table-striped-columns mt-3">
        <tr>
            <td style="width: 15%"><span class="title">Dochody</span></td>
            @foreach ($months as $month)
                <td class="text-center @if ($month == $current) borderCurrentTop @endif">{{$month}}</td>
            @endforeach
        </tr>
        @foreach ($incomeCategory as $iC)
        <tr>
            <td >{{$iC->name}}</td>
            @foreach ($months as $month)
            <td class="text-center @if ($month == $current) borderCurrentContent @endif">{{number_format($dataIncome[$iC->id][substr($month, 0, 2)], 2, '.', ',')}}</td>
            @endforeach
        </tr>
        @endforeach
        <tr>
            <td class="text-center"><p class="titleSm mb-1 mt-1" style="text-align: right !important">SUMA DOCHODÓW</p></td>
            @foreach ($months as $month)
            <td class="text-center @if ($month == $current) borderCurrentContent @endif">{{number_format($sumIncome[$month], 2, '.', ',')}}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="13"></td>
        </tr>
        @foreach ($costCategory as $cC)
        <tr>
            <td >{{$cC->name}}</td>
            @foreach ($months as $month)
            <td class="text-center @if ($month == $current) borderCurrentContent @endif">{{number_format($dataCost[$cC->id][substr($month, 0, 2)], 2, '.', ',')}}</td>
            @endforeach
        </tr>
        @endforeach
        <tr>
            <td class="text-center"><p class="titleSm mb-1 mt-1" style="text-align: right !important">SUMA KOSZTÓW</p></td>
            @foreach ($months as $month)
            <td class="text-center @if ($month == $current) borderCurrentBottom @endif">{{number_format($sumCost[$month], 2, '.', ',')}}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="13"></td>
        </tr>
        <tr>
            <td style="width: 15%"><p class="titleSm mt-1 mb-1" style="text-align: center !important">Bilans</p></td>
            @foreach ($months as $month)
            <td class="text-center @if ($sumIncome[$month]-$sumCost[$month]<0) bg-danger @else bg-success @endif">{{number_format($sumIncome[$month]-$sumCost[$month], 2, '.', ',')}}</td>
            @php
                $inc += ($sumIncome[$month]-$sumCost[$month]);
                $incArray[] = $inc
            @endphp
            @endforeach
        </tr>

        <tr>
            <td style="width: 15%"><p class="titleSm mt-1 mb-1" style="text-align: center !important">Narastająco</p></td>
            @foreach ($incArray as $iA)
             <td class="text-center @if ($iA<0) bg-danger @else bg-success @endif">{{number_format($iA, 2, '.', ',')}}</td>
            @endforeach
        </tr>
    </table>
</div>
