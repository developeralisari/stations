<style>
    a {
        color: #30419b !important;
        text-decoration: none;
    }

    .subtext a {
        color: #777;
    }

    .box {
        padding: 19px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        width: 333px;
        position: relative;
        margin: 0 auto;
    }

    .btn {
        background: #30419b !important;
    }

    .subtext {
        font-size: 11px;
        color: #777;
    }

    .fw-bold {
        font-weight: bold;
    }

    .box-dark {
        padding: 19px;
        background: #30419b !important;
        color: white;
        padding: 9px;
        border-radius: 9px;
    }
</style>

<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;cellpadding:9">
    <tr>
        <td style="padding:19px">

            <div class="box">

				<p style="font-family:Arial, Helvetica, sans-serif;font-size:19px;color:#c11e43;font-weight:bold">MSG Stations</p>

                <p>
                    Merhaba <span class="fw-bold">{{$details['fullname']}}</span> , MSG Stations uygulamasına hoşgeldiniz.
                </p>

                <p>
                    <span class="fw-bold">Kullanıcı Adınız : </span> {{$details['email']}}
                </p>

                <p>
                 <span class="fw-bold">Şifreniz : </span> {{$details['password']}}
                </p>

                <p>
                    <span class="fw-bold">Login URL : </span> {{url('admin')}} 
                </p>

                <p class="subtext">
                    Sisteme giriş yapamıyorsanız, yazilim.gelistirme@memorial.com.tr 'e mail atarak bizimle iletişime geçebilirsiniz.
                </p>
            </div>
        </td>
    </tr>
</table>