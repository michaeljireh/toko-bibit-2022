<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <!--Responsive Extension Datatables CSS-->
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        function switchTheme(theme) {
            localStorage.theme = theme;
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else document.documentElement.classList.remove('dark')
        }

    </script>
</head>

<body class="font-sans antialiased bg-gray-200 dark:bg-gray-900" x-data="{ flashMessage : true, cartOpen: false, qty: 1 }" x-init="() => {switchTheme(localStorage.getItem('theme'))}">
    @include('layouts.guest.header')
    @if (Auth::check())
    @include('layouts.guest.cart')
    @endif

    <main class="my-8">
        {{ $slot }}
    </main>

    @include('layouts.guest.footer')

    <script>
        function addDots(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }
        function cartApi(method,url,callback) {
            fetch(url,{method:method}).then(async (result) => {
              if (result.status == 200) return await result.text()
            }).then(async (result) => {
              $('#cart-list').html(result);
            }).catch((err) => console.log(err));
            if (typeof callback == 'function') return callback();
            return;
        }
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>
