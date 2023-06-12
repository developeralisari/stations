@extends("main")

@section('title')
Sürücüleri Yönet
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
            <h4 class="fw-bold">Sürücü Yönetimi {{isset($r['search']) ? ' : ' . $r['search'] : ''}}</h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="javascript:;" class="new btn btn-sm btn-primary over2" data-bs-toggle="modal" data-bs-target="#modalOne"><i class="fas fa-plus"></i>Yeni Sürücü</a>
            <a href="{{url('admin')}}" class="btn btn-sm btn-warning over2 back"><i class="fas fa-times"></i>Geri</a>
            @if(isset($r['search']))
            <a href="{{url()->current()}}" class="btn btn-sm over2 back fw-bold"><i class="fa-solid fa-xmark"></i>Filtreyi Temizle</a>
            @else
            <a href="javascript:;" class="btn btn-sm over2 back fw-bold" id="search"><i class="fas fa-search"></i>Ara</a>
            @endif
        </div>
    </div>
</div>

<div class="h19"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ADSOYAD</th>
                            <th scope="col">PLAKA</th>
                            <th scope="col">TELEFON</th>
                            <th scope="col">GÜZERGAH</th>
                            <th scope="col">HARİTA LİNKİ</th>
                            <th scope="col">DURUM</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td class="align-middle">{{$data->name}}</td>
                            <td class="align-middle">{{$data->plate}}</td>
                            <td class="align-middle">{{$data->phone}}</td>
                            <td class="align-middle">{{isset($data->connectLocation->name) ? $data->connectLocation->name : ""}}</td>
                            <td class="align-middle">
                                @if(isset($data->connectLocation->link))
                                <a href="{{$data->connectLocation->link}}" class="btn btn-sm btn-light-success" target="_blank">Göster</a>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if($data->status == 1)
                                <div class="form-check form-switch myswitch" data-id="{{$data->id}}">
                                    <input class="form-check-input" value="{{$data->status}}" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                </div>
                                @else
                                <div class="form-check form-switch myswitch" data-id="{{$data->id}}">
                                    <input class="form-check-input" value="{{$data->status}}" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                </div>
                                @endif
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" data-id="{{$data->id}}" location-id="{{$data->location_id}}" data-bs-toggle="modal" data-bs-target="#modalTwo" class="btn btn-sm btn-clean btn-icon mr-2 edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
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
                <h1 class="modal-title fs-5 fw-bold" id="modalOneLabel">SÜRÜCÜ EKLE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formOne">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">SÜRÜCÜ ADSOYAD</label>
                                <input type="text" name="name" autocomplete="off" class="form-control" id="name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">TELEFON</label>
                                <input type="text" name="phone" autocomplete="off" class="form-control" id="phone" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="plate" class="form-label">PLAKA</label>
                                <input type="text" name="plate" autocomplete="off" class="form-control" id="plate" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="location_id" class="form-label">GÜZERGAH</label>
                                <select class="form-select" name="location_id" id="location_id">
                                    @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->name}}</option>
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
                <h1 class="modal-title fs-5 fw-bold" id="modalOneLabel">SÜRÜCÜ DÜZENLE</h1>
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

@stop

