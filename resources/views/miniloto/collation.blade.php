@extends('layouts.app')

@section('content')
<h3 class="ui header">
    最新の結果と予想の照合
</h3>
<div class="ui segment collation">
    <div class="ui grid">
        <div class="row forecast-grid-row">
            <div class="column">
                <table class="ui single line table forecast-results purple">
                    <thead>
                        <tr>
                            <th class="times">回</th>
                            <th class="lottery-date">抽選日</th>
                            <th class="number-area">番号</th>
                            <th class="bonus-number">ボーナス数字</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forecastResults as $result)
                        <tr class="forecast-results-row">
                            <td class="times align-left">{{$result->times}}</td>
                            <td class="lottery-date align-left">{{$result->lottery_date}}</td>
                            <td class="number-area">
                                <div>
                                    @for ($i = 0; $i < 31; $i++)
                                    @php
                                        $retNum = $i + 1;
                                        $num = $i < 9 ? '0'.$i + 1 : $i + 1;
                                        $perNums = explode(',', $result->per_numbers);
                                    @endphp
                                    <span class="{{in_array($num, $perNums) ? 'per-number' : ''}}">{{$num}}</span>
                                    @endfor
                                </div>
                            </td>
                            <td class="bonus-number">{{$result->bonus_number}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row result-grid-row">
            <div class="column">
                <table class="ui single line table results red">
                    <tbody>
                        @foreach ($minilotoResults as $result)
                        <tr class="result-row">
                            <td class="times align-left">{{$result->times . ' 結果'}}</td>
                            <td class="lottery-date align-left">{{$result->lottery_date}}</td>
                            <td class="number-area">
                                <div>
                                    @for ($i = 0; $i < 31; $i++)
                                    @php
                                        $retNum = $i + 1;
                                        $num = $i < 9 ? '0'.$i + 1 : $i + 1;
                                        $perNums = explode(',', $result->per_numbers);
                                    @endphp
                                    <span class="{{in_array($num, $perNums) ? 'per-number' : ''}}">{{$num}}</span>
                                    @endfor
                                </div>
                            </td>
                            <td class="bonus-number">{{$result->bonus_number}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-confirm_modal message='予想を記録しますか？' modalCls='forecast-add-confirm' btnCls='hoge' />
<x-success_modal message='記録しました'/>
<x-failure_modal/>
@endsection
