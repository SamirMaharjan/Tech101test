@include('frontend.layouts.head')
@include('frontend.layouts.header')
<div class="container mt-5">
    @yield('content')
</div>


@yield('scripts')
@include('frontend.layouts.footer')
