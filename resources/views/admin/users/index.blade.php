@extends('main')

@section('title')
Kullanıcı Yönetimi
@stop

@section('stil')
<style>
    .myCircle {
        font-size: 5px;
        position: relative;
        top: -4px;
        opacity: 0.9;
    }

    .card-header {
        font-size: 13px;
    }

    .card-header span {
        font-size: 11px;
    }

    .bb {
        border-bottom: 1px solid #ededed;
    }

    .clear {
        clear: both;
    }

    .title {
        position: relative;
        top: 9px;
    }

    #filter {
        display: none;
        position: relative;
        top: 19px;
        margin-bottom: 19px;
    }

    .form-select {
        border: 1px solid #333;
        border-color: inherit;
        -webkit-box-shadow: none;
        box-shadow: none;
        font-size: 11px;
    }

    .date {
        height: 30px;
        font-size: 11px
    }

    .datepicker {
        font-size: 11px;
    }

    .ml9 {
        margin-left: 9px;
    }

    .description {
        font-size: 13px;
    }

    .card:hover .card-header {
        background: rgb(220 53 69 / 13%);
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
            <h4 class="fw-bold">Kullanıcı Yönetimi.</h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{myurl('add')}}" class="new btn btn-sm btn-primary over2"><i class="fas fa-plus"></i>Yeni Kullanıcı</a>
            <a href="{{url('admin')}}" class="btn btn-sm btn-warning over2 back"><i class="fas fa-times"></i>Geri</a>
        </div>
    </div>
</div>

<div class="container" id="filter">
    <form action="" id="form">
        <div class="row">
            <div class="col-md-2 mb19">
                <input type="text" class="form-control myInput" value="{{$r->name}}" name="name" placeholder="İsme göre ara" />
            </div>
            <div class="col-md-2 mb19">
                <select name="role_id" class="form-select">
                    <option value="">Tümü</option>
                    @foreach($roles as $role)
                    @if($r->role_id == $role->id)
                    <option value="{{$role->id}}" selected>{{$role->name}}</option>
                    @else
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 mb19">
                <a href="javascript:;" id="filterbtn" class="btn btn-sm btn-danger">
                    Filtrele
                </a>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="bb clear"></div>
        </div>
    </div>
</div>

<div class="h19"></div>

<div class="container">


    <div class="row">
        @foreach($users as $user)
        <div class="col-md-4 mb19">
            <div class="card cursor" data-id="{{$user->id}}">
                <h5 class="card-header">
                    {{$user->name}}
                    @php
                    $classname = "";
                    @endphp

                    @if(isset($user->connectRole->css) && $user->status == 1)
                    @php $classname = $user->connectRole->css; @endphp
                    @else
                    @php $classname = 'bg-warning'; @endphp
                    @endif
                    <span class="badge {{$classname}} float-end">{{$user->email}}</span>
                </h5>
                <div class="card-body">
                    <p class="card-text">

                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="bb clear"></div>
        </div>
    </div>
</div>
<div class="h19"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ $users->appends(['sort' => 'name']) }}
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-12 description">
        <span class="badge bg-warning rounded-circle myCircle">&nbsp;</span> Aktif Değil
        <span class="badge bg-danger rounded-circle myCircle ml9">&nbsp;</span> Admin
        <span class="badge bg-primary rounded-circle myCircle ml9">&nbsp;</span> Editör
    </div>
</div>
@stop


@section('script')
<script>
    $(document).ready(function() {
        $("#filter").slideToggle();
        $(".card").click(function() {
            var id = $(this).attr("data-id");
            location.href = "{{url('admin/users/edit')}}/" + id;
        });

        $("#filterbtn").click(function() {
            var serialize = $("form").serialize();
            location.href = "{{url('admin/users')}}?" + serialize;
        });
    });
</script>
@stop