@section('script')
<script>
    $(document).ready(function() {

        $('.form-select').select2({
            dropdownParent: $("#modalOne")
        });

        $(".new").click(function() {
            $('.form-select').select2({
                dropdownParent: $("#modalOne")
            });
        });

        $('#phone').mask('(000) 000-0000');

        $("#save").click(function() {
            var data = $("#formOne").serialize();
            data += '&_token={{csrf_token()}}';
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

            len = $("#plate").val().length;
            if (len == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Uyarı!',
                    text: 'Lütfen plaka belirtiniz',
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
                url: "{{myurl('save')}}",
                type: 'POST',
                data: data,
                success: function(res) {
                    $("#loading").fadeOut();
                    if (res == "ok") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Sürücü eklendi.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    } else if (res == "no") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Bu sürücü zaten kayıtlı!',
                            text: 'Lütfen başka bir sürücü belirleyin',
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
                error: function(err) {
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

        $(".myswitch").click(function() {
            var val = $(this).find("input").attr("value");
            var switchID = $(this).attr("data-id");
            var data = "";
            if (val == 1) {
                data += 'status=0';
            } else {
                data += 'status=1';
            }

            data += '&_token={{csrf_token()}}&id=' + switchID;

            $.ajax({
                url: "{{myurl('updateStatus')}}",
                type: 'POST',
                data: data,
                success: function(res) {
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
                error: function(err) {
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

        $(".edit").click(function() {
            $("#formTwo").html('');
            var loadingHTML = "";
            loadingHTML += '<div class="loadingForm text-center">';
            loadingHTML += '<img src="../loading.gif" width="233" class="img-fluid" />';
            loadingHTML += '</div>';

            $("#formTwo").append(loadingHTML);
            $("#formTwo .loadingForm").fadeIn();
            var rowID = $(this).attr("data-id");
            var locationID = $(this).attr("location-id");
            var data = "locationID=" + locationID + "&id=" + rowID + "&_token={{csrf_token()}}";
            $.ajax({
                url: "{{myurl('getUpdateForm')}}",
                type: 'POST',
                data: data,
                success: function(res) {
                    $("#formTwo").html('');
                    var html = "";
                    html += '<div class="row">';
                    html += '<div class="col-md-6">';
                    html += '<div class="mb-3">'
                    html += '<input type="hidden" name="id" value="'+res['driverID']+'" />';
                    html += '<label for="name" class="form-label">SÜRÜCÜ ADSOYAD</label>';
                    html += '<input type="text" value="' + res['datas'].name + '" name="name" autocomplete="off" class="form-control" id="nameTwo" placeholder="">';
                    html += '</div>';
                    html += '</div>';

                    html += '<div class="col-md-6">';
                    html += '<div class="mb-3">';
                    html += '<label for="phone" class="form-label">TELEFON</label>';
                    html += '<input type="text" value="' + res['datas'].phone + '" name="phone" autocomplete="off" class="form-control" id="phoneTwo" placeholder="">';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    html += '<div class="row">';
                    html += '<div class="col-md-6">';
                    html += '<div class="mb-3">';
                    html += '<label for="plate" class="form-label">PLAKA</label>';
                    html += '<input type="text"  value="' + res['datas'].plate + '" name="plate" autocomplete="off" class="form-control" id="plateTwo" placeholder="">';
                    html += '</div>';
                    html += '</div>';

                    html += '<div class="col-md-6">';
                    html += '<div class="mb-3">';
                    html += '<label for="location_id" class="form-label">GÜZERGAH</label>';
                    html += '<select class="form-select" name="location_id" id="locationTwo">';
                    html += '@foreach($locations as $location)';
                    html += '<option value="{{$location->id}}">{{$location->name}}</option>';
                    html += '@endforeach';
                    html += '</select>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    $("#formTwo").append(html);

                    $('#phoneTwo').mask('(000) 000-0000');

                    $.each(res.locations, function(i, v) {
                        $('#locationTwo option[value="' + v + '"]').prop('selected', true).trigger('change');
                    });

                    $('.form-select').select2({
                        dropdownParent: $("#modalTwo")
                    });


                    $("#modalTwo #update").click(function() {
                        $("#loading").fadeIn();
                        var data = $("#formTwo").serialize();
                        //data += "&id=" + rowID;
                        data += "&_token={{csrf_token()}}";
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

                        len = $("#plateTwo").val().length;
                        if (len == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Uyarı!',
                                text: 'Lütfen plaka belirtiniz',
                                confirmButtonText: 'Tamam',
                                customClass: {
                                    confirmButton: 'btn btn-success my-swal-button',
                                    cancelButton: 'btn btn-danger'
                                }
                            });
                            return;
                        }

                        $.ajax({
                            url: "{{myurl('update')}}",
                            type: 'POST',
                            data: data,
                            success: function(res) {
                                $("#loading").fadeOut();
                                if (res == "ok") {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'success',
                                        title: 'Sürücü güncellendi.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        location.reload();
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
                            error: function(err) {
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
                },
                error: function(err) {
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

        $("#search").click(function() {
            Swal.fire({
                input: 'text',
                inputLabel: 'SÜRÜCÜ ARAYIN',
                inputPlaceholder: 'Aramak istediğiniz sürücünün adını yazın...',
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
                        var url = "{{url()->current()}}?search=" + val;
                        location.href = url;
                    }
                }
            });
        });
    });
</script>
@stop