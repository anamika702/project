@extends('layout.app')
@section('content')
<html>
<head>
    <title>Edytowanie rezerwacji</title>
</head>
<body>
<h1>Edytowanie rezerwacji</h1>

<form action="{{ route('rezerwacje.update', ['id' => $rezerwacja->ID_rezerwacji]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="Nazwisko">Nazwisko:</label>
        <input type="text" name="Nazwisko" id="Nazwisko" class="form-control" value="{{ $rezerwacja->Nazwisko }}" required>
    </div>

    <div class="form-group">
        <label for="Numer_tel">Numer telefonu:</label>
        <input type="text" name="Numer_tel" id="Numer_tel" class="form-control" value="{{ $rezerwacja->Numer_tel }}" required>
    </div>

    <div class="form-group">
        <label for="ID_stolika">Numer stolika, stan stolika, ilość miejsc:</label>
        <select name="ID_stolika" id="ID_stolika" class="form-control">
            @foreach($stoliki as $stolik)
                <option value="{{ $stolik->ID_stolika }}">{{$stolik->ID_stolika}} , {{$stolik->Status_stolika}} , {{$stolik->Ilosc_miejsc}} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="Data_rezerwacji">Data rezerwacji:</label>
        <input type="date" name="Data_rezerwacji" id="Data_rezerwacji" class="form-control" value="{{ $rezerwacja->Data_rezerwacji }}" required>
    </div>

    <div class="form-group">
        <label for="Godzina_rezerwacji">Godzina rezerwacji:</label>
        <input type="time" name="Godzina_rezerwacji" id="Godzina_rezerwacji" class="form-control" value="{{ $rezerwacja->Godzina_rezerwacji }}" required>
    </div>

    <div class="form-group">
        <label for="Liczba_osob">Liczba osób:</label>
        <input type="number" name="Liczba_osob" id="Liczba_osob" class="form-control" value="{{ $rezerwacja->Liczba_osob }}" required>
    </div>

    <div class="form-group">
        <label for="Status_rezerwacji">Status rezerwacji:</label>
        <select name="Status_rezerwacji" id="Status_rezerwacji" class="form-control" required>
            <option value="Potwierdzona" @if($rezerwacja->Status_rezerwacji == 'Potwierdzona') selected @endif>Potwierdzona</option>
            <option value="Anulowana" @if($rezerwacja->Status_rezerwacji == 'Anulowana') selected @endif>Anulowana</option>
            <option value="Zakończona" @if($rezerwacja->Status_rezerwacji == 'Zakończona') selected @endif>Zakończona</option>
        </select>
    </div>

    <div class="form-group">
        <label for="Inne_informacje">Inne informacje:</label>
        <textarea name="Inne_informacje" id="Inne_informacje" class="form-control">{{ $rezerwacja->Inne_informacje }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
</form>

<a href="{{ route('rezerwacje.index') }}" class="btn btn-secondary">Powrót do listy rezerwacji</a>
</body>
</html>
@endsection
