@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Tworzenie nowego raportu kelnera</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID Rachunku</th>
                <th>Cena Rachunku</th>
                <th>Data Rachunku</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rachunki as $rachunek)
                @php
                    $today = \Carbon\Carbon::today()->format('Y-m-d');
                    $rachunekDate = \Carbon\Carbon::parse($rachunek->created_at)->format('Y-m-d');
                @endphp
                @if ($today === $rachunekDate)
                    <tr>
                        <td>{{ $rachunek->id_rachunku }}</td>
                        <td>{{ $rachunek->cena_rachunku }}</td>
                        <td>{{ $rachunek->created_at }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

        <form action="{{ route('raport_kelner.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="id_pracownika">ID Pracownika:</label>
                <input type="text" class="form-control" id="id_pracownika" name="id_pracownika" value="{{ auth()->user()->id }}" readonly>
            </div>

            <div class="form-group">
                <label for="data_raportu">Data Raportu:</label>
                <input type="date" class="form-control" id="data_raportu" name="data_raportu" value="{{ date('Y-m-d') }}" readonly>
            </div>

            <div class="form-group">
                <label for="dochod">Dochód:</label>
                <input type="number" class="form-control" id="dochod" name="dochod" value="{{ $dochod ?? 0 }}" readonly>
            </div>

            <button type="submit" class="btn btn-dodaj">Potwierdź utworzenie raportu</button>
            <a href="{{ route('raport.kelner') }}" class="btn btn-anuluj">Anuluj</a>
        </form>
    </div>
@endsection
