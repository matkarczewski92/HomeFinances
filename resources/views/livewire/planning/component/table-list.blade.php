@foreach ($data as $inc)
                    <p class="title">{{$inc->name}}</p>
                    <table class="table summary">
                        <tr>
                            <td style="width: 30%">Tytuł</td>
                            <td>Kwota</td>
                            <td>Od</td>
                            <td>Do</td>
                            <td style="width: 2%"></td>
                            <td style="width: 2%"></td>
                        </tr>
                        @foreach ($plans->where('category', $inc->id) as $income)
                            @if ($income->created_at>$lastDay OR ($income->created_at<$firstDay AND $income->exp_date<$firstDay))
                                @php
                                    $style = "color: gray !important; font-style: italic; !important";
                                @endphp
                                @else
                                    @php
                                        $style = "";
                                    @endphp
                            @endif
                        <tr style="{{$style}}">
                            <td><span style="{{$style}}">{{$income->title}}</span>
                            @if ($income->created_at>$lastDay OR ($income->created_at<$firstDay AND $income->exp_date<$firstDay))
                                <small class="text-danger">(Nie obowiązuje w bieżącym miesiącu)</small>
                            @endif
                        </td>
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
