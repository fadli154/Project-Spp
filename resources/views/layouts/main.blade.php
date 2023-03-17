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

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show me-4 ms-4" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show me-4 ms-4" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- end alert --}}
                @yield('content')
            </div>

            @include('partials.footer')
        </div>
    </div>

    @include('partials.script')
</body>

</html>
