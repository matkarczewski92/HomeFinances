@extends('layouts.app')

@section('content')


  @include('components.top', ['bg' => 'background-image: linear-gradient(0.15turn,#FFECD2 , #FCB69F);', 'title' => 'Stany kont',
  'additionalButtons' => '','additionalInfo' => ''])
  @livewire('finances.info-shot')


  <div class="row contentMainBox ">
    <div class="row contentGroup ">
        <div class="col content rounded-2 shadow me-3">
                <table class="table">
                    <tr>
                        <td>Konto bankowe</td>
                        <td>Kwota</td>
                        <td>Data</td>
                        <td style="width: 2%"></td>
                        <td style="width: 2%"></td>
                    </tr>
                    @foreach ($list as $acc)
                    <tr>
                        <td>{{$acc->accDetails->name}}</td>
                        <td>{{$acc->value}}</td>
                        <td>{{$acc->created_at->format("d-m-Y")}}</td>
                        <td style="text-align: right">
                            <a href="{{ route('accbalance.edit', $acc->id) }}"><i class="bi bi-pencil-fill me-2"></i></a>
                        </td>
                        <td style="text-align: right">
                            <form action="{{ route('accbalance.destroy', $acc->id) }}" method="POST" >
                                @method('delete') @csrf
                                <button class="btn btn-sm" type="submit"><i class="bi bi-trash3 "></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
        </div>
    </div>
  </div>


@endsection
