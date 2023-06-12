@extends('main')

@section('title')
    MSG Stations
@stop

@section('stil')
    <style>
        .btn-primary:hover {
            background: #30419b !important
        }

        .card {
            border: none !important;
        }

        .search {
            font-size: 19px !important;
            padding: 15px;
            border-radius: 33px;
            transition: all .2s ease-in-out;
            border: 7px solid rgb(192 30 70 / 30%);
        }

        .search:focus {
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
            border: 7px solid rgb(192 30 70 / 70%);
        }

        body {
            background-image: linear-gradient(-20deg, #c11e43 0%, #6944ff 100%);
            height: 100vh;
            color: #4e4a67;
            font-family: 'Barlow Condensed', sans-serif;
            overflow-x: hidden;
        }

        .indexLogo {
            width: 199px;
            position: fixed;
            bottom: 33px;
            right: 33px;
        }

        .resultCard {
            width: 100%;
            height: 209px;
            border-radius: 13px;
            box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

        .myIcon {
            position: absolute;
            width: 144px;
            left: 50%;
            margin-left: -72px;
            margin-top: -123px;
            z-index: 99;
        }


        .myTitleTwo {
            color: #0d0925;
        }

        .leftRectangle {
            width: 33%;
            min-width: 209px;
            margin-top: 19px;
            flex-shrink: 0;
            height: auto;
            box-shadow: 4px 13px 30px 1px rgb(252 56 56 / 20%);
            border-radius: 20px;
            transform: translateX(-80px);
            overflow: hidden;
            position: absolute;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
            background: linear-gradient(45deg, #d5135a, #f05924);
        }

        .way {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            opacity: 0.3;
            border-radius: 20px;
            transition: all 0.3s;

        }

        .test {
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100vh;
            opacity: 0.033;
        }

        .font13 {
            font-size: 13px;
        }

        .link {
            background: linear-gradient(45deg, #d5135a, #f05924);
            box-shadow: 0px 4px 30px rgb(223 45 70 / 60%);
            border-radius: 99px;
            width: auto;
            font-size: 16px;
            padding: 7px;
            padding-left: 13px;
            padding-right: 13px;
            transition: all 0.3s;
        }

        .link:hover {
            transform: scale(1.1);
        }

        .h9 {
            height: 9px;
        }

        .sonbahar {
            opacity: 0.13;
        }

        .select2-container {
            max-width: 100%;
        }

        #select2-services-container,
        .select2-results {
            font-size: 13px;
        }

        .select2-container .select2-selection--single {
            height: auto;
            min-height: 49px;
        }

        .select2-container--default .select2-selection--single {
            transition: all .2s ease-in-out;
            border: 7px solid rgb(192 30 70 / 0%);
            font-size: 19px;
        }

        .select2-container--default .select2-selection--single:focus {
            border: 7px solid rgb(192 30 70 / 0%);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #333 transparent transparent transparent;
        }

        .select2-selection {
            padding-top: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 33px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 30px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 25px;
            padding-left: 15px;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #dd284a;
            height: 33px;
            border-radius: 9px;
            padding: 13px;
            font-size: 13px;
            outline: unset;
        }

        .select2-container--default .select2-results>.select2-results__options {
            font-size: 13px;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #e64037;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #fff;
        }

        .select2-dropdown {
            border: unset !important;
        }


        @media (max-width: 1099px) {
            .video {
                display: none;
            }
        }

        .myOption {
            padding-left: 13px
        }

        .districts {
            font-size: 19px;
            height: auto;
            min-height: 49px;
            padding-left: 15px !important;
        }
    </style>

    <style>
        .sub {
            padding-left: 19px;
        }

        .sub .form-check-label {
            font-weight: 100;
        }

        .mySelect .form-check-input:checked {
            background-color: #c11e43;
        }

        .root {
            display: none;
        }

        .root label {
            cursor: pointer;
        }

        .root input {
            cursor: pointer;
        }

        .mySelect {
            border: 1px solid #ced4da;
            border-top: none;
            max-height: 233px;
            overflow-x: hidden;
            overflow-y: auto;
            display: none;
            padding: 9px;
            background: white;
            border-radius: 0.375rem;
        }
    </style>

@stop



@section('content')
    <div class="video" style="position: fixed; z-index: -99; width: 100%; height: 100%; top:0px">
        <video id="video" width="100%" loop="true" autoplay="true" muted="muted">
            <source src="bgtwo.mp4" type="video/mp4">
        </video>
    </div>
    <div class="h99"></div>
    <form action="{{ url('/query') }}" id="formOne" method="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h1 class="text-center fw-bold text-light">Senin Servisin Hangisi?</h1>
                    <h3 class="text-center fw-bold text-light">Hangi serviste olduğunu kolayca öğren.</h1>
                        <div class="h33"></div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 mb19">
                                    <select name="branch" id="" class="form-select">
                                        <option value="" disabled selected>Şube Seçiniz</option>
                                        @foreach ($branches as $branch)
                                            @if (isset($_POST['branch']) && $_POST['branch'] == $branch->id)
                                                <option value="{{ $branch->id }}" selected>
                                                    {{ $branch->name }}
                                                </option>
                                            @else
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb19">
                                    <select name="shift" id="" class="form-select">
                                        @foreach ($shifts as $shift)
                                            @if (isset($_POST['shift']) && $_POST['shift'] == $shift->id)
                                                <option value="{{ $shift->id }}" selected>
                                                    {{ $shift->name }}
                                                </option>
                                            @elseif($shift->id == 2)
                                                <option value="{{ $shift->id }}" selected>
                                                    {{ $shift->name }}
                                                </option>
                                            @else
                                                <option value="{{ $shift->id }}">
                                                    {{ $shift->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" placeholder="Semt adını giriniz." name="semt"
                                            id="semt" value="{{ isset($_POST['semt']) ? $_POST['semt'] : null }}"
                                            class="districts form-control" />
                                        <div class="mySelect">
                                            @foreach ($routes as $route)
                                                <div class="root">
                                                    <div class="form-check fw-bold first">
                                                        <input class="form-check-input" type="radio" name="route_id"
                                                            value="{{ $route->id }}" id="route-id-{{ $route->id }}">
                                                        <label class="form-check-label" data-val="{{ $route->name }}"
                                                            for="route-id-{{ $route->id }}">
                                                            {{ $route->name }}
                                                        </label>
                                                    </div>
                                                    @foreach ($route->connectDistricts as $district)
                                                        <div class="sub">
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="districts[]"
                                                                    type="radio" value="{{ $district->id }}"
                                                                    id="district-id-{{ $district->id }}">
                                                                <label class="form-check-label"
                                                                    data-val="{{ $district->name }}"
                                                                    for="district-id-{{ $district->id }}">
                                                                    {{ $district->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="javascript:;" class="btn btn-danger link" id="find"
                                        style="font-size: 27px;">SERVİSİMİ BUL <i class="fa-brands fa-searchengin"></i></a>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="h33"></div>
            <div class="h33"></div>

            @foreach ($datas as $data)
                <div class="row drivers">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="card resultCard">
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="leftRectangle">
                                        <img src="way.jpg" class="img-fluid sonbahar" />
                                        <div class="myIcon">
                                            <img src="bus-icon.png" width="144" />
                                            <h5 class="fw-bold myTitleTwo text-light text-center">
                                                {{ $data->plate }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-6">
                                            <h5 class="fw-bold myTitleTwo">{{ $data->name }}</h5>
                                            <h6>{{ $data->phone }}</h6>
                                            <h6><i class="fa-solid fa-location-dot"></i>
                                                {{ $data->connectLocation->name }}
                                            </h6>
                                            <h6><a href="{{ $data->connectLocation->link }}" class="btn btn-danger link"
                                                    target="_blank"><i class="fa-solid fa-link"></i> Harita Linki</a></h6>
                                            <!-- <h6><a href="javascript:;" class="btn btn-danger link" data-name="{{ isset($data->connectLocation->connectBranch->connectServiceManager->name) ? $data->connectLocation->connectBranch->connectServiceManager->name : null }}" data-phone="{{ isset($data->connectLocation->connectBranch->connectServiceManager->phone) ? $data->connectLocation->connectBranch->connectServiceManager->phone : null }}" id="serviceManager"><i class="fa-solid fa-user-tie"></i> Servis Sorumlusu</a></h6> -->
                                            <h6><a href="{{ url('guest') }}?driver_id={{ $data->id }}"
                                                    class="btn btn-danger link"><i class="fa-solid fa-circle-check"></i>
                                                    Servisi Kaydet</a></h6>

                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="h33"></div>
                </div>
            @endforeach
        </div>
        <!--<div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card resultCard">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="leftRectangle">
                                    <img src="way.jpg" class="img-fluid sonbahar" />
                                    <div class="myIcon">
                                        <img src="bus-icon.png" width="144" />
                                        <h5 class="fw-bold myTitleTwo text-light text-center">34 TEST 34</h5>
                                    </div>
                                </div>
                                <div class="h33"></div>
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-6">
                                        <h5 class="fw-bold myTitleTwo">Murat Toktaş</h5>
                                        <h6>(530) 212 4776</h6>
                                        <h6><i class="fa-solid fa-location-dot"></i> ATAŞEHİR - ZÜMRÜTEVLER</h6>
                                        <h6><a href="" class="btn btn-danger link"><i class="fa-solid fa-link"></i> Harita Linki</a></h6>

                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div> -->

    </form>
    <div class="indexLogo">
        <h3 class="text-center fw-bold text-light">MSG Stations</h1>
    </div>
@stop

@section('script')
    @if (isset($_GET['check']) && $_GET['check'] == 'ok')
        <script>
            var title = "Servis Kaydınız Alındı";
            Swal.fire({
                title: title,
                icon: 'success',
                showCloseButton: true,
                showConfirmButton: false,
                showCancelButton: false,
                focusConfirm: true,
            });
        </script>
    @elseif(isset($_GET['check']) && $_GET['check'] == 'no')
        <script>
            var title = "Servis Kaydınız Alınamadı";
            Swal.fire({
                title: title,
                icon: 'error',
                text: 'Lütfen daha sonra tekrar deneyiniz',
                showCloseButton: true,
                showConfirmButton: false,
                showCancelButton: false,
                focusConfirm: true,
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {

            $("#semt").click(function() {
                $(this).val("");
            });

            $(".mySelect .form-check-label").click(function() {
                var txt = $(this).attr("data-val");
                $("#semt").val(txt);
            });

            function formatOutput(state) {

                if (!state.id) {
                    return;
                    //return state.text;
                }

                var $state = "";
                if (state.element.value > 0) {
                    $state = $('<span class="fw-bold">' + state.element.text + '</span>');
                } else {
                    $state = $('<span class="myOption">' + state.element.text + '</span>');
                }

                return $state;

            };

            $('.form-select').select2({
                templateResult: formatOutput
            });

            $('b[role="presentation"]').hide();
            $('body').attr("overflow", "scroll");
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        $("#find").click(function() {
            $("#loading").fadeIn();
            $(".drivers").fadeOut(500);
            var form = $("form").serialize();
            $("form").submit();
        });

        $("#serviceManager").click(function() {
            var html = "";
            var title = '<strong>' + $(this).attr("data-name") + '</strong>';
            html += '<strong>';
            html += $(this).attr("data-phone");
            html += '</strong>';
            //html += 
            Swal.fire({
                title: title,
                icon: 'info',
                html: html,
                showCloseButton: true,
                showConfirmButton: false,
                showCancelButton: false,
                focusConfirm: true,
            });
        });

        $("#formOne .districts").keyup(function() {

            $(this).val().length > 0 ? $("#formOne .mySelect").show() : $("#formOne .mySelect").hide();

            var val = $(this).val().toLowerCase();
            var s = -1;
            $("#formOne .root").hide();
            $("#formOne .form-check-label").each(function() {
                s = $(this).text().toLowerCase().indexOf(val);
                if (s > -1) {
                    $(this).closest(".root").show();
                }
            });

        });
    </script>
@stop
