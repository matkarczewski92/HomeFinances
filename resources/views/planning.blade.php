@extends('layouts.app')

@section('content')

    @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#09203F, #537895);', 'title' => 'Planowanie',
    'additionalButtons' => '','additionalInfo' => '',])

    @livewire('finances.info-shot')


    <div class="row contentMainBox ">
        <div class="row contentGroup ">
            <div class=" content rounded-2 shadow ms-3">
                <p class="title-center">Dochody</p>
                @foreach ($catArray['i'] as $inc)
                    <p class="title">{{$inc->name}}</p>
                    <table class="table summary">
                        <tr>
                            <td style="width: 30%">Kwota</td>
                            <td>Od</td>
                            <td>Do</td>
                            <td style="width: 2%"></td>
                            <td style="width: 2%"></td>
                        </tr>
                        @foreach ($plans->where('category', $inc->id) as $income)
                        <tr>
                            <td>{{number_format($income->value, 2, ',','.')}} zł</td>
                            <td>{{$income->created_at->format("Y-m-d")}}</td>
                            <td>{{$income->exp_date}}</td>
                            <td style="text-align: right">
                                <a href="{{ route('planning.edit', $income->id) }}"><i class="bi bi-pencil-fill me-2"></i></a>
                            </td>
                            <td style="text-align: right">
                                <form action="{{ route('planning.destroy', $income->id) }}" method="POST" >
                                    @method('delete') @csrf
                                    <button class="btn btn-sm" type="submit"><i class="bi bi-trash3 "></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                @endforeach
                </div>
              <div class=" content rounded-2 shadow ms-3">
                <p class="title-center">Koszty</p>
                @foreach ($catArray['c'] as $inc)
                    <p class="titleSm mt-3">{{$inc->name}}</p>
                    <table class="table summary" >
                        <tr>
                            <td style="width: 30%">Kwota</td>
                            <td>Od</td>
                            <td>Do</td>
                            <td style="width: 2%"></td>
                            <td style="width: 2%"></td>
                        </tr>
                    @foreach ($plans->where('category', $inc->id) as $cost)
                    <tr>
                        <td>{{number_format($cost->value, 2, ',','.')}} zł</td>
                        <td>{{$cost->created_at->format("Y-m-d")}}</td>
                        <td>{{$cost->exp_date}}</td>
                        <td style="text-align: right">
                            <a href="{{ route('planning.edit', $cost->id) }}"><i class="bi bi-pencil-fill me-2"></i></a>
                        </td>
                        <td style="text-align: right">
                            <form action="{{ route('planning.destroy', $cost->id) }}" method="POST" >
                                @method('delete') @csrf
                                <button class="btn btn-sm" type="submit"><i class="bi bi-trash3 "></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endforeach
                </div>
        </div>
    </div>
@endsection
