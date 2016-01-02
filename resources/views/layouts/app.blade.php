<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.header')
    <body class="hold-transition skin-green-light sidebar-mini" id="app-layout">
        @include('layouts.partials.nav')
        @include('layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
    </body>
</html>