@props(
    [
        'status' => true,
        'message' => '',
        'modalCls' => '',
        'btnCls' => ''
    ]
)

<div class="ui mini modal transition hidden success-modal">
    <div class="header">{{ $status ? '成功' : '失敗' }}</div>
    <div class="content">
      <p>{{$message}}</p>
    </div>
    <div class="actions">
      <div class="ui approve blue button {{ $btnCls }}">OK</div>
    </div>
  </div>
