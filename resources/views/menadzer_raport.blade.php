@extends('layout.app')

@section('content')

    <style>
        .table-container {
            max-height: 300px;
            overflow-y: scroll;
        }
    </style>

    <div class="container">
        <h2>Wszystkie raporty dzienne</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID Raportu</th>
                    <th>Pracownik</th>
                    <th>Data Raportu</th>
                    <th>Dochód</th>
                </tr>
                </thead>
                <tbody>
                @foreach($raport->sortByDesc('data_raportu') as $r)
                    @php
                        $pracownik = App\Models\User::find($r->id_pracownika);
                    @endphp
                    <tr>
                        <td>{{ $r->id_raportu }}</td>
                        <td>{{ $pracownik->imie }} {{ $pracownik->nazwisko }}</td>
                        <td>{{ $r->data_raportu }}</td>
                        <td>{{ $r->dochod }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <h2>Wszystkie raporty miesięczne</h2>
        <form action="{{ route('raport.menadzer.make') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-dodaj">Stwórz Raport Miesięczny</button>
        </form>

        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID Raportu</th>
                    <th>Data Raportu</th>
                    <th>Miesiąc</th>
                    <th>Dochód</th>
                </tr>
                </thead>
                <tbody>

                @foreach($menadzer_raport as $raport)
                    <tr>
                        <td>{{ $raport->id_raportu }}</td>
                        <td>{{ $raport->data_raportu }}</td>
                        <td>{{ \Carbon\Carbon::parse($raport->data_raportu)->locale('pl')->isoFormat('MMMM') }}</td>
                        <td>{{ $raport->dochod }}</td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
