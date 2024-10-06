@extends('layout.layout.app')
@section('content')
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
            font-size: 14px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button[type="submit"]:hover  {
            background-color: #45a049;
        }

        a{
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 141px;
        }

        a:hover{
            background-color: #45a049;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>

    <h1>Edytuj potrawę</h1>
    <form action="{{ route('potrawy.update', $potrawa->id_potrawy) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nazwa">Nazwa:</label>
            <input type="text" name="nazwa" id="nazwa" value="{{ $potrawa->nazwa }}">
        </div>
        <div>
            <label for="opis">Opis:</label>
            <textarea name="opis" id="opis">{{ $potrawa->opis }}</textarea>
        </div>
        <div>
            <label for="kategoria">Wybierz kategorię:</label>
            <select name="kategoria" id="kategoria">
                <option value="PRZYSTAWKI">Przystawki</option>
                <option value="ZUPY">Zupy</option>
                <option value="PRZYSTAWKI-PIWNE">Przystawki piwne</option>
                <option value="SAŁATKI">Sałatki</option>
                <option value="MAKARONY">Makarony</option>
                <option value="MENU-DLA-DZIECI">Menu dla dzieci</option>
                <option value="DANIA-GŁÓWNE">Dania główne</option>
                <option value="BURGERY">Burgery</option>
                <option value="PIEROGI">Pierogi</option>
                <option value="DESERY">Desery</option>
                <option value="KAWA">Kawa</option>
                <option value="HERBATA">Herbata</option>
                <option value="NAPOJE-ZIMNE">Napoje zimne</option>
                <option value="RUM-GIN-VERMOUTH">Rum, Gin, Vermouth</option>
                <option value="WHISKY-BOURBON">Whisky, Bourbon</option>
                <option value="KONIAK-BRANDY">Koniak, Brandy</option>
                <option value="TEQUILA">Tequila</option>
                <option value="WÓJDKA-LIKIERY">Wódka, Likiery</option>
                <option value="SHOTY">Shoty</option>
                <option value="DRINKI">Drinki</option>
                <option value="DRINKI-BEZALKOHOLOWE">Drinki bezalkoholowe</option>
            </select>
        </div>
        <button type="submit">Zaktualizuj</button>
        <a type="submit" href="{{ route('potrawy.index') }}">Powrót</a>
    </form>
@endsection
