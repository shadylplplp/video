@foreach (['danger', 'warning', 'success', 'info','message'] as $msg)
    @if(session()->has($msg))
        <div class="flash-message col-md-12" style="margin-top: 15px;">
            <p class="alert alert-{{ $msg }}">
                {{ session()->get($msg) }}
            </p>
        </div>
    @endif
@endforeach