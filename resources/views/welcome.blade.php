@extends('layouts.app')

@section('content')
<h2 class="ui header">
    メニュー
</h2>
<div class="ui horizontal segments">
    <div class="ui segment">
        <h3 class="ui dividing header">miniLoto</h3>
        <div class="ui middle aligned list">
            <div class="item">
                <div class="content">
                    <a class="header" href="{{route('miniloto.index')}}">結果</a>
                    <div class="description">抽選結果と抽選結果を参照しながら最新の予想を作成できます。</div>
                </div>
            </div>
            <div class="item">
                <div class="content">
                    <a class="header" href="{{route('miniloto.collation')}}">最新の結果と予想の照合</a>
                    <div class="description">抽選結果と予想結果の照合ができます。</div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui segment">
        <h3 class="ui dividing header">Loto6</h3>
    </div>
    <div class="ui segment">
        <h3 class="ui dividing header">Loto7</h3>
    </div>
</div>
@endsection
