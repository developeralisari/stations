<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/admin')}}" style="color:white;font-size: 27px;">
            MSG Stations
        </a>

        <span class="navbar-text">
            @include("profile")
        </span>
        @if(Auth::check() && 1>2)
        @if(url()->current() !== url('/'))
        <span class="navbar-text">
            <a href="{{url('/admin')}}" class="white" style="margin-right:13px">
                <span style="font-size:13px">
                    <i class="fas fa-home"></i>
                    Anasayfa
                </span>
            </a>

            <a href="{{url('logout')}}" class="white over" style="font-size:13px">
                {{Auth::user()->name}}
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </span>
        @endif
        @endif
    </div>
</nav>