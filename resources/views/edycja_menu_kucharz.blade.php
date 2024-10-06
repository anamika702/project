@extends('layout.app')
@section('content')
    <div id="zawartosc_strony">
        <h1>Edytuj pozycję menu</h1>

        <form action="{{ route('menu.update', $menu->id_menu) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="dostepnosc">Dostępność:</label>
                <select name="dostepnosc" id="dostepnosc" class="form-control" required>
                    <option value="1" {{ $menu->dostepnosc ? 'selected' : '' }}>Dostępne</option>
                    <option value="0" {{ !$menu->dostepnosc ? 'selected' : '' }}>Niedostępne</option>
                </select>
            </div>

            <button type="submit" class="btn btn-dodaj">Zapisz</button>
        </form>
    </div>
@endsection
