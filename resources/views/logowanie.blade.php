 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Logowanie</title>


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: #808080;
        }
        .container {
            text-align: center;
            width: 30%;
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            margin-top: 100px;

        }
        .title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 30%;
            padding: 10px;
            border: 3px solid #e2e8f0;
            border-radius: 4px;
            font-size: 16px;
        }
        .checkbox-group {
            align-items: center;
            margin-bottom: 20px;
        }
        .checkbox-group label {
            margin-bottom: 0;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 8px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4c51bf;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #434190;
        }
        .logout-btn {
            background-color: #e53e3e;
            margin-top: 20px;
        }
        .logout-btn:hover {
            background-color: #c53030;
        }
    </style>

</head>
<body >
<div class="container">


    @if(Auth::check())
        <div >
            <p>{{ Auth::user()->stanowisko }}: {{ Auth::user()->imie }} {{ Auth::user()->nazwisko }}</p>
        </div>
    @endif

    <div >
        <!-- Kod formularza logowania -->
        <h2 class="title">Logowanie</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="form-group">
                <label for="email" >E-mail</label>
                <input type="email" name="email" id="email" >
            </div>

            <div class="form-group">
                <label for="password" >Hasło</label>
                <input type="password" name="password" id="password" >
            </div>

            <div class="checkbox-group">
                <input type="checkbox" name="remember" id="remember" >
                <label for="remember" >Zapamiętaj mnie</label>
            </div>

            <button type="submit" class="btn" >Zaloguj się</button>

        </form>

    </div>
    <br>
</div>
</body>
</html>
