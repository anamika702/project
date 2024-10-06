@extends('layout.app')

@section('content')
    <div class="container" style="max-width: 30%">
        <h2>Dodaj wpis do grafiku</h2>

        <form action="{{ route('grafik.store') }}" method="POST">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="id_pracownika">Pracownik:</label>
                <select name="id_pracownika" id="id_pracownika" class="form-control">
                    <option value=""> </option>
                    @foreach($pracownicy as $pracownik)
                        <option value="{{ $pracownik->id }}">{{ $pracownik->stanowisko }} - {{ $pracownik->imie }} {{ $pracownik->nazwisko }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_stolika1">Przypisz stoliki:</label>
                <select name="id_stolika1" id="id_stolika1" class="form-control">
                    <option value="">Brak</option>
                    @foreach($stoliki as $stolik)
                        <option value="{{ $stolik->ID_stolika }}">{{ $stolik->ID_stolika }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_stolika2"> </label>
                <select name="id_stolika2" id="id_stolika2" class="form-control">
                    <option value="">Brak</option>
                    @foreach($stoliki as $stolik)
                        <option value="{{ $stolik->ID_stolika }}">{{ $stolik->ID_stolika }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_stolika3"> </label>
                <select name="id_stolika3" id="id_stolika3" class="form-control">
                    <option value="">Brak</option>
                    @foreach($stoliki as $stolik)
                        <option value="{{ $stolik->ID_stolika }}">{{ $stolik->ID_stolika }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" name="data" id="data" class="form-control">
            </div>
            <div class="form-group">
                <label for="nr_zmiany">Numer zmiany:</label>
                <select name="nr_zmiany" id="nr_zmiany" class="form-control">
                    <option value="1">Zmiana 1</option>
                    <option value="2">Zmiana 2</option>
                </select>
            </div>
            <button type="submit" class="btn-dodaj">Dodaj</button>
            <a href="{{ route('grafik') }}" class="btn-anuluj">Anuluj</a>
        </form>
    </div>
@endsection
