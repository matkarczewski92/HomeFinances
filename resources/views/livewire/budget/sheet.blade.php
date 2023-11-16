
<div class="row contentGroup ">
    <div class="col-xl content rounded-2 shadow me-3">
        @php
            $inc = 0;
            $incArray = [];
            $current = date("m-Y");
            $currentForm = date("Y-m");
            $monthFilter = substr($compareDate, -2);
            $yearFilter = substr($compareDate, 0, 4);
            $mtn = $monthFilter.'-'.$yearFilter;
        @endphp

        <div class="input-group mb-3 mt-3">
            <span class="input-group-text" id="basic-addon1">Podaj datę do porównania</span>
            <input type="month" class="form-control " id="start" name="start" wire:model.live="compareDate" />
        </div>
        <table class="table table-striped-columns mt-3">
            <tr>
                <td style="width: 15%"><span class="title">Dochody</span></td>
                @if (!empty($compareDate))<td class="text-center ">{{$compareDate}}</td>@endif
                @foreach ($months as $month)
                    <td class="text-center @if ($month == $current) borderCurrentTop @endif">{{$month}}</td>
                @endforeach
            </tr>
            <tr>
                <td>Stan kont poprzedni msc</td>

                @foreach ($months ?? [] as $month)
                <td class="text-center @if ($month == $current) borderCurrentContent @endif">{{number_format($dataBalance[$month], 2, '.', ',')}}</td>
                @endforeach
            </tr>
            @foreach ($incomeCategory as $iC)
            <tr>
                <td >{{$iC->name}}</td>
                @if (!empty($compareDate))<td class="text-center ">{{ number_format($compareIncome[$iC->id][$compareMonth] ?? '0', 2, '.', ',') }}</td>@endif
                @foreach ($months ?? [] as $month)
                <td class="text-center @if ($month == $current) borderCurrentContent @endif">{{number_format($dataIncome[$iC->id][$month], 2, '.', ',')}}</td>
                @endforeach
            </tr>
            @endforeach
            <tr>
                <td class="text-center"><p class=" mb-1 mt-1" style="text-align: right !important">SUMA DOCHODÓW</p></td>
                @if (!empty($compareDate))<td class="text-center">{{number_format($compareIncomeSum[$mtn], 2, '.', ',')}}</td>@endif
                @foreach ($months ?? [] as $month)
                <td class="text-center @if ($month == $current) borderCurrentContent @endif">{{number_format($sumIncome[$month], 2, '.', ',')}}</td>
                @endforeach
            </tr>
            <tr>
                <td colspan="13"></td>
            </tr>
            @foreach ($costCategory as $cC)
            <tr>
                <td >{{$cC->name}}</td>
                @if (!empty($compareDate))<td class="text-center ">{{ number_format($compareCost[$cC->id][$compareMonth] ?? '0', 2, '.', ',') }}</td>@endif
                @foreach ($months as $month)
                <td class="text-center @if ($month == $current) borderCurrentContent @endif">{{number_format($dataCost[$cC->id][$month], 2, '.', ',')}}</td>
                @endforeach
            </tr>
            @endforeach
            <tr>
                <td class="text-center"><p class=" mb-1 mt-1" style="text-align: right !important">SUMA KOSZTÓW</p></td>
                @if (!empty($compareDate))<td class="text-center">{{number_format($compareCostSum[$mtn], 2, '.', ',')}}</td>@endif
                @foreach ($months as $month)
                <td class="text-center @if ($month == $current) borderCurrentBottom @endif">{{number_format($sumCost[$month], 2, '.', ',')}}</td>
                @endforeach
            </tr>
            <tr>
                <td colspan="13"></td>
            </tr>
            <tr>
                <td style="width: 15%"><p class=" mt-1 mb-1" style="text-align: center !important">Bilans</p></td>
                @if (!empty($compareDate))<td class="text-center">{{number_format($compareIncomeSum[$mtn]-$compareCostSum[$mtn], 2, '.', ',')}}</td>@endif
                @foreach ($months as $month)
                <td class="text-center @if ($sumIncome[$month]-$sumCost[$month]<0) bg-danger @else bg-success @endif">{{number_format($sumIncome[$month]-$sumCost[$month], 2, '.', ',')}}</td>
                @php
                    $inc += ($sumIncome[$month]-$sumCost[$month]);
                    $incArray[] = $inc
                @endphp
                @endforeach
            </tr>
        </table>
    </div>
</div>

