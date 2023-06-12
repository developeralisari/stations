@extends("main")

@section('title')
Dashboard
@stop

    @section('stil')
    <style>
        .card,
        .mybutton {
            border: none !important;
        }

    </style>
    @stop

        @section('content')
        @include("navbar")

        <div class="h33"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <h6 class="card-header text-dark fw-bold"><i class="fa-solid fa-users-gear"></i> KULLANICILAR
                        </h6>
                        <div class="card-body">
                            <p class="card-text">Kullanıcı ekle, Kullanıcıları geçici olarak kaldır, Kullanıcılara
                                ayrıcalık ata</p>
                            <a href="{{ myurl('users') }}" class="btn btn-danger mycolor">Yönet</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h6 class="card-header text-dark fw-bold"><i class="fa-solid fa-map-location-dot"></i> LOKASYONLAR</h6>
                        <div class="card-body">
                            <p class="card-text">Sürücülere tanımlanan lokasyonları ekle,düzenle ve geçici olarak
                                kaldır.</p>
                            <a href="{{ myurl('locations') }}"
                                class="btn btn-danger mycolor">Yönet</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h6 class="card-header text-dark fw-bold"><i class="fa-solid fa-building"></i> ŞUBELER</h6>
                        <div class="card-body">
                            <p class="card-text">Lokasyonlar için şube ekle,düzenle ve geçici olarak kaldır.</p>
                            <a href="{{ myurl('branches') }}"
                                class="btn btn-danger mycolor">Yönet</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="h33"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <h6 class="card-header text-dark fw-bold"><i class="fa-solid fa-van-shuttle"></i> SÜRÜCÜLER</h6>
                        <div class="card-body">
                            <p class="card-text">Sürücü ekle, Sürücüleri geçici olarak kaldır, Sürücü güzergahlarını
                                belirle</p>
                            <a href="{{ myurl('drivers') }}" class="btn btn-danger mycolor">Yönet</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h6 class="card-header text-dark fw-bold"><i class="fa-solid fa-user-tie"></i> PERSONELLER</h6>
                        <div class="card-body">
                            <p class="card-text">Sürücüeler için personel ekle, personelleri düzenle ve geçici olarak kaldır</p>
                            <a href="{{ myurl('personels') }}" class="btn btn-danger mycolor">Yönet</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h6 class="card-header text-dark fw-bold"><i class="fa-solid fa-city"></i> İL / İLÇE / SEMTLER
                        </h6>
                        <div class="card-body">
                            <p class="card-text">Lokasyonlar için şehir ekle, ilçeleri ve semtleri yönet, geçici olarak
                                kaldır</p>
                            <a href="{{ myurl('cities') }}" class="btn btn-danger mycolor">Yönet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @stop
