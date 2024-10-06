@extends('layout.app')
@section('content')
<html>
<head>
    <title>Dodawanie rezerwacji</title>
</head>
<body>
<h1>Dodawanie nowej rezerwacji</h1>

<form action="{{ route('rezerwacje.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="Nazwisko">Nazwisko:</label>
        <input type="text" name="Nazwisko" id="Nazwisko" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="Numer_tel">Numer telefonu:</label>
        <input type="text" name="Numer_tel" id="Numer_tel" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="ID_stolika">Numer stolika, stan stolika, ilość miejsc</label>
        <select name="ID_stolika" id="ID_stolika" class="form-control">
            @foreach($stoliki as $stolik)
                <option value="{{ $stolik->ID_stolika }}">{{$stolik->ID_stolika}} , {{$stolik->Status_stolika}} , {{$stolik->Ilosc_miejsc}} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="Data_rezerwacji">Data rezerwacji:</label>
        <input type="date" name="Data_rezerwacji" id="Data_rezerwacji" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="Godzina_rezerwacji">Godzina rezerwacji:</label>
        <input type="time" name="Godzina_rezerwacji" id="Godzina_rezerwacji" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="Liczba_osob">Liczba osób:</label>
        <input type="number" name="Liczba_osob" id="Liczba_osob" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="Status_rezerwacji">Status rezerwacji:</label>
        <select name="Status_rezerwacji" id="Status_rezerwacji" class="form-control" required>
            <option value="Potwierdzona">Potwierdzona</option>
            <option value="Oczekująca">Anulowana</option>
            <option value="Anulowana">Zakończona</option>
        </select>
    </div>

    <div class="form-group">
        <label for="Inne_informacje">Inne informacje:</label>
        <textarea name="Inne_informacje" id="Inne_informacje" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Dodaj rezerwację</button>
</form>

<a href="{{ route('rezerwacje.index') }}" class="btn btn-secondary">Powrót do listy rezerwacji</a>
</body>
</html>
@endsection
