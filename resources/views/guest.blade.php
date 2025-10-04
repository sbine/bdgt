<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    <div class="flex flex-col min-h-screen">
        <div id="app" class="grow bg-gray-100">
            @include('partials.nav')

            <div class="w-11/12 lg:w-1/2 mx-auto mt-8">
                @yield('top-content')

                @yield('content')
            </div>
        </div>

        @include('partials.footer')
    </div>

    @include('partials.scripts')
</body>
</html>
