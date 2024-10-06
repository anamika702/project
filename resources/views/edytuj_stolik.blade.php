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



</head>
<body class="">
<div id="zawartosc_strony">
    <form method="POST" action="{{ route('aktualizuj_stolik', ['id' => $stolik->ID_stolika]) }}" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="numer_stolika">Numer stolika:</label>
                <input type="number" class="form-control" id="numer_stolika" name="numer_stolika" value="{{ $stolik->Numer_stolika }}" required>
                <div class="invalid-feedback">
                    Wymagany jest prawidłowy numer stolika.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ilosc_miejsc">Ilość miejsc:</label>
                <input type="number" class="form-control" id="ilosc_miejsc" name="ilosc_miejsc" value="{{ $stolik->Ilosc_miejsc }}" required>
                <div class="invalid-feedback">
                    Wymagana jest prawidłowa ilość miejsc.
                </div>
            </div>
        </div>

     -   <div class="row">
            <div class="col-md-6 mb-3">
                <label for="status_stolika">Status stolika:</label>
                <select class="form-control" id="status_stolika" name="status_stolika">
                    <option value="wolny" {{ $stolik->Status_stolika == 'wolny' ? 'selected' : '' }}>Wolny</option>
                    <option value="zajęty" {{ $stolik->Status_stolika == 'zajęty' ? 'selected' : '' }}>Zajęty</option>
                    <option value="do_czyszczenia" {{ $stolik->Status_stolika == 'do_czyszczenia' ? 'selected' : '' }}>do czyszczenia</option>
                </select>
                <div class="invalid-feedback">
                    Wymagany jest status stolika.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="invalid-feedback">
                    Wymagany jest status rezerwacji.
                </div>

            </div>
        </div>

        <button class="btn btn-dodaj" type="submit">Aktualizuj stolik</button>
        <a href="{{ route('stoliki.show') }}" class="btn btn-anuluj">Anuluj</a>

    </form>

</div>
</body>
</html>
@endsection
