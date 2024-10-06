@extends('layout.app')
@section('content')
<html>
<table>
    <thead>
    <tr>
        <th>ID_rezerwacji</th>
        <th>Nazwisko</th>
        <th>Numer telefonu</th>
        <th>ID_stolika</th>
        <th>Data_rezerwacji</th>
        <th>Godzina_rezerwacji</th>
        <th>Liczba_osob</th>
        <th>Status_rezerwacji</th>
        <th>Inne_informacje</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rezerwacje as $rezerwacja)
        <tr>
            <td>{{ $rezerwacja->ID_rezerwacji }}</td>
            <td>{{ $rezerwacja->Nazwisko }}</td>
            <td>{{ $rezerwacja->Numer_tel }}</td>
            <td>{{ $rezerwacja->ID_stolika }}</td>
            <td>{{ $rezerwacja->Data_rezerwacji }}</td>
            <td>{{ $rezerwacja->Godzina_rezerwacji }}</td>
            <td>{{ $rezerwacja->Liczba_osob }}</td>
            <td>{{ $rezerwacja->Status_rezerwacji }}</td>
            <td>{{ $rezerwacja->Inne_informacje }}</td>
            <td><a href="{{ route('rezerwacje.edit', ['id' => $rezerwacja->ID_rezerwacji]) }}" class="btn btn-primary">Edytuj</a></td>
            <td>
                <form action="{{ route('rezerwacje.destroy', $rezerwacja->ID_rezerwacji) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link" onclick="return confirm('Czy na pewno chcesz usunąć rezerwację?')">Usuń</button>
                </form>
            </td>

        </tr>

    @endforeach
    </tbody>
</table>
<a href="{{ route('rezerwacje.create') }}" class="btn btn-success">Dodaj nową rezerwację</a>

</html>
@endsection
