<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('partials.header')
        <div class="page-body-wrapper">
            @include('partials.sidebar')
            <div class="page-body">
                <div class="container-fluid">
                    @yield('content')  <!-- Sección de contenido dinámico -->
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
    @include('partials.scripts')
</body>
</html>
