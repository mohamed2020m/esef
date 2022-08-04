@extends('layouts.app')

@section('guest')
    @if(\Request::is('login/forgot-password'))
        <div class="container z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    @include('layouts.navbars.guest.nav')
                </div>
            </div>
        </div>
        @yield('content')
    @else
        <div class="mb-3">
            @include('layouts.navbars.guest.nav')
        </div>
        <div class="my-3">
            @yield('content')
        </div>
        @include('layouts.footers.guest.footer')
    @endif
@endsection
