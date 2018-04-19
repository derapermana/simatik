@extends('default')

@section('css')

@endsection

@section('content')
<h3 class="text-center">Selamat Datang, Admin <strong>{{ Auth::user()->institution->name }}</strong></h3>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">

            </div>
            <div class="details">
                <div class="number">
                    {{ count($servers) }}
                </div>
                <div class="desc">
                    Server
                </div>
            </div>
            <a class="more" href="{{ route('servers') }}">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual">

            </div>
            <div class="details">
                <div class="number">
                    {{ count($applications) }}
                </div>
                <div class="desc">
                    Aplikasi
                </div>
            </div>
            <a class="more" href="{{ route('applications') }}">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
            <div class="visual">

            </div>
            <div class="details">
                <div class="number">
                    {{ count($people) }}
                </div>
                <div class="desc">
                    Pengelola TIK
                </div>
            </div>
            @can('person.b')
            <a class="more" href="{{ route('persons') }}">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
            @endcan
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
            <div class="visual">

            </div>
            <div class="details">
                <div class="number">
                    {{ count($licenses) }}
                </div>
                <div class="desc">
                    Lisensi
                </div>
            </div>
            @can('license.b')
            <a class="more" href="{{ route('licenses') }}">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
            @endcan
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
    $(document).ready(function(){

    });
    </script>
@endsection
