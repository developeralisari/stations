@if (session()->has('ldap_user'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <div id="userProfileContainer" class="myLogin animate__animated animate__slideInDown">
        @if (strpos(url()->full(), 'admin') === false)
            @php
                $mail = session()->get('ldap_user')->mail;
                $checkAdmin = App\Models\User::where('email', $mail)->count();
            @endphp

            @if ($checkAdmin > 0)
                <div class="mt-3">
                    <small>
                        <a href="{{ url('admin') }}" class="btn btn-danger link">
                            Panele Git
                        </a>
                    </small>
                </div>
            @else
            <div class="h19"></div>
            @endif
        @endif
        <div>
            <div id="imageOut">
                <div id="image"
                    style="background-image:url('https://userinfo.memorial.com.tr/{{ Session::get('ldap_user')->profile_img }}')">
                </div>
            </div>
            <div id="profileContent">
                <div>
                    <div><span>{{ Session::get('ldap_user')->name }} {{ Session::get('ldap_user')->last_name }}
                        </span></div>
                    <div><small>{{ Session::get('ldap_user')->department }}</small></div>
                </div>
                <div id="profileLogout">
                    <a href="{{ route('ldap_logout') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-power" viewBox="0 0 16 16">
                            <path d="M7.5 1v7h1V1h-1z" />
                            <path
                                d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                        </svg>
                        <small>Çıkış</small>
                    </a>
                </div>
            </div>
        </div>
        @if (isset(Session::get('ldap_user')->multi_location) && Session::get('ldap_user')->multi_location)
            <div>
                <form action="{{ route('change_location') }}" method="post" id="locationForm">
                    <select name="location" id="location" class="form-control form-control-sm">
                        @foreach ($all_location as $l)
                            <option value="{{ $l->id }}" {{ $l->id == $location->id ? ' selected ' : '' }}>
                                {{ $l->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        @endif
    </div>

    <style type="text/css">
        #userProfileContainer {
            width: fit-content;
            background: rgba(0, 0, 0, 0);
            height: fit-content;
            display: flex;
            align-items: center;
            border-radius: 60px;
            flex-direction: column;
            gap: 10px;
        }

        #userProfileContainer>div {
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #userProfileContainer>div:first-child {
            flex-direction: row;
        }

        #userProfileContainer>div div#imageOut {
            border-radius: 100%;
            width: 70px;
            height: 70px;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
        }


        #userProfileContainer>div div#imageOut>div {
            width: 90%;
            height: 90%;
            background-position: center center;
            background-repeat: no-repeat;
            background-position: center center;
            border-radius: 100%;
            background-size: cover;
        }

        #userProfileContainer>div div#profileContent {
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0 10px;
            color: #fff;
            display: flex;
        }

        #userProfileContainer>div div#profileContent>div:first-child>div {
            flex: 1;
            line-height: 17px;
        }

        #userProfileContainer>div div#profileContent span {
            font-weight: 700;
            font-size: 17px;
        }

        #userProfileContainer a {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .myLogin {
            position: absolute !important;
            right: 33px;
            top: 0px;
            z-index: 99;
        }
    </style>
@else
    <style>
        .myLogin {
            position: absolute !important;
            right: 33px;
            top: 33px;
        }
    </style>
    <h5 class="myLogin">
        @php
            $site = env('APP_ENV') == 'local' ? 'http://localhost/KR_YazilimStations/public' : 'https://stations.memorial.com.tr/';
        @endphp
        <a href="{{ url(env('AUTH_API_URL') . '/login/' . base64_encode($site)) }}">
            <span class="text-light fw-bold">
                Kullanıcı Girişi
            </span>
        </a>
    </h5>
@endif
