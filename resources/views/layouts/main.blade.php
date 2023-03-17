<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('partials.navbar')
            @include('partials.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                {{-- alert --}}
                @include('sweetalert::alert')
                {{-- end alert --}}
                @yield('content')
            </div>

            @include('partials.footer')
        </div>
    </div>

    @include('partials.script')
</body>

</html>
