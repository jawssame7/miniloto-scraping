@props(
    [
        'message' => '登録しますか？',
        'modalCls' => '',
        'btnCls' => ''
    ]
)

<div class="ui mini modal transition hidden {{ $modalCls }}">
    <div class="header">確認</div>
    <div class="content">
      <p>{{$message}}</p>
    </div>
    <div class="actions">
      <div class="ui approve red button {{ $btnCls }}">OK</div>
      <div class="ui cancel button">Cancel</div>
    </div>
  </div>
