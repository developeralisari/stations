<style>
    .loading {
        margin: 0;
        position: fixed;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .wrapper {
        height: 100vh;
        z-index:9999;
        background: #000000;
        width:100%;
        position: fixed;
        opacity: 1;
        display:block;
        top: 0;
    }
</style>
<div class="wrapper" id="loading">
    <div class="loading text-center">
        <p><img src="{{url('main.gif')}}" alt=""></p>
    </div>
</div>