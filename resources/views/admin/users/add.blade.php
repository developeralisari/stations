@extends("main")

@section('title')
Kullanıcı Ekle
@stop

@section('stil')
<link rel="stylesheet" href="{{url('modul/select2/select2.min.css')}}">

<style>
    input {
        font-size: 13px !important;
    }
</style>
@stop

@section('content')
@include("navbar")
<div class="h19"></div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{url('admin/users')}}" class="btn btn-warning btn-sm over2 back"><i class="fas fa-times"></i>Geri</a>
        </div>
    </div>
</div>
<div class="h19"></div>

<form action="" id="user_form">
    @csrf
    <div class="container">
        <div class="col-md-6">
            <div class="card">
                <h6 class="card-header">Kullanıcı Ekle</h6>
                <div class="card-body">
                    <div id="error"></div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Ad Soyad</label>
                        <input type="text" name="name" value="" autocomplete="off" class="form-control" id="fullname">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="" name="email" autocomplete="off" class="form-control" id="email" placeholder="name@example.com">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" name="password" autocomplete="off" class="form-control" id="password">
                    </div>

                    <div class="mb-3">
                        <label for="confirmpassword" class="form-label">Şifre Tekrar</label>
                        <input type="password" name="password_confirmation" autocomplete="off" class="form-control" id="confirmpassword">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Kullanıcı Rolü</label>
                        <select name="role_id" id="role" class="form-select">
                            @foreach($roles as $role) 
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="is_ldap" value="false" type="checkbox" id="flexSwitchCheckChecked2">
                            <label class="form-check-label" for="flexSwitchCheckChecked2">Ldap?</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" value="false" type="checkbox" id="flexSwitchCheckChecked3">
                            <label class="form-check-label" for="flexSwitchCheckChecked3">Aktif?</label>
                        </div>
                    </div>

                    <a href="javascript:;" id="save" class="btn btn-primary btn-sm">Save</a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="h19"></div>
@stop

@section('script')

<script src="{{url('modul/select2/select2.min.js')}}"></script>



<script>

    $(document).ready(function() {

        $('#role').select2();

        $("#save").click(function() {

            $(".hide").remove();

            $("input[type=checkbox]:not(:checked)").each(function(index, value) {
                var name = $(this).attr("name");
                var value = $(this).val();
                var html = '<input type="hidden" class="hide" name="' + name + '" value="0" />';
                $(this).after(html);
            });

            $("input[type=checkbox]:checked").each(function(index, value) {
                var name = $(this).attr("name");
                var value = $(this).val();
                var html = '<input type="hidden" class="hide" name="' + name + '" value="1" />';
                $(this).after(html);
            });

            $("#loading").fadeIn();
            var url = "{{url()->full()}}";
            var data = $("form").serialize();
            $.ajax({
                url: url,
                type: "post",
                data: data,
                success: function(res) {
                    $("#loading").fadeOut();
                    if (res == "ok") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Kullanıcı eklendi',
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            location.href = document.referrer;
                        });
                    }

                    if (res == "no") {
                        Swal.fire({
                            icon: 'error',
                            text: 'Kullanıcı sistemde tanımlı, email adresini kontrol ediniz',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $("#loading").fadeOut();
                    }

                    if (res == "error") {
                        Swal.fire({
                            icon: 'error',
                            text: 'İşlem gerçekleşemedi',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $("#loading").fadeOut();
                    }

                    if (res == "mail") {
                        Swal.fire({
                            icon: 'error',
                            text: 'Kullanıcı eklendi, mail gönderilemedi',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $("#loading").fadeOut();
                    }
                },
                error: function(err) {
                    $("#loading").fadeOut();
                    $("#error_message").remove();
                    var errors = err.responseJSON.errors;
                    errors = JSON.parse(JSON.stringify(errors));
                    var arr = [];
                    $.each(errors, function(index, value) {
                        arr.push(value);
                    });
                    let msg = arr.toString().split(',').join("<br />");
                    html = "";
                    html += '<div class="alert alert-danger" id="error_message" role="alert">';
                    html += msg;
                    html += '</div>';
                    $("#error").html(html);
                    $("#error_message").hide();
                    $("#error_message").fadeIn("slow");
                }
            });
        });
    });
</script>
@stop