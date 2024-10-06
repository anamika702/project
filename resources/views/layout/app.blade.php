<!DOCTYPE html>
<html>
<head>
    @yield('styles')
    <title>Mieszany/Mieszany</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        h1 {
            text-align: center;
        }


        /* Styl panelu bocznego  */
        .panel_boczny {
            position: fixed;
            top: 0;
            left: 0;
            background-color: #4c594f;
            color: #fff;
            padding: 20px;
            height: 100vh;
            width: 300px;
        }

        .logo {
            margin-left: -20px;
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
            margin-top: 0px;
            margin-left: 20px;
            overflow-x: auto;
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
            position: absolute;
            bottom: 0;
            width: 100%;
            margin-left: -38px;

        }

        .zdjecie_pracownika {
            width: 115%;
            border-radius: 80px;/
        }

        .informacje_pracownika {
            color: #fff;
            margin-top: 10px;
        }

        .btn-edytuj,
        .btn-usun,
        .btn-dodaj {
            padding: 8px 18px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            display: inline-block;
            text-decoration: none;
        }

        .btn-edytuj:hover,
        .btn-usun:hover,
        .btn-dodaj:hover {
            transform: scale(1.1);
        }


        .btn-anuluj {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            display: inline-block;
            text-decoration: none;
            background-color: gray;
            color: white;
        }

        .btn-anuluj:hover {
            transform: scale(1.1);
        }


        .btn-edytuj {
            background-color: blue;
            color: white;
        }

        .btn-usun {
            background-color: red;
            color: white;
        }

        .btn-dodaj {
            background-color: green;
            color: white;
        }

        .btn-odstep {
            margin-left: 10px;
        }

        #zawartosc_strony {
            margin-left: auto; /* Szerokość panelu bocznego + 20px margines */
        }

        .menu-tabela {
            margin-bottom: 0px;
            margin-left: 20px;
            text-align: left;
        }

        ul.pasek_boczny
        {
            margin-top: -38px;
        }

    </style>

</head>
<body>
<header>

</header>

