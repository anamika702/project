@extends('layout.app')
@section('content')
    <!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Rachunek</h1>
<h2>Zamówienie nr {{ $zamowienie->id_zamowienia }}</h2>
@php
    $totalCost = 0;
    $Cost = 0;
@endphp
<table>
    <tr>
        <th>Potrawa</th>
        <th>Ilość</th>
        <th>Cena poj</th>
        <th>Cena wielok</th>
    </tr>
    @foreach($zamowienie->szczegoly as $szczegol)
        <tr>
            <td>{{ $szczegol->menu->potrawa->nazwa }}</td>
            <td>{{ $szczegol->ilosc }}</td>
            <td>{{ $szczegol->menu->cena }} zł</td>
            <td>{{ $szczegol->menu->cena * $szczegol->ilosc }} zł</td>
        </tr>
    @endforeach
    <tr>
        <th>Całkowita cena zamówienia:</th>
        <th></th>
        <th></th>
        <th>
            @php
                $totalCost = 0;
            @endphp
            @foreach ($zamowienie->szczegoly as $szczegol)
                @php
                    $totalCost += $szczegol->menu->cena * $szczegol->ilosc;
                @endphp
            @endforeach
            {{ $totalCost }} zł
        </th>
    </tr>
</table>

@php
    $rachunek = App\Models\Rachunek::where('zamowienie_id', $zamowienie->id_zamowienia)->first();
@endphp

@if ($rachunek)
    <p>Zamówienie zostało opłacone.</p>
@else
    <form action="{{ route('rachunek.create', $zamowienie->id_zamowienia) }}" method="POST">
        @csrf
        <button type="submit" name="oplac" class="btn-dodaj" onclick="window.location.reload();">Opłać</button>
    </form>
@endif

</body>
</html>
@endsection
