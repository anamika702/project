<!DOCTYPE html>
<html>
<head>
    @yield('styles')
    <title>Mieszany/Mieszany</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>

        /* Styl stopki */
        footer {
            background-color: #4c594f;
            color: #fff;
            padding: 20px;
            margin-top: 20px;
            text-align: center; /* Wyśrodkowanie zawartości */
        }


        /* Usunięcie kropek z lewej strony guzików w nawigacji */
        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
            background-color: #555;
        }

        .sidebar a:hover {
            background-color: rgba(51, 51, 51, 0.32);
        }

        .logout-button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 20px;
            width: 276px;
            padding: 23px;
            width: 732px;
            font-size: 20px;
        }

        .logout-button:hover {
            background-color: darkred;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 20px;
            width: 276px;
            padding: 23px;
            width: 732px;
            font-size: 20px;
        }

        .panel_sterowania{
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #ffffff;
            padding: 14px;
            margin: 12px;
        }

        a:hover {
            color: #232625;
            transform: scale(1.2);
        }

        .card{
            background: #232625;
            border-radius: 10px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }

        .card:hover
        {
            background: #BFBFB8;
        }

        body{
            background: #BFBFB8;
        }
    </style>
</head>
<body>
<header>

</header>

<div class="container-fluid">
    <div class="row">
        @if(Auth::check())

            <div class="col-md-12">
                <div class="panel_sterowania">
                    @if(Auth::check())
                        <div class="user-info">
                            <h3>Witaj {{ Auth::user()->imie }} {{ Auth::user()->nazwisko }}</h3>
                            <h3>Wybierz element menu w celu kontynuowania</h3>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">

                            <a href="{{ route('menu.index') }}" class="card-link">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Menu</h5>
                                    </div>
                                </div>
                            </a>


                            <a href="{{ route('zamowienia.index') }}" class="card-link">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Zamówienia</h5>
                                    </div>
                                </div>
                            </a>


                            <a href="{{ route('rezerwacje.index') }}" class="card-link">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Rezerwacje</h5>
                                    </div>
                                </div>
                            </a>


                            <a href="{{ route('rachunek.wyswietl') }}" class="card-link">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Rachunki</h5>
                                    </div>
                                </div>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-button">Wyloguj się</button>
                            </form>

                        </div>
                        <div class="col-md-6">

                            <a href="{{ route('stoliki.show') }}" class="card-link">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Stoliki</h5>
                                    </div>
                                </div>
                            </a>


                            <a href="{{ route('pracownicy.index') }}" class="card-link">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pracownicy</h5>
                                    </div>
                                </div>
                            </a>


                            <a href="{{ route('grafik') }}" class="card-link">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Grafik</h5>
                                    </div>
                                </div>
                            </a>


                            <a href="{{ route('potrawy.index') }}" class="card-link">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Potrawy</h5>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('potrawy.index') }}" class="card-link">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Raport</h5>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        @endif
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
