@extends('layout.app')
@section('content')
    <h1>Dodaj pozycję do menu</h1>

    <form action="{{ route('menu.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="potrawa">Potrawa:</label>
            <select name="potrawa" id="potrawa" class="form-control" required>
                <option value="">Wybierz potrawę</option>
                @foreach($potrawy as $potrawa)
                    <option value="{{ $potrawa->nazwa }}">{{ $potrawa->nazwa }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cena">Cena:</label>
            <input type="number" name="cena" id="cena" step="0.01" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="dostepnosc">Dostępność:</label>
            <select name="dostepnosc" id="dostepnosc" class="form-control" required>
                <option value="1">Dostępne</option>
                <option value="0">Niedostępne</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj</button>
    </form>
@endsection