<div class="container-fluid">
    <div class="row">
        @if(Auth::check())
            <div class="col-md-2">
                <div class="panel_boczny">
                    <div class="container-fluid">
                        <div class="row">
                        </div>
                        @if(Auth::check())
                            @if(Auth::user()->stanowisko == 'Menadżer')
                                <div id="sidebar" class="panel_boczny">
                                    <div class="nawigacja_boczna">
                                        <ul class="pasek_boczny">
                                            <li><a href="{{ route('menu.index') }}">Menu</a></li>
                                            <li><a href="{{ route('zamowienia.index') }}">Zamówienia</a></li>
                                            <li><a href="{{ route('rezerwacje.index') }}">Rezerwacje</a></li>
                                            <li><a href="{{ route('stoliki.show') }}">Stoliki</a></li>
                                            <li><a href="{{ route('pracownicy.index') }}">Pracownicy</a></li>
                                            <li><a href="{{ route('grafik') }}">Grafik</a></li>
                                            <li><a href="{{ route('potrawy.index') }}">Potrawy</a></li>
                                            <li><a href="{{ route('rachunek.wyswietl') }}">Rachunek</a></li>
                                            <li><a href="{{ route('potrawy.index') }}">Raport</a></li>
                                            <li><a href="{{ route('strona_glowna') }}">Strona główna</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="logout-button">Wyloguj się</button>
                                </form>
                            @elseif(Auth::user()->stanowisko == 'Kelner')
                                <div id="sidebar" class="panel_boczny">
                                    <div class="nawigacja_boczna">
                                        <ul>
                                            <li><a href="{{ route('menu.index') }}">Menu</a></li>
                                            <li><a href="{{ route('zamowienia.index') }}">Zamówienia</a></li>
                                            <li><a href="{{ route('rezerwacje.index') }}">Rezerwacje</a></li>
                                            <li><a href="{{ route('rachunek.wyswietl') }}">Rachunek</a></li>
                                            <li><a href="{{ route('rezerwacje.index') }}">Raport</a></li>
                                        </ul>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="logout-button">Wyloguj się</button>
                                    </form>
                                </div>
                            @elseif(Auth::user()->stanowisko == 'Kucharz')
                                <div id="sidebar" class="panel_boczny">
                                    <div class="nawigacja_boczna">
                                        <ul>
                                            <li><a href="{{ route('menu.index') }}">Menu</a></li>
                                            <li><a href="{{ route('potrawy.index') }}">Potrawy</a></li>
                                            <li><a href="{{ route('rezerwacje.index') }}">Raport</a></li>
                                            <li><a href="{{ route('kuchnia') }}">Panel Kuchni</a></li>
                                        </ul>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="logout-button">Wyloguj się</button>
                                    </form>
                                </div>
                            @endif

                            <div class="sekcja_pracownika">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img class="zdjecie_pracownika" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw0QBhMQDRAPEBIQDxAQEBAQEA8QGBIQFR0WFhgSFhMYHSggGBolGxMVIjEhJSk3Li4uGB8zODosNygtLisBCgoKDg0OGhAQGi0dHR0vLSsrLSsrLS0rLS0tKystLS0rLSstLS0tLS0tLSstLS0rNy0rKzcrNystLi0rKysrK//AABEIAOEA4QMBIgACEQEDEQH/xAAbAAEAAwEBAQEAAAAAAAAAAAAABAUGAQMCB//EADgQAQACAAMECAQEBAcAAAAAAAABAgMEEQUhMVESIkFhcZGxwWKBgqEyNNHwJHLC4RMUFSMzUlP/xAAYAQEBAQEBAAAAAAAAAAAAAAAAAgMBBP/EAB0RAQEBAAMBAQEBAAAAAAAAAAABAgMRMUFREiH/2gAMAwEAAhEDEQA/AP0QB6WQAAAAAAAAAADgOjtKWtPViZ8ImUmuzseY/BPzmse7ncdRRLxNm4tcObT0dIjWesiEvYAOuAAAAAAAAAAAAAAAAAAAERMzpG+Z4RAD1wMve89Ssz39nmsslsqNOli7/g/Va1rEV0iIiI7IZ3f4qZVOBsb/ANLfKv6ym4Wz8GvCkT3263qlDO6tV1HIrERuiI8HQcdUO18e85maTurGmkcNe/vQGozGXpeml419vCVFnsjbCnXjXsty7pa41PEWIgDRIAAAAAAAAAAAAAAAAAAvNl5HoU6do608Phjl4q3ZmD083GvCvWn5cPvo0bLd+LzABmoAAAActWJrpMaxPGJdAZ/aWR/w761/BM+U8kJqsXDi2HNbb4mNJZjGw5rizWeNZmP7tsa7RY+AFpAAAAAAAAAAAAAAAAWewv8Ant/LHqulNsGP92/hHuuWG/WmfABLoAAAAAAzu1Y/j7fT6Q0TPbX/AD9vCvpC+P1OkMBsgAAAAAAAAAAAAAAABa7Bjr38K+64U+wON/p/qXDDfrSeACXQAAAAABntr/n7eFfSGhZ7a/5+3hX0hfH6nSGA2QAAAAAAAAAAAAAAA4C22Bxv9P8AUuHzh6dCNOUPp57e60gA46AAAAAAM9tf8/bwr6Q0Kv2xh0/yk20jpa10nTf5+CsXquXxRAN2YAAAAAAAAAAAAAA46A1GVtrlqz8FfR6oWyMXpZOI7a9Wfb7Jrz31rABwAAAAAAFdty38JEc7x6SsVPt3E61a8tbT890e6s+uXxVAN2YAAAAAAAAAAAAAAACXsrGmuciNd1urPt92iZOltLxPKYnyausxMax2suSf6vLoDNQAAAAAD5vaIpMzwiJmfky+Ni2viTa3Gf3ovdrYvRyU87aVj58ftqz7Xjn1GgBokAAAAAAAAAAAAAAAAX2yMxFsv0Z403fT2SoX3gY1qYsWrxj7xylOp3HZemqHzSdaRPOIl9MGgAAAADwzuJNcra0cYjd4gqds4/Sx4rHCnH+aVeTxHok6jO0AdcAAAAAAAAAAAAAAAACsa2iOc6D1yldc1SPjr6uUaiAHnagAAACLtOf4C/h7wlIm1PyF/l6w7PSs6OOvQyAAAAAAAAAAAAAAAAAAcanLYEUwYrERujfPOe2Wf2fgdPNRHZHWnwhpWXJfi8gDNQAAAAACi21gxXMRaN3Sjf4x2+ivX22MDpZbpRxpv+Xb++5QtsXuI16ALSAAAAAAAAAAAAD0wcC97aUrM/vmsstsftxZ+mvvKbqR2RVVrM20iJmeUb07L7KxLb7aUjv3z5LnBwKUrpSsR4e8vVF5L8VMo2UyVMKJ6OszPGZSQZqAAAAAAAActWJrpPCY0nwVeY2PHHDtp3W3x5rUdls8c6ZjHymJT8VZ05xvjzeDXIeY2bhX7OjPOu77LnJ+uXLPCdmNlYtd9evHdunyQZiYnSd3i0llT0AOuAAAAA9MDAve+lI1n08ZW+V2TSu/E608uyP1TdSOydqrL5XExJ6ld3Od0ea1y2yaRvxJ6U8uEf3WMRERu3Os7u1cy5WsRXSIiIjsjc6CHQAAAAAAAAAAAAAAAB44+Ww7x16xPf2+b2AU2Z2PMb8OdfhndPmrcTDtW2lomJ5TDVvjFwq2rpaImO9c3fqbllRa5rZHbhT9M+0qu9JrbS0TEx2S1mpU2dOAOuNTg4NaYfRrGkPQHmagAAAAAAAAAAAAAAAAAAAAAAACLnsnXEw+Vo/DPtPclB2M3/p2P/0+8DSC/wC6n+QBCgAAAAAAAAAAAAAAAAAAAAAAAAAAAH//2Q==">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="informacje_pracownika">
                                            <p>{{ Auth::user()->imie }} {{ Auth::user()->nazwisko }}</p>
                                            <p>{{ Auth::user()->stanowisko }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-auto">
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                @yield('content')
            </div>

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
@endif
@endif
