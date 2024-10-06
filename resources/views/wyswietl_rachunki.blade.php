@extends('layout.app')
@section('content')
<div class="container">
        <h1>Lista rachunków</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Numer rachunku</th>
                <th>Numer zamówienia</th>
                <th>Kwota rachunku</th>
                <th>Data utworzenia</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rachunki as $rachunek)
                <tr>
                    <td>{{ $rachunek->id_rachunku }}</td>
                    <td>{{ $rachunek->zamowienie_id }}</td>
                    <td>{{ $rachunek->cena_rachunku }}</td>
                    <td>{{ $rachunek->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
@endsection
