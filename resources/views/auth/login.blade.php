@extends('app')

@section('content')
<div class="login-form padding20 block-shadow"
	style="width:300px;margin:50px auto;padding:10px;">
        <form action="/auth/login" method="POST" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h1 class="text-light">Sign In</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">User email:</label>
                <input type="text" name="email" id="user_login">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">User password:</label>
                <input type="password" name="password" id="user_password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Sign In</button>   
            </div>
        </form>
    </div>
@endsection
