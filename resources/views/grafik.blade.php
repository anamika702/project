@extends('layout.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Grafik</h1>

            <div class="mb-3 text-center">
                <a href="{{ route('grafik.create') }}" class="btn-dodaj">Dodaj wpis do grafiku</a>
            </div>

        @if ($grafik->isEmpty())
            <p>Brak wpisów w grafiku.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Pracownik</th>
                    <th>Numery stolików</th>
                    <th>Data</th>
                    <th>Numer zmiany</th>
                    <th>Akcje</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($grafik->sortByDesc('data') as $wpis)
                    @php
                        $today = \Carbon\Carbon::today();
                        $wpisDate = \Carbon\Carbon::parse($wpis->data);
                    @endphp
                    @if ($wpisDate->gte($today))
                        <tr>
                            <td>{{ $wpis->id_pracownika }}</td>
                            @foreach ($pracownicy as $pracownik)
                                @if ($pracownik->id == $wpis->id_pracownika)
                                    <td>{{ $pracownik->stanowisko }} - {{ $pracownik->imie }} {{ $pracownik->nazwisko }}</td>
                                @endif
                            @endforeach
                            <td>{{ $wpis->id_stolika1 }}  {{ $wpis->id_stolika2 }} {{ $wpis->id_stolika3 }}</td>
                            <td>{{ $wpis->data }}</td>
                            <td>{{ $wpis->nr_zmiany }}</td>
                            <td>
                                <div class="container">
                                    <a href="{{ route('grafik.edit', $wpis->id_grafika) }}" class="btn-edytuj" style="width:82px; margin-bottom: 5px;">Edytuj</a>
                                    <form action="{{ route('grafik.destroy', $wpis->id_grafika) }}" method="POST" style="margin-bottom: 5px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-usun" style="margin-left: 13px; width:81px;">Usuń</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
