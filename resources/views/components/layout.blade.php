<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APP LAUNDRY</title>
    <link rel="stylesheet" href="{{ asset('tw_elements/tw-elements.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

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

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <x-sidebar></x-sidebar>
        <main class="flex-1 overflow-y-auto">
            <x-header></x-header>
            <p>{{ $slot }}</p>
        </main>
    </div>

</body>
<script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('tw_elements/tw-elements.umd.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>


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
                confirmButton: 'bg-sky-600 text-white border-sky-600'
            }
        });
    @elseif ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Data tidak valid',
            html: '{!! implode('<br>', $errors->all()) !!}',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'bg-red-600 text-white'
            }
        });
    @elseif (session('login_message'))
        Swal.fire({
            title: 'Selamat Datang {{ session('login_message')['name'] }}!',
            text: 'Role: {{ session('login_message')['role'] }}',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'bg-sky-600 text-white border-sky-600'
            }
        });
    @endif
</script>


</html>
