@extends("main")

@section('title')
Kullanıcı Aktif Değil
@stop

@section('stil')
<style>
    body{
        background: #51cce0;
    }
</style>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="h33"></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h5 style="color:white">
                şifrenizi veya kullanıcı adınızı kontrol ediniz
            </h5>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{url('/')}}"><img src="{{url('images/ldap.gif')}}" width="399" alt=""></a>
        </div>
    </div>
</div>
@stop