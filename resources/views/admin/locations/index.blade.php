@extends("main")

@section('title')
Lokasyon Yönetimi
@stop

@section('stil')
<style>
    #select2-services-container,
    .select2-results {
        font-size: 13px;
    }

    .select2-container {
        width: 100% !important;
        position: inherit !important;
    }

    .select2-container .select2-selection--single {
        height: 33px !important;
        padding-top: 4px;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da;
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
            <h4 class="fw-bold">Lokasyonlar
                {{ isset($r['search']) ? ' : ' . $r['search'] : '' }}
            </h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="javascript:;" class="new city btn btn-sm over2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalOne"><i class="fas fa-plus"></i>Lokasyon Ekle</a>
            <a href="{{ url('admin') }}" class="btn btn-sm over2 back fw-bold"><i class="fas fa-times"></i>Geri</a>
            @if(isset($r['search']))
            <a href="{{ url()->current() }}" class="btn btn-sm over2 back fw-bold"><i class="fa-solid fa-xmark"></i>Filtreyi Temizle</a>
            @else
            <a href="javascript:;" class="btn btn-sm over2 back fw-bold" id="search"><i class="fas fa-search"></i>Ara</a>
            @endif
        </div>
    </div>
</div>

<div class="h19"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive-md">
                <table id="grid-data" class="table">
                    <thead>
                        <tr>
                            <th scope="col">ŞUBE</th>
                            <th scope="col">LOKASYON</th>
                            <th scope="col">GÜNDÜZ/GECE</th>
                            <th scope="col">HAREKET SAATİ</th>
                            <th scope="col">HARİTA LİNKİ</th>
                            <th scope="col">DURUM</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td class="align-middle">{{ $data->connectBranch->name }}</td>
                            <td class="align-middle">{{ $data->name }}</td>
                            <td class="align-middle">{{ $data->connectShift->name }}</td>
                            <td class="align-middle">{{ $data->start_end_time }}</td>
                            <td class="align-middle">
                                @if($data->link)
                                <a href="{{ $data->link }}" class="btn btn-sm btn-light-success" target="_blank">Göster</a>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if($data->status == 1)
                                <div class="form-check form-switch myswitch" data-id="{{ $data->id }}">
                                    <input class="form-check-input" value="{{ $data->status }}" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                </div>
                                @else
                                <div class="form-check form-switch myswitch" data-id="{{ $data->id }}">
                                    <input class="form-check-input" value="{{ $data->status }}" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                </div>
                                @endif
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" data-id="{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#modalTwo" class="btn btn-sm btn-clean btn-icon mr-2 edit">
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
                <h1 class="modal-title fs-5" id="modalOneLabel">Lokasyon Ekle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formOne">
                    @csrf
                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasyon Adı</label>
                        <input type="text" name="name" autocomplete="off" class="form-control" id="location" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Şehir</label>
                        <select class="form-select" name="city_id" id="city">
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="district" class="form-label">İlçe</label>
                        <input type="text" name="filter" placeholder="İlçe Seçiniz" class="districts form-control" />
                        <div class="mySelect">
                            @foreach($routes as $route)
                            <div class="root">
                                <div class="form-check fw-bold first">
                                    <input class="form-check-input" type="checkbox" id="route-id-{{ $route->id }}">
                                    <label class="form-check-label" for="route-id-{{ $route->id }}">
                                        {{ $route->name }}
                                    </label>
                                </div>
                                @foreach($route->connectDistricts as $district)
                                <div class="sub">
                                    <div class="form-check">
                                        <input class="form-check-input" name="districts[]" type="checkbox" value="{{ $district->id }}" id="district-id-{{ $district->id }}">
                                        <label class="form-check-label" for="district-id-{{ $district->id }}">
                                            {{ $district->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="branch" class="form-label">Şube</label>
                        <select class="form-select" name="branch_id" id="branch">
                            <option value="" selected disabled>Şube Seçiniz</option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="shift" class="form-label">Vardiya</label>
                        <select class="form-select" name="shift_id" id="shift">
                            <option value="" selected disabled>Vardiya Seçiniz</option>
                            @foreach($shifts as $shift)
                            <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="start_end_time" class="form-label">Sabah Hareket</label>
                                <input type="text" name="start_end_time" autocomplete="off" class="form-control" id="start_end_time" placeholder="07:00-18:00">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="map_link" class="form-label">Harita Linki</label>
                        <input type="text" name="link" autocomplete="off" class="form-control" id="map_link" placeholder="">
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
                <h1 class="modal-title fs-5" id="modalTwoLabel">Lokasyon Güncelleyin</h1>
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

        $("#save").click(function() {
            var data = $("#formOne").serialize();
            var len = $("#location").val().length;
            var lenTwo = $("#branch").val();
            console.log(lenTwo);
            if (len == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Uyarı!',
                    text: 'Lütfen lokasyon adını boş bırakmayınız',
                    confirmButtonText: 'Tamam',
                    customClass: {
                        confirmButton: 'btn btn-success my-swal-button',
                        cancelButton: 'btn btn-danger'
                    }
                });
                return;
            }

            if (lenTwo == null) {
                Swal.fire({
                    icon: 'error',
                    title: 'Uyarı!',
                    text: 'Lütfen şube seçiniz',
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
                success: function(res) {
                    $("#loading").fadeOut();
                    if (res == "ok") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Lokasyon eklendi.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    } else if (res == "no") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Bu lokasyon zaten kayıtlı!',
                            text: 'Lütfen başka bir lokasyon adı belirleyin',
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

        $(".edit").click(function() {
            $("#formTwo").html('');
            var loadingHTML = "";
            loadingHTML += '<div class="loadingForm text-center">';
            loadingHTML += '<img src="../loading.gif" width="233" class="img-fluid" />';
            loadingHTML += '</div>';

            $("#formTwo").append(loadingHTML);
            $("#formTwo .loadingForm").fadeIn();
            var locationID = $(this).attr("data-id");
            var data = "id=" + locationID + "&_token={{ csrf_token() }}";
            $.ajax({
                url: "{{ myurl('getUpdateForm') }}",
                type: 'POST',
                data: data,
                success: function(res) {
                    $("#formTwo").html('');
                    var html = "";
                    html += '<div class="mb-3">';
                    html += '<input type="hidden" name="id" value="'+res['locationID']+'" />';
                    html +=
                        '<label for="location" class="form-label">Lokasyon Adı</label>';
                    html += '<input type="text" value="' + res['locations']
                        .name +
                        '" name="name" autocomplete="off" class="form-control" id="locationTwo" placeholder="">';
                    html += '</div>';

                    html += '<div class="mb-3">';
                    html +=
                        '<label for="city" class="form-label">Şehir</label>';
                    html +=
                        '<select class="form-select" name="city_id" id="cityTwo">';
                    $.each(res['cities'], function(i, v) {
                        var selected = res['locations'].city_id == v.id ?
                            " selected" : "";
                        html += '<option value="' + v.id + '"';
                        html += selected;
                        html += '>';
                        html += v.name;
                        html += '</option>';
                    });
                    html += '</select>';
                    html += '</div>';


                    html += '<div class="mb-3">';
                    html +=
                        '<label for="districtTwo" class="form-label">İlçeler</label>';
                    html += '<input type="text" name="filter" placeholder="İlçe Seçiniz" class="districts form-control" />';
                    html += '<div class="mySelect">';
                    html += '@foreach($routes as $route)';
                    html += '<div class="root">';
                    html += '<div class="form-check fw-bold first">';
                    html += '<input class="form-check-input" type="checkbox" id="route-two-id-{{ $route->id }}">';
                    html += '<label class="form-check-label" for="route-two-id-{{ $route->id }}">';
                    html += '{{ $route->name }}';
                    html += '</label>';
                    html += '</div>';
                    html += '@foreach($route->connectDistricts as $district)';
                    html += '<div class="sub">';
                    html += '<div class="form-check">';
                    html += '<input class="form-check-input" name="districts[]" type="checkbox" value="{{ $district->id }}" id="district-two-id-{{ $district->id }}">';
                    html += '<label class="form-check-label" for="district-two-id-{{ $district->id }}">';
                    html += '{{ $district->name }}';
                    html += '</label>';
                    html += '</div>';
                    html += '</div>';
                    html += '@endforeach';
                    html += '</div>';
                    html += '@endforeach';
                    html += '</div>';
                    html += '</div>';

                    html += '<div class="mb-3">';
                    html +=
                        '<label for="branch" class="form-label">Şube</label>';
                    html +=
                        '<select class="form-select" name="branch_id" id="branchTwo">';
                    $.each(res['branches'], function(i, v) {
                        var selected = res['locations'].branch_id == v.id ?
                            " selected" : "";
                        html += '<option value="' + v.id + '"';
                        html += selected;
                        html += '>';
                        html += v.name;
                        html += '</option>';
                    });
                    html += '</select>';
                    html += '</div>';

                    html += '<div class="mb-3">';
                    html +=
                        '<label for="shift" class="form-label">Şube</label>';
                    html +=
                        '<select class="form-select" name="shift_id" id="shiftTwo">';
                    $.each(res['shifts'], function(i, v) {
                        var selected = res['locations'].shift_id == v.id ?
                            " selected" : "";
                        html += '<option value="' + v.id + '"';
                        html += selected;
                        html += '>';
                        html += v.name;
                        html += '</option>';
                    });
                    html += '</select>';
                    html += '</div>';


                    var start_end_time = res['locations'].start_end_time !=
                        null ? res['locations'].start_end_time : '';
                    html += '<div class="row">';
                    html += '<div class="col-md-12">';
                    html += '<div class="mb-3">';
                    html +=
                        '<label for="start_end_time" class="form-label">Hareket Saati</label>'
                    html += '<input type="text" value="' + start_end_time +
                        '" name="start_end_time" autocomplete="off" class="form-control" id="start_time_two" placeholder="07:00-18:00">';
                    html += '</div>';
                    html += '</div>';

                    var link = res['locations'].link != null ? res['locations']
                        .link : "";

                    html += '<div class="mb-3">';
                    html +=
                        '<label for="map_link" class="form-label">Harita Linki</label>'
                    html += '<input type="text" value="' + link +
                        '" name="link" autocomplete="off" class="form-control" id="map_link" placeholder="">';
                    html += '</div>';

                    $("#formTwo").append(html);

                    $("#formTwo .districts").keyup(function() {

                        $(this).val().length > 0 ? $("#formTwo .mySelect").show() : $("#formTwo .mySelect").hide();

                        var val = $(this).val().toLowerCase();
                        var s = -1;
                        $("#formTwo .root").hide();
                        $("#formTwo .form-check-label").each(function() {
                            s = $(this).text().toLowerCase().indexOf(val);
                            if (s > -1) {
                                //console.log(s);
                                $(this).closest(".root").show();
                            }
                        });

                    });

                    $("#formTwo .root .first").click(function() {
                        var inputs = $(this).parent().find(".sub input");
                        var root = $(this).find("input");
                        if (root.is(':checked')) {
                            inputs.each(function() {
                                $(this).prop("checked", true);
                            });
                        } else {
                            inputs.each(function() {
                                $(this).prop("checked", false);
                            });
                        }
                    });

                    $.each(res.districts, function(i, v) {
                        $("#formTwo .mySelect").show();
                        $("#formTwo .form-check-input").each(function() {
                            var val = $(this).val();
                            if (val == v) {
                                $(this).click();
                                $(this).closest(".root").show();
                            }
                        });
                    });

                    $('.form-select').select2({
                        dropdownParent: $("#modalTwo")
                    });

                    $("#update").click(function() {
                        var data = $("#formTwo").serialize();
                        data += "&_token={{ csrf_token() }}";
                        var len = $("#formTwo .form-check-input:checked").length;
                        if (len == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Uyarı!',
                                text: 'Lütfen ilçe alanını boş bırakmayınız',
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
                            url: "{{ myurl('update') }}",
                            type: 'POST',
                            data: data,
                            success: function(res) {
                                $("#loading").fadeOut();
                                if (res == "ok") {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'success',
                                        title: 'Lokasyon güncellendi.',
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
                            error: function(err) {
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

            data += '&_token={{ csrf_token() }}&id=' + switchID;

            $.ajax({
                url: "{{ myurl('updateStatus') }}",
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

        $("#search").click(function() {
            Swal.fire({
                input: 'text',
                inputLabel: 'LOKASYON ARAYIN',
                inputPlaceholder: 'Aramak istediğiniz lokasyonun adını yazın...',
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

        $("#formOne .root .first").click(function() {
            var inputs = $(this).parent().find(".sub input");
            var root = $(this).find("input");
            if (root.is(':checked')) {
                inputs.each(function() {
                    $(this).prop("checked", true);
                });
            } else {
                inputs.each(function() {
                    $(this).prop("checked", false);
                });
            }
        });


    });
</script>
@stop