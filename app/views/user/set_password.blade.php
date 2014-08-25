@section('content')
<div class="row margin-top-10">
    <div class="col-sm-offset-4 col-sm-4 text-center">
        <img src="<?= URL::asset('img/logo.png') ?>" class="img-circle img-thumbnail"/>

        <h3>Set Password for your Account.</h3>

        <div>
            @if(isset($message))
            <p class="alert alert-danger">{{ $message or '' }}</p>
            @endif
        </div>
        <div>
            @foreach($errors->all() as $error)
            @if(isset($error))
            <p class="alert alert-danger">{{ $error or '' }}</p>
            @endif
            @endforeach

        </div>
        {{ Form::open(array('url' => action('UserController@postSetPassword'))) }}
        <span><?= $email ?></span>
        <?= Form::password('password', array('class' => 'form-control', 'placeholder' => 'password', 'style' => 'margin-bottom: 5px;')) ?>
        <?= Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'retype password', 'style' => 'margin-bottom: 5px;')) ?>
        <?= Form::submit("Set Password", array('class' => 'btn btn-primary btn-block')) ?>
        {{ Form::close(); }}
    </div>
</div>
@stop