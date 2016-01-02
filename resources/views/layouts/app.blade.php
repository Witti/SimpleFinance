<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.header')
    <body id="app-layout">
        @include('layouts.partials.nav')
        @include('layouts.partials.alert')
        @yield('content')
        @include('layouts.partials.footer')
    </body>
</html>