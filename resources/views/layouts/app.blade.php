<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('form') }}">Додати</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users') }}">Користувачі</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>


<script>
    $("#regForm").validate({
            rules: {
                name: {
                   required: true,
                    maxlength: 50
                },
                surname: {
                    required: true,
                    maxlength: 50
                },
                email: {
                     required: true,
                    maxlength: 50,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },

            },
            messages: {
                name: {
                    required: "Поле Ім'я є обов'язковим",
                    minlength: "Ім'я повинно містити принаймні {0} символів",
                    maxlength: "Ім'я не повинно перевищувати {0} символів"
                },
                surname: {
                    required: "Поле Прізвище є обов'язковим",
                    minlength: "Прізвище повинно містити принаймні {0} символів",
                    maxlength: "Прізвище не повинно перевищувати {0} символів"
                },
                email: {
                    required: "Поле Email є обов'язковим",
                    email: "Введіть коректний Email з @"
                },
                password: {
                    required: "Поле Пароль є обов'язковим",
                    minlength: "Пароль повинен містити принаймні {0} символів"
                },
                confirm_password: {
                    required: "Поле Підтвердіть пароль є обов'язковим",
                    equalTo: "Паролі не співпадають"
                }
            }
        }
    );
        $(document).ready(function () {
                $('#regForm').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        method: "POST",
                        datatype: "json",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            name: $('#name').val(),
                            surname: $('#surname').val(),
                            email: $('#email').val(),
                            password: $('#password').val(),
                            confirm_password: $('#confirm_password').val()
                        },
                        url: "{{ route('form') }}",

                        success: function(response) {
                            console.log(response);
                            if (response.status === 'success') {
                               alert(response.msg);
                                $('#regForm')[0].reset();
                            } if(response.status === 'error') {
                                alert(response.msg);
                            }if (response.redirect) {
                                // Выполняем перенаправление
                                window.location.href = response.redirect;
                            }
                        },
                        error: function (xhr, status, error) {
                            alert("Виконайте умови");
                        }
                    })
                })
            }
        )

</script>
</body>
</html>
