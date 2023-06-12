@extends("main")

@section('title')
Şubeleri Yönet
@stop

    @section('stil')
    <style>
        #select2-services-container,
        .select2-results {
            font-size: 13px;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: 30px;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #333 transparent transparent transparent;
        }

        .select2-selection {
            height: 33px !important;
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

    </style>
    @stop

        @section('content')
        @include("navbar")

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="h33"></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="fw-bold">Şube Yönetimi
                        {{ isset($r['search']) ? ' : ' . $r['search'] : '' }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="javascript:;" class="new btn btn-sm btn-primary over2" data-bs-toggle="modal"
                        data-bs-target="#modalOne"><i class="fas fa-plus"></i>Yeni Şube</a>
                    <a href="{{ url('admin') }}" class="btn btn-sm btn-warning over2 back"><i
                            class="fas fa-times"></i>Geri</a>
                    @if(isset($r['search']))
                        <a href="{{ url()->current() }}" class="btn btn-sm over2 back fw-bold"><i
                                class="fa-solid fa-xmark"></i>Filtreyi Temizle</a>
                    @else
                        <a href="javascript:;" class="btn btn-sm over2 back fw-bold" id="search"><i
                                class="fas fa-search"></i>Ara</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="h19"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive-md">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ŞUBE ADI</th>
                                    <th scope="col">ŞEHİR</th>
                                    <th scope="col">DURUM</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td class="align-middle">{{ $data->name }}</td>
                                        <td class="align-middle">{{ $data->connectCity->name }}</td>
                                        <td class="align-middle">
                                            @if($data->status == 1)
                                                <div class="form-check form-switch myswitch"
                                                    data-id="{{ $data->id }}">
                                                    <input class="form-check-input" value="{{ $data->status }}"
                                                        type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                                        checked>
                                                </div>
                                            @else
                                                <div class="form-check form-switch myswitch"
                                                    data-id="{{ $data->id }}">
                                                    <input class="form-check-input" value="{{ $data->status }}"
                                                        type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                </div>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" data-id="{{ $data->id }}" data-bs-toggle="modal"
                                                data-bs-target="#modalTwo"
                                                class="btn btn-sm btn-clean btn-icon mr-2 edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            @if(isset($data->connectServiceManager->name))
                                                <a href="javascript:;" data-id="{{ $data->id }}" class="btnColor editServiceManager btn btn-sm btn-primary over2" data-bs-toggle="modal" data-bs-target="#modalFour"><i class="fa-solid fa-user-tie"></i></a>
                                            @else
                                                <a href="javascript:;" data-id="{{ $data->id }}" class="newServiceManager btn btn-sm btn-primary over2" data-bs-toggle="modal" data-bs-target="#modalThree"><i class="fas fa-plus"></i>Servis Sorumlusu Ekle</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{ $datas->appends(request()->query()) }}
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalOne" tabindex="-1" aria-labelledby="modalOneLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="modalOneLabel">ŞUBE EKLE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formOne">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">ŞUBE ADI</label>
                                        <input type="text" name="name" autocomplete="off" class="form-control" id="name"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">ŞEHİR</label>
                                        <select name="city_id" class="form-select">
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light-success" id="save">Kaydet</button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalTwo" tabindex="-1" aria-labelledby="modalTwoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="modalOneLabel">ŞEHİR DÜZENLE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formTwo">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light-success" id="update">Güncelle</button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalThree" tabindex="-1" aria-labelledby="modalThreeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="modalThreeLabel">SERVİS SORUMLUSU EKLE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formThree">
                            @csrf
                            <input type="hidden" name="branch_id" id="branchID" value="" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">SERVİS SORUMLUSU</label>
                                        <input type="text" name="name" autocomplete="off" class="form-control" id="nameThree"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">TELEFON</label>
                                        <input type="text" id="phoneThree" name="phone" autocomplete="off" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light-success" id="saveThree">Kaydet</button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalFour" tabindex="-1" aria-labelledby="modalFourLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="modalFourLabel">SERVİS SORUMLUSU DÜZENLE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formFour">
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light-success" id="updateFour">Güncelle</button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>

        @stop

            @section('script')
            <script>
                $(document).ready(function () {
                    $('[data-bs-toggle="tooltip"]').tooltip();

                    $('.form-select').select2({
                        dropdownParent: $("#modalOne")
                    });

                    $('#formThree #phone').mask('(000) 000-0000');

                    $(".new").click(function () {
                        $('.form-select').select2({
                            dropdownParent: $("#modalOne")
                        });
                    });

                    $(".newServiceManager").click(function () {
                        var rowID = $(this).attr("data-id");
                        $("#formThree #branchID").attr("value", rowID);
                    });

                    $("#save").click(function () {
                        var data = $("#formOne").serialize();
                        data += '&_token={{ csrf_token() }}';
                        var len = $("#name").val().length;
                        if (len == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Uyarı!',
                                text: 'Lütfen sürücü adını boş bırakmayınız',
                                confirmButtonText: 'Tamam',
                                customClass: {
                                    confirmButton: 'btn btn-success my-swal-button',
                                    cancelButton: 'btn btn-danger'
                                }
                            });
                            return;
                        }

                        $("#loading").fadeIn();
                        $.ajax({
                            url: "{{ myurl('save') }}",
                            type: 'POST',
                            data: data,
                            success: function (res) {
                                $("#loading").fadeOut();
                                if (res == "ok") {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'success',
                                        title: 'Şube eklendi.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else if (res == "no") {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Bu şube zaten kayıtlı!',
                                        text: 'Lütfen başka bir şube adı belirleyin',
                                        confirmButtonText: 'Tamam',
                                        customClass: {
                                            confirmButton: 'btn btn-success my-swal-button',
                                            cancelButton: 'btn btn-danger'
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Hata...',
                                        text: 'İşlem gerçekleşemedi!',
                                        footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                    });
                                }
                            },
                            error: function (err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: err.status,
                                    text: err.statusText,
                                    confirmButtonText: 'Tamam',
                                    customClass: {
                                        confirmButton: 'btn btn-danger my-swal-button',
                                    },
                                    buttonsStyling: false,
                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                });
                            }
                        });
                    });

                    $("#saveThree").click(function () {
                        var data = $("#formThree").serialize();
                        data += "&_token={{ csrf_token() }}";
                        var len = $("#nameThree").val().length;
                        if (len == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Uyarı!',
                                text: 'Lütfen servis sorumlusu adını boş bırakmayınız',
                                confirmButtonText: 'Tamam',
                                customClass: {
                                    confirmButton: 'btn btn-success my-swal-button',
                                    cancelButton: 'btn btn-danger'
                                }
                            });
                            return;
                        }

                        var len = $("#phoneThree").val().length;
                        if (len == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Uyarı!',
                                text: 'Lütfen bir telefon numarası giriniz',
                                confirmButtonText: 'Tamam',
                                customClass: {
                                    confirmButton: 'btn btn-success my-swal-button',
                                    cancelButton: 'btn btn-danger'
                                }
                            });
                            return;
                        }

                        $("#loading").fadeIn();
                        $.ajax({
                            url: "{{ myurl('saveServiceManager') }}",
                            type: 'POST',
                            data: data,
                            success: function (res) {
                                $("#loading").fadeOut();
                                if (res == "ok") {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'success',
                                        title: 'Servis sorumlusu eklendi.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else if (res == "no") {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Bu servis sorumlusu zaten kayıtlı!',
                                        text: 'Lütfen başka bir şube adı belirleyin',
                                        confirmButtonText: 'Tamam',
                                        customClass: {
                                            confirmButton: 'btn btn-success my-swal-button',
                                            cancelButton: 'btn btn-danger'
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Hata...',
                                        text: 'İşlem gerçekleşemedi!',
                                        footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                    });
                                }
                            },
                            error: function (err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: err.status,
                                    text: err.statusText,
                                    confirmButtonText: 'Tamam',
                                    customClass: {
                                        confirmButton: 'btn btn-danger my-swal-button',
                                    },
                                    buttonsStyling: false,
                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                });
                            }
                        });
                    });

                    $(".myswitch").click(function () {
                        var val = $(this).find("input").attr("value");
                        var switchID = $(this).attr("data-id");
                        var data = "";
                        if (val == 1) {
                            data += 'status=0';
                        } else {
                            data += 'status=1';
                        }

                        data += '&_token={{ csrf_token() }}&id=' + switchID;

                        $.ajax({
                            url: "{{ myurl('updateStatus') }}",
                            type: 'POST',
                            data: data,
                            success: function (res) {
                                if (res == "ok") {
                                    if (res == "ok") {
                                        Swal.fire({
                                            position: 'top-center',
                                            icon: 'success',
                                            title: 'Durum güncellendi',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Hata...',
                                            text: 'İşlem gerçekleşemedi!',
                                            footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                        });
                                    }
                                }
                            },
                            error: function (err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: err.status,
                                    text: err.statusText,
                                    confirmButtonText: 'Tamam',
                                    customClass: {
                                        confirmButton: 'btn btn-danger my-swal-button',
                                    },
                                    buttonsStyling: false,
                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                });
                            }
                        });


                    });

                    $(".edit").click(function () {
                        $("#formTwo").html('');
                        var loadingHTML = "";
                        loadingHTML += '<div class="loadingForm text-center">';
                        loadingHTML += '<img src="../loading.gif" width="233" class="img-fluid" />';
                        loadingHTML += '</div>';

                        $("#formTwo").append(loadingHTML);
                        $("#formTwo .loadingForm").fadeIn();
                        var rowID = $(this).attr("data-id");
                        var data = "id=" + rowID + "&_token={{ csrf_token() }}";
                        $.ajax({
                            url: "{{ myurl('getUpdateForm') }}",
                            type: 'POST',
                            data: data,
                            success: function (res) {
                                $("#formTwo").html('');
                                var html = "";
                                html += '<div class="row">';
                                html += '<div class="col-md-12">';
                                html += '<div class="mb-3">'
                                html += '<input type="hidden" name="id" value="'+res['branchID']+'" />';
                                html +=
                                    '<label for="name" class="form-label">ŞEHİR ADI</label>';
                                html += '<input type="text" value="' + res['datas'].name +
                                    '" name="name" autocomplete="off" class="form-control" id="nameTwo" placeholder="">';
                                html += '</div>';
                                html += '<select class="form-select">';

                                $.each(res['cities'], function (i, v) {
                                    var selected = res['datas'].city_id == v.id ?
                                        " selected" : "";
                                    html += '<option value="' + v.id + '"';
                                    html += selected;
                                    html += '>';
                                    html += v.name;
                                    html += '</option>';
                                });

                                html += '</div>';

                                $("#formTwo").append(html);

                                $('.form-select').select2({
                                    dropdownParent: $("#modalTwo")
                                });


                                $("#update").click(function () {
                                    $("#loading").fadeIn();
                                    var data = $("#formTwo").serialize();
                                    //data += "&id=" + rowID;
                                    data += "&_token={{ csrf_token() }}";
                                    var len = $("#nameTwo").val().length;
                                    if (len == 0) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Uyarı!',
                                            text: 'Lütfen sürücü adını boş bırakmayınız',
                                            confirmButtonText: 'Tamam',
                                            customClass: {
                                                confirmButton: 'btn btn-success my-swal-button',
                                                cancelButton: 'btn btn-danger'
                                            }
                                        });
                                        return;
                                    }

                                    $.ajax({
                                        url: "{{ myurl('update') }}",
                                        type: 'POST',
                                        data: data,
                                        success: function (res) {
                                            $("#loading").fadeOut();
                                            if (res == "ok") {
                                                Swal.fire({
                                                    position: 'top-center',
                                                    icon: 'success',
                                                    title: 'Şube güncellendi.',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then((
                                                    result) => {
                                                    location
                                                        .reload();
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Hata...',
                                                    text: 'İşlem gerçekleşemedi!',
                                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                                });
                                            }

                                        },
                                        error: function (err) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: err
                                                    .status,
                                                text: err
                                                    .statusText,
                                                confirmButtonText: 'Tamam',
                                                customClass: {
                                                    confirmButton: 'btn btn-danger my-swal-button',
                                                },
                                                buttonsStyling: false,
                                                footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                            });
                                        }
                                    });
                                });
                            },
                            error: function (err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: err.status,
                                    text: err.statusText,
                                    confirmButtonText: 'Tamam',
                                    customClass: {
                                        confirmButton: 'btn btn-danger my-swal-button',
                                    },
                                    buttonsStyling: false,
                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                });
                            }
                        });
                    });

                    $("#search").click(function () {
                        Swal.fire({
                            input: 'text',
                            inputLabel: 'ŞEHİR ARAYIN',
                            inputPlaceholder: 'Aramak istediğiniz şehrin adını yazın...',
                            inputAttributes: {
                                'aria-label': 'Type your message here'
                            },
                            customClass: {
                                confirmButton: 'btn btn-sm btn-light-success',
                                cancelButton: 'btn btn-sm btn-danger'
                            },
                            showCancelButton: false,
                            showConfirmButton: false,
                            confirmButtonText: 'Ara',
                            cancelButtonText: 'Kapat',
                            confirmButtonColor: '#02c58d',
                            cancelButtonColor: '#fc5454',
                            preConfirm: () => {
                                Swal.showLoading()
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var val = result.value;
                                var len = result.value.length;
                                if (len > 0) {
                                    var url = "{{ url()->current() }}?search=" + val;
                                    location.href = url;
                                }
                            }
                        });
                    });

                    $("#route").click(function () {
                        $("#formThree").html('');
                        var loadingHTML = "";
                        loadingHTML += '<div class="loadingForm text-center">';
                        loadingHTML += '<img src="../loading.gif" width="233" class="img-fluid" />';
                        loadingHTML += '</div>';

                        $("#formThree").append(loadingHTML);
                        $("#formThree .loadingForm").fadeIn();
                        var rowID = $(this).attr("data-id");
                        var data = "id=" + rowID + "&_token={{ csrf_token() }}";

                        $.ajax({
                            url: "{{ myurl('getRouteUpdateForm') }}",
                            type: 'POST',
                            data: data,
                            success: function (res) {
                                $("#formThree").html('');
                                var names = res.join("\r\n");

                                var html = "";
                                html += '<div class="row">';
                                html += '<div class="col-md-12">';
                                html += '<div class="mb-3">'
                                html +=
                                    '<label for="name" class="form-label">İLÇELER</label>';
                                html +=
                                    '<textarea class="form-control" name="name" id="routes" cols="30" rows="10">' +
                                    names + '</textarea>';
                                html += '</div>';
                                html += '</div>';

                                $("#formThree").append(html);

                                $("#routeUpdate").click(function () {
                                    $("#loading").fadeIn();
                                    var data = $("#formThree").serialize();
                                    data += "&id=" + rowID;
                                    data += "&_token={{ csrf_token() }}";

                                    $.ajax({
                                        url: "{{ myurl('updateRoutes') }}",
                                        type: 'POST',
                                        data: data,
                                        success: function (res) {
                                            console.log(res);
                                            $("#loading").fadeOut();
                                            if (res == "ok") {
                                                Swal.fire({
                                                    position: 'top-center',
                                                    icon: 'success',
                                                    title: 'İlçeler güncellendi.',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then((
                                                    result) => {
                                                    location
                                                        .reload();
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Hata...',
                                                    text: 'İşlem gerçekleşemedi!',
                                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                                });
                                            }

                                        },
                                        error: function (err) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: err
                                                    .status,
                                                text: err
                                                    .statusText,
                                                confirmButtonText: 'Tamam',
                                                customClass: {
                                                    confirmButton: 'btn btn-danger my-swal-button',
                                                },
                                                buttonsStyling: false,
                                                footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                            });
                                        }
                                    });
                                });
                            },
                            error: function (err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: err.status,
                                    text: err.statusText,
                                    confirmButtonText: 'Tamam',
                                    customClass: {
                                        confirmButton: 'btn btn-danger my-swal-button',
                                    },
                                    buttonsStyling: false,
                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                });
                            }
                        });
                    });

                    $("#district").click(function () {
                        $("#formFour").html('');
                        var loadingHTML = "";
                        loadingHTML += '<div class="loadingForm text-center">';
                        loadingHTML += '<img src="../loading.gif" width="233" class="img-fluid" />';
                        loadingHTML += '</div>';

                        $("#formFour").append(loadingHTML);
                        $("#formFour .loadingForm").fadeIn();
                        var rowID = $(this).attr("data-id");
                        var data = "id=" + rowID + "&_token={{ csrf_token() }}";

                        $.ajax({
                            url: "{{ myurl('getDistrictUpdateForm') }}",
                            type: 'POST',
                            data: data,
                            success: function (res) {
                                $("#formFour").html('');

                                var html = "";
                                html += '<div class="row">';
                                html += '<div class="col-md-12">';
                                html += '<div class="mb-3">';
                                html +=
                                    '<select class="form-select" name="routeID" id="routeDistrict">';
                                html +=
                                    '<option value="" disabled selected>Semt Seçiniz</option>';
                                $.each(res, function (i, v) {
                                    html += '<option value="' + v.id + '">' + v
                                        .name + '</option>';
                                });
                                html += '</select>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';

                                $("#formFour").append(html);

                                $('.form-select').select2({
                                    dropdownParent: $("#modalFour")
                                });

                                $("#routeDistrict").change(function () {
                                    var routeID = $(this).val();
                                    $.post("{{ myurl('getDistrictForm') }}", {
                                        id: rowID,
                                        routeID: routeID,
                                        _token: "{{ csrf_token() }}"
                                    }, function (result) {
                                        html = "";
                                        var names = result.join("\r\n");
                                        $("#formFour #districts").remove();
                                        html +=
                                            '<textarea class="form-control" name="name" id="districts" cols="30" rows="10">' +
                                            names + '</textarea>';
                                        $("#formFour").append(html);
                                    });
                                });

                                $("#districtUpdate").click(function () {
                                    $("#loading").fadeIn();
                                    var data = $("#formFour").serialize();
                                    data += "&id=" + rowID;
                                    data += "&_token={{ csrf_token() }}";

                                    $.ajax({
                                        url: "{{ myurl('updateDistricts') }}",
                                        type: 'POST',
                                        data: data,
                                        success: function (res) {
                                            $("#loading").fadeOut();
                                            if (res == "ok") {
                                                Swal.fire({
                                                    position: 'top-center',
                                                    icon: 'success',
                                                    title: 'Semtler güncellendi.',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then((
                                                    result) => {
                                                    location
                                                        .reload();
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Hata...',
                                                    text: 'İşlem gerçekleşemedi!',
                                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                                });
                                            }

                                        },
                                        error: function (err) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: err
                                                    .status,
                                                text: err
                                                    .statusText,
                                                confirmButtonText: 'Tamam',
                                                customClass: {
                                                    confirmButton: 'btn btn-danger my-swal-button',
                                                },
                                                buttonsStyling: false,
                                                footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                            });
                                        }
                                    });
                                });
                            },
                            error: function (err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: err.status,
                                    text: err.statusText,
                                    confirmButtonText: 'Tamam',
                                    customClass: {
                                        confirmButton: 'btn btn-danger my-swal-button',
                                    },
                                    buttonsStyling: false,
                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                });
                            }
                        });
                    });

                    $(".editServiceManager").click(function () {
                        $("#formFour").html('');
                        var loadingHTML = "";
                        loadingHTML += '<div class="loadingForm text-center">';
                        loadingHTML += '<img src="../loading.gif" width="233" class="img-fluid" />';
                        loadingHTML += '</div>';

                        $("#formFour").append(loadingHTML);
                        $("#formFour .loadingForm").fadeIn();
                        var rowID = $(this).attr("data-id");
                        var data = "id=" + rowID + "&_token={{ csrf_token() }}";
                        $.ajax({
                            url: "{{ myurl('getUpdateFormServiceManager') }}",
                            type: 'POST',
                            data: data,
                            success: function (res) {
                                $("#formFour").html('');
                                var html = "";
                                html += '<div class="row">';
                                html += '<div class="col-md-12">';
                                html += '<input type="hidden" name="id" value="'+res.id+'" />';
                                html += '<div class="mb-3">'
                                html +=
                                    '<label for="name" class="form-label">SERVİS SORUMLUSU</label>';
                                html += '<input type="text" value="' + res.name +
                                    '" name="name" autocomplete="off" class="form-control" id="nameFour" placeholder="">';
                                html += '</div>';
                                
                                html += '<div class="mb-3">'
                                html +=
                                    '<label for="name" class="form-label">TELEFON</label>';
                                html += '<input type="text" value="' + res.phone +
                                    '" name="phone" autocomplete="off" id="phoneFour" class="form-control" placeholder="">';
                                html += '</div>';

                                $("#formFour").append(html);

                                $('#formFour #phoneFour').mask('(000) 000-0000');

                                $("#updateFour").click(function () {
                                    var data = $("#formFour").serialize();
                                    data += "&_token={{ csrf_token() }}";
                                    var len = $("#nameFour").val().length;
                                    if (len == 0) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Uyarı!',
                                            text: 'Lütfen servis sorumlusu adını boş bırakmayınız',
                                            confirmButtonText: 'Tamam',
                                            customClass: {
                                                confirmButton: 'btn btn-success my-swal-button',
                                                cancelButton: 'btn btn-danger'
                                            }
                                        });
                                        return;
                                    }

                                    var len = $("#phoneFour").val().length;
                                    if (len == 0) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Uyarı!',
                                            text: 'Lütfen bir telefon numarası giriniz',
                                            confirmButtonText: 'Tamam',
                                            customClass: {
                                                confirmButton: 'btn btn-success my-swal-button',
                                                cancelButton: 'btn btn-danger'
                                            }
                                        });
                                        return;
                                    }
                                    $("#loading").fadeIn();
                                    $.ajax({
                                        url: "{{ myurl('updateServiceManager') }}",
                                        type: 'POST',
                                        data: data,
                                        success: function (res) {
                                            $("#loading").fadeOut();
                                            if (res == "ok") {
                                                Swal.fire({
                                                    position: 'top-center',
                                                    icon: 'success',
                                                    title: 'Servis sorumlusu güncellendi.',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then((
                                                    result) => {
                                                    location
                                                        .reload();
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Hata...',
                                                    text: 'İşlem gerçekleşemedi!',
                                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                                });
                                            }

                                        },
                                        error: function (err) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: err
                                                    .status,
                                                text: err
                                                    .statusText,
                                                confirmButtonText: 'Tamam',
                                                customClass: {
                                                    confirmButton: 'btn btn-danger my-swal-button',
                                                },
                                                buttonsStyling: false,
                                                footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                            });
                                        }
                                    });
                                });
                            },
                            error: function (err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: err.status,
                                    text: err.statusText,
                                    confirmButtonText: 'Tamam',
                                    customClass: {
                                        confirmButton: 'btn btn-danger my-swal-button',
                                    },
                                    buttonsStyling: false,
                                    footer: 'Lütfen bir süre sonra tekrar deneyin.'
                                });
                            }
                        });
                    });
                });

            </script>
            @stop
