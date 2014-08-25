<div>
    @if(isset($message))
    <p class="alert alert-danger">{{ $message or '' }}</p>
    @endif
</div>
<div>
    @if(isset($status))
    <p class="alert alert-info">{{ $status or '' }}</p>
    @endif
</div>
<div>
    @if(isset($success))
    <p class="alert alert-success">{{ $success or '' }}</p>
    @endif
</div>
<div>
    @foreach($errors->all() as $error)
    @if(isset($error))
    <p class="alert alert-danger">{{ $error or '' }}</p>
    @endif
    @endforeach
</div>