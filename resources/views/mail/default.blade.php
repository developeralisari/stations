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

    td {
        vertical-align: middle;
    }
</style>

<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;cellpadding:9">
    <tr>
        <td style="padding:19px">

            <div class="box">

                <p style="font-family:Arial, Helvetica, sans-serif;font-size:19px;color:#c11e43;font-weight:bold">
                    SERVİS BİLGİSİ
                </p>

                <table cellpadding="13" cellspacing="0">
                    <thead>
                        <th style="font-family:Arial, Helvetica, sans-serif;background:#333;color:white" align="center">
                            LOKASYON
                        </th>
                        <th style="font-family:Arial, Helvetica, sans-serif;background:#333;color:white" align="center">
                            SÜRÜCÜ
                        </th>
                        <th style="font-family:Arial, Helvetica, sans-serif;background:#333;color:white" align="center">
                            PLAKA
                        </th>
                        <th style="font-family:Arial, Helvetica, sans-serif;background:#333;color:white" align="center">
                            TELEFON
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="left" style="border-bottom:1px solid #ddd">
                                {{$details['locationName']}}
                            </td>
                            <td align="left" style="border-bottom:1px solid #ddd">
                                {{$details['driverName']}}
                            </td>
                            <td align="left" style="border-bottom:1px solid #ddd">
                                {{$details['plate']}}
                            </td>
                            <td align="left" style="border-bottom:1px solid #ddd">
                                {{$details['phone']}}
                            </td>
                        </tr>

    </tr>

    </tbody>
</table>
</div>
</td>
</tr>
</table>