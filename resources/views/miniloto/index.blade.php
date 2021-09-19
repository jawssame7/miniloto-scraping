@extends('layouts.app')

@section('content')
    <div class="ui segment seach">
        <form class="ui form" action="">
            <h4 class="ui dividing header">条件</h4>
            <div class="field">
                <label>すべて取得</label>
                <div class="two fields">
                    <div class="field">
                        <input type="checkbox" name="all" {{(empty($pagenate_params['all'])) ? '' : 'checked'}}>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="ui segment">
        <table>
            <thead>
                <tr>
                    <th class="times">回</th>
                    <th class="lottery-date">抽選日</th>
                    <th class="number-area">番号</th>
                    <th class="bonus-number">ボーナス数字</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($minilotoResults as $result)
                <tr>
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
@endsection
