@extends('layouts.app')

@section('content')
    子レーション
    <x-confirm_modal message='予想を記録しますか？' modalCls='forecast-add-confirm' btnCls='hoge' />
    <x-success_modal message='記録しました'/>
    <x-failure_modal/>
@endsection
