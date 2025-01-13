<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <style>
        .swal2-confirm.blue-button {
            color: white;
            background-color: #3F83F8;
            border: none;

        }

        .swal2-confirm.blue-button:hover {
            transition: 1s;
            background-color: #1C64F2;

        }
    </style>
</head>

<body>
    <div id="app">
        <main class="py-0">
            @yield('content')
        </main>
    </div>

</body>
<script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    @if ($message = Session::get('success'))
        Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: '{{ $message }}',
            showConfirmButton: false,
            timer: 2000
        });
    @elseif ($message = Session::get('error'))
        Swal.fire({
            icon: "error",
            title: "Gagal",
            text: '{{ $message }}',
            customClass: {
                confirmButton: 'bg-sky-600 text-white border-sky-600' // Background, teks, dan border tombol
            }
        });
    @endif
</script>

</html>
