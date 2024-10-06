@extends('layout.app')
@section('content')
    <div id="zawartosc_strony">
        <h1>Menu</h1>

        <div class="mb-3">
            <a href="{{ route('menu.index', ['sort' => 'dostepne']) }}" class="btn btn-dodaj">Pokaż tylko dostępne</a>
            <a href="{{ route('menu.index', ['sort' => 'niedostepne']) }}" class="btn btn-usun">Pokaż tylko niedostępne</a>
            <a href="{{ route('menu.index') }}" class="btn btn-edytuj">Pokaż wszystkie</a>
        </div>

        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Potrawa</th>
                <th>Cena</th>
                <th>Dostępność</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menuItems as $menuItem)
                <tr style="background-color: {{ $menuItem->dostepnosc ? '' : '#FFCCCC' }}">
                    <td>{{ $menuItem->id_menu }}</td>
                    <td>{{ $menuItem->id_potrawa }}</td>
                    <td>{{ $menuItem->cena }}</td>
                    <td>{{ $menuItem->dostepnosc ? 'Dostępne' : 'Niedostępne' }}</td>
                    <td>
                        <!-- Przyciski do edycji -->
                        <a href="{{ route('menu.edit-kucharz', $menuItem->id_menu) }}" class="btn btn-edytuj">Edytuj (Kucharz)</a>
                        <a href="{{ route('menu.edit-menedzer', $menuItem->id_menu) }}" class="btn btn-edytuj">Edytuj (Menedżer)</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
