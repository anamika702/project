@extends('layout.app')

@section('content')
    <div id="zawartosc_strony">

    <title>Dodaj pracownika</title>
        </head>
        <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">Dodaj pracownika</div>

                        <div class="card-body">
                            <form action="{{ route('pracownicy.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="imie">Imię:</label>
                                    <input type="text" name="imie" id="imie" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="nazwisko">Nazwisko:</label>
                                    <input type="text" name="nazwisko" id="nazwisko" class="form-control" required>
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
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="numer_telefonu">Numer telefonu:</label>
                                    <input type="text" name="numer_telefonu" id="numer_telefonu" class="form-control"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Hasło:</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="inne_informacje">Dodatkowe informacje:</label>
                                    <textarea name="inne_informacje" id="inne_informacje" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn-dodaj">Dodaj</button>
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
