@extends('layout.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1>Lista stolików:</h1>
            <ul class="list-group">
                @foreach ($stoliki as $stolik)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="font-weight-bold">Numer stolika:</span> {{ $stolik->Numer_stolika }},
                            <span class="font-weight-bold">Ilość miejsc:</span> {{ $stolik->Ilosc_miejsc }},
                            <span class="font-weight-bold">Status:</span> {{ $stolik->Status_stolika }}
                            <span class="font-weight-bold">Status rezerwacji:</span>
                            @if($stolik->Status_rezerwacji === 'Zarezerwowany')
                                <a href="{{ route('rezerwacje.index', ['ID_stolika' => $stolik->ID_stolika]) }}">{{ $stolik->Status_rezerwacji }}</a>
                            @else
                                {{ $stolik->Status_rezerwacji }}
                            @endif
                        </div>
                        <div>
                            <form action="{{ route('usun_stolik.destroy', ['id' => $stolik->ID_stolika]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-usun">Usuń</button>
                            </form>
                            <a href="{{ route('edytuj_stolik', ['id' => $stolik->ID_stolika]) }}" class="btn-edytuj">Edytuj</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="py-5 text-center">
        Dodawanie Stolików
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="/dodaj_stolik" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="numer_stolika">Numer stolika:</label>
                        <input type="number" class="form-control" id="numer_stolika" name="numer_stolika" required>
                        <div class="invalid-feedback">
                            Wymagany jest prawidłowy numer stolika.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ilosc_miejsc">Ilość miejsc:</label>
                        <input type="number" class="form-control" id="ilosc_miejsc" name="ilosc_miejsc" required>
                        <div class="invalid-feedback">
                            Wymagana jest prawidłowa ilość miejsc.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status_stolika">Status stolika:</label>
                        <select class="form-control" id="status_stolika" name="status_stolika">
                            <option value="wolny" selected>Wolny</option>
                            <option value="zajęty">Zajęty</option>
                            <option value="do_czyszczenia">do czyszczenia</option>
                        </select>
                        <div class="invalid-feedback">
                            Wymagany jest status stolika.
                        </div>
                    </div>
                </div>

                <button class="btn-dodaj" type="submit">Dodaj stolik</button>
            </form>
        </div>
    </div>

</div>



<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
@endsection
