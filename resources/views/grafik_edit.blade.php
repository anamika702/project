@extends('layout.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Edytuj wpis w grafiku</h1>

        <form action="{{ route('grafik.update', $grafik->id_grafika) }}" method="POST">
            @csrf
            @method('PUT')
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="id_pracownika" class="form-label">Pracownik:</label>
                <select name="id_pracownika" id="id_pracownika" class="form-control">
                    @foreach($pracownicy as $pracownik)
                        <option value="{{ $pracownik->id }}" {{ $pracownik->id == $grafik->id_pracownika ? 'selected' : '' }}>
                            {{ $pracownik->stanowisko }} - {{ $pracownik->imie }} {{ $pracownik->nazwisko }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_stolika1">Przypisz stoliki:</label>
                <select name="id_stolika1" id="id_stolika1" class="form-control">
                    <option value="">Brak</option>
                    @foreach($stoliki as $stolik)
                        <option value="{{ $stolik->ID_stolika }}" {{ $stolik->ID_stolika == $grafik->id_stolika1 ? 'selected' : '' }}>
                            {{ $stolik->ID_stolika }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_stolika2"> </label>
                <select name="id_stolika2" id="id_stolika2" class="form-control">
                    <option value="">Brak</option>
                    @foreach($stoliki as $stolik)
                        <option value="{{ $stolik->ID_stolika }}" {{ $stolik->ID_stolika == $grafik->id_stolika2 ? 'selected' : '' }}>
                            {{ $stolik->ID_stolika }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_stolika3"> </label>
                <select name="id_stolika3" id="id_stolika3" class="form-control">
                    <option value="">Brak</option>
                    @foreach($stoliki as $stolik)
                        <option value="{{ $stolik->ID_stolika }}" {{ $stolik->ID_stolika == $grafik->id_stolika3 ? 'selected' : '' }}>
                            {{ $stolik->ID_stolika }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="data" class="form-label">Data:</label>
                <input type="date" name="data" id="data" class="form-control" value="{{ $grafik->data }}">
            </div>

            <div class="mb-3">
                <label for="nr_zmiany" class="form-label">Numer zmiany:</label>
                <select name="nr_zmiany" id="nr_zmiany" class="form-control">
                    <option value="1" {{ $grafik->nr_zmiany == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ $grafik->nr_zmiany == 2 ? 'selected' : '' }}>2</option>
                </select>
            </div>

            <button type="submit" class="btn-dodaj">Zapisz zmiany</button>
            <button  href="{{ route('grafik') }}" class="btn-anuluj btn-odstep ">Anuluj</button>

        </form>
    </div>
@endsection
