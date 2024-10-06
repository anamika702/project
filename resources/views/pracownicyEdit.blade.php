@extends('layout.app')

@section('content')
    <div id="zawartosc_strony">

    <title>Edytuj pracownika</title>
        </head>
        <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">Edytuj pracownika</div>

                        <div class="card-body">
                            <form action="{{ route('pracownicy.update', $pracownik->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="imie">Imię:</label>
                                    <input type="text" name="imie" id="imie" class="form-control"
                                           value="{{ $pracownik->imie }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="nazwisko">Nazwisko:</label>
                                    <input type="text" name="nazwisko" id="nazwisko" class="form-control"
                                           value="{{ $pracownik->nazwisko }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="stanowisko">Stanowisko:</label>
                                    <select name="stanowisko" id="stanowisko" class="form-control" required>
                                        <option value="Kelner">Kelner</option>
                                        <option value="Kucharz">Kucharz</option>
                                        <option value="Szef kuchni">Szef kuchni</option>
                                        <option value="Menadżer">Menadżer</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="{{ $pracownik->email }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="numer_telefonu">Numer telefonu:</label>
                                    <input type="text" name="numer_telefonu" id="numer_telefonu" class="form-control"
                                           value="{{ $pracownik->numer_telefonu }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="haslo">Hasło:</label>
                                    <input type="password" name="haslo" id="haslo" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="inne_informacje">Dodatkowe informacje:</label>
                                    <textarea name="inne_informacje" id="inne_informacje"
                                              class="form-control">{{ $pracownik->inne_informacje }}</textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn-dodaj">Zapisz</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
    </div>
@endsection
