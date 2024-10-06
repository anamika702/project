@extends('layout.app')
@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 25px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        div.dodaj
        {
            text-align: center;
        }
    </style>
    <h1>Lista potraw</h1>
    <div class="dodaj">
    <a href="{{ route('dodawanie_potraw') }}" class="btn btn-dodaj">Dodaj nową potrawę</a>
    </div>
        <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Opis</th>
            <th>Kategoria</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        @foreach($potrawy as $potrawa)
            <tr>
                <td>{{ $potrawa->id_potrawy }}</td>
                <td>{{ $potrawa->nazwa }}</td>
                <td>{{ $potrawa->opis }}</td>
                <td>{{ $potrawa->kategoria }}</td>
                <td>
                    <form action="{{ route('potrawy.destroy', $potrawa->id_potrawy) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-usun" >Usuń</button>
                    </form>
                    <button href="{{ route('potrawy.edit', $potrawa->id_potrawy) }}" class="btn btn-edytuj" style="margin-top: 5px" >Edytuj</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
