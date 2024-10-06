<!DOCTYPE html>
<html>
<head>
    @yield('styles')
    <title>Mieszany/Mieszany</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .panel_boczny {
        position: fixed;
        top: 0;
        left: 0;
        background-color: #4c594f;
        color: #fff;
        padding: 20px;
        height: 100vh;
        width: 300px;
        transition: transform 0.3s ease-in-out;
        transform: translateX(-100%);
        }
        .panel_boczny.open {
        transform: translateX(0);
        }

        /* Styl stopki */
        footer {
            background-color: #333;
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
            background-color: #232625;
        }

        .sidebar a:hover {
            background-color: rgb(191, 191, 184);
        }

        .logout-button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 205px;
            border-radius: 5px;
            margin-left: 13px;

        }


        .logout-button:hover {
            background-color: darkred;
        }

        a {
            text-decoration: none;
            color: black   ;
            padding: 14px;
            margin: 12px;
        }

        a:hover {
            color: white;
            transform: scale(1.2);
        }

        #back-to-top {
            position: fixed;
            bottom: 133px;
            left: 20px;
            display: none;
            background-color: #bfbfb8;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        #back-to-top:hover {
            background-color: rgba(51, 51, 51, 0.32);
        }

        .nawigacja_boczna {
            margin-top: 30px;
        }

        .nawigacja_boczna ul {
            list-style-type: none;
            padding-left: 0;
        }

        .nawigacja_boczna li {
            margin-bottom: 10px;
        }

        .nawigacja_boczna a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
            background-color: #232625;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nawigacja_boczna a:hover {
            background-color: rgba(51, 51, 51, 0.32);
            color: #fff;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 25px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .sekcja_pracownika {
            background-color: #232625;
            padding: 10px;
            border-radius: 5px;
            margin-top: 50px;
        }

        .zdjecie_pracownika {
            width: 115%;
            border-radius: 80px;/
        }

        .informacje_pracownika {
            color: #fff;
            margin-top: 10px;
        }

        #menuToggle
        {
            margin-top: -203px;
        }

    </style>
</head>
<body>
<header>
    <button  class="btn btn-info" id="menuToggle" style="position: fixed; z-index: 1000;">☰</button>
</header>
<div class="container-fluid">
    <div class="row">
        @if(Auth::check())
            <div class="col-md-3">
                <div id="sidebar" class="panel_boczny">
                    <div class="nawigacja_boczna">
                        <ul>
                            <li><a href="{{ route('menu.index') }}">Menu</a></li>
                            <li><a href="{{ route('zamowienia.index') }}">Zamówienia</a></li>
                            <li><a href="{{ route('rezerwacje.index') }}">Rezerwacje</a></li>
                        </ul>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-button">Wyloguj się</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        @endif
    </div>
</div>
<a href="#" id="back-to-top">Powrót na góre</a>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    window.addEventListener('scroll', function() {
        var backToTopButton = document.getElementById('back-to-top');
        if (window.pageYOffset > 500) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });

    // Dodano obsługę przycisku menu
    document.getElementById('menuToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('open');
    });
</script>
</body>
</html>
