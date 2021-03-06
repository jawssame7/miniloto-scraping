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
        <div class="ui grid">
            <div class="row">
                <div class="column">
                    <button class="ui blue button right floated tiny add-forecast" >予想を記録しておく</button>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <button class="ui teal button right floated tiny add-row" >予想追加（行追加）</button>
                    <button class="ui button right floated tiny all-display">すべて表示</button>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <table class="ui single line table result">
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
                            <tr class="result-row">
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
        </div>
    </div>
    <x-confirm_modal message='予想を記録しますか？' modalCls='forecast-add-confirm' btnCls='hoge' />
    <x-success_modal message='記録しました'/>
    <x-failure_modal/>
@endsection
