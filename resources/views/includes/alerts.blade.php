@if (session('success'))
    <div class="alert alert-success msg-status">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {!! session('success') !!}
    </div>
@endif


@if (session('error'))
    <div class="alert alert-danger msg-status">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {!! session('error') !!}
    </div>
@endif


@if (session('info'))
    <div class="alert alert-info msg-status">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {!! session('info') !!}
    </div>
@endif