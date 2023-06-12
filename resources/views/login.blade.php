@extends("main")

@section('title')
MSG Stations
@stop

@section('stil')
<style>
    .btn-primary:hover {
        background: #30419b !important
    }

    .card {
        background: rgb(72 85 99 / 70%);
        background: -webkit-linear-gradient(to top, #29323c, #485563);
        background: linear-gradient(to top, rgb(41 50 60 / 70%), rgb(72 85 99 / 70%));
    }

    body {
        background-image: linear-gradient(-20deg, #c11e43 0%, #6944ff 100%);
        height: 100vh;
        color: #4e4a67;
    }

    .wrapperTwo {
        height: 100vh;
        width: 100%;
        position: fixed;
        opacity: 1;
        display: block;
        top: 0;
        z-index: 1;
    }

    .outer {
        margin: 0;
        position: fixed;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        min-width: 369px;
    }

    .indexLogo {
        width: 199px;
        position: fixed;
        bottom: 33px;
        right: 33px;
        z-index: 10000;
    }
</style>
@stop



@section('content')
<?php
$sayi1 = rand(1, 9);
$sayi2 = rand(1, 9);
$toplam_sayi = $sayi1 + $sayi2;
$_SESSION['security'] = $toplam_sayi;
session(['security' => $toplam_sayi]);
?>
<div style="position: fixed; z-index: -99; width: 100%; height: 100%; top:0px">
    <video id="video" width="100%" loop="true" autoplay="true" muted="muted">
        <source src="videoplayback.mp4" type="video/mp4">
    </video>
</div>
<div class="wrapperTwo">
    <div class="outer">
        <form action="{{url('login')}}" method="post">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="width: 100%">
                            <div class="card-body">
                                <p class="card-text">
                                <div class="mb-3">
                                    <label for="email" class="form-label text-light">E-mail</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label text-light">Şifre</label>
                                    <input class="form-control" id="password" name="password" autocomplete="off" type="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label text-light">Güvenlik Sorusu</label>
                                    <input class="form-control" name="security" autocomplete="off" type="text" placeholder="{{$sayi1}} + {{$sayi2}}">
                                </div>
                                </p>
                                <p>
                                    <a href="javascript:;" id="submit" class="btn btn-primary form-control" style="background:#c11e43 !important;font-weight:600;border:1px solid #c11e43">GİRİŞ YAP</a>
                                </p>
                                <p class="text-light text-center" style="font-size:13px;font-weight:300"><i class="fa fa-lock m-r-5"></i> E-posta adresiniz ve bilgisayar açma<br>şifreniz ile giriş yapabilirsiniz.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="indexLogo">
    <h3 class="text-center fw-bold text-light">MSG Stations</h1>
</div>
@stop



@section('script')

@if($errors->any())
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" id="errors" role="alert" style="display:none">
                @foreach ($errors->all() as $message)
                <span class="badge bg-danger">{{$message}}</span><br>
                @endforeach
            </div>
            <script>
                $(window).on('load', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Giriş Hatası',
                        confirmButtonText: 'Tamam',
                        showCloseButton: true,
                        html: $("#errors").html()
                    });
                });
            </script>
        </div>
    </div>
</div>
@endif

<script>
    $(document).on('keypress', function(e) {
        if (e.which == 13) {
            $("form").submit();
        }
    });

    $(document).ready(function() {
        $("#submit").click(function() {
            $("form").submit();
        });
    });
</script>
@stop