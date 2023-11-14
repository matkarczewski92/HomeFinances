@extends('layouts.app')

@section('content')
@php
    $bilans = 0;
    $costSum = 0;
    $incomeSum = 0;
@endphp

    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#2E3192, #1BFFFF);', 'title' => 'Mapa przepływów',
    'additionalButtons' => '','additionalInfo' => '',])
    @livewire('finances.info-shot')


  <div class="row contentMainBox ">
    <div class="row contentGroup ">
      <div class="col content rounded-2 shadow me-3">
        <table class="table table-striped" >
            <thead class="text-center">
                <td style="width: 40%">Dochody</td>
                <td style="width: 5%">Suma dnia</td>
                <td style="width: 10%">Data / Bilans</td>
                <td style="width: 5%">Suma dnia</td>
                <td style="width: 40%">Koszty</td>
            </thead>

            @foreach ($dateSheet ?? [] as $dS)
            @php
             $bilans +=  $income[$dS][0] - $cost[$dS][0];
             $costSum += $cost[$dS][0];
             $incomeSum += $income[$dS][0];
            @endphp
            <tr class="text-center" style="vertical-align:middle">
                <td>
                    @foreach ($income[$dS][1] ?? [] as $tr)
                        {{$tr->title}}<br>
                    @endforeach
                </td>
                <td>{{ number_format($income[$dS][0], '2', ',', '.') }} zł</td>
                <td>{{$dS}}<br/>{{ number_format($bilans, '2', ',', '.') }} zł</td>
                <td>-{{ number_format($cost[$dS][0], '2', ',', '.') }} zł</td>
                <td>
                    @foreach ($cost[$dS][1] ?? [] as $tr)
                        {{$tr->title}}<br>
                    @endforeach
                </td>
            </tr>
            @endforeach
            <tfoot class="text-center" style="vertical-align:middle">
                <td colspan="2" style="width: 45%"><span class="titleSm">Suma dochodów<br/> {{ number_format($incomeSum, '2', ',', '.')}} zł</span></td>
                <td style="width: 10%"><span class="titleSm">Bilans<br/>{{ number_format($bilans, '2', ',', '.') }}</span></td>
                <td colspan="2" style="width: 45%"><span class="titleSm">Suma kosztów<br/> {{ number_format($costSum, '2', ',', '.')}} zł</span></td>
            </tfoot>
        </table>
      </div>
    </div>
  </div>




@endsection
