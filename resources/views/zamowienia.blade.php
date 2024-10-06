@extends('layout.app')

@section('content')
    <div class="container">
        <!-- wyświetlanie informacji o zalogowanym użytkowniku -->
        @if(Auth::check())
            <div class="user-info">
                <p>{{ Auth::user()->name }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h2>Lista zamówień:</h2>
                <ul class="list-group">
                    @foreach ($zamowienia as $zamowienie)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="font-weight-bold">Numer zamówienia:</span> {{ $zamowienie->id_zamowienia }},
                                <span class="font-weight-bold">Pracownik:</span> {{ $zamowienie->pracownik->imie }} {{ $zamowienie->pracownik->nazwisko }},
                                <span class="font-weight-bold">Stolik:</span> {{ $zamowienie->stolik_id }},
                                <br>
                                <span class="font-weight-bold">Status zamówienia:</span> {{ $zamowienie->status }},
                                <br>
                                <span class="font-weight-bold">Data przyjęcia:</span> {{ $zamowienie->przyjecie_at }},
                                <span class="font-weight-bold">Data zrealizowania:</span> {{ $zamowienie->zrealizowanie_at }}
                            </div>

                            <div>
                                <span class="font-weight-bold">Szczegóły zamówienia:</span>
                                @php
                                    $totalCost = 0;
                                @endphp
                                @foreach ($zamowienie->szczegoly as $szczegol)
                                    @if ($szczegol->menu && $szczegol->menu->potrawa)
                                        <div>
                                            <span class="font-weight-bold">Potrawa:</span> {{ $szczegol->menu->potrawa->nazwa }},
                                            <span class="font-weight-bold">Ilość:</span> {{ $szczegol->ilosc }},
                                            <span class="font-weight-bold">Status:</span> {{ $szczegol->status }},
                                            @php
                                                $totalCost += $szczegol->menu->cena * $szczegol->ilosc;
                                            @endphp
                                        </div>
                                    @else
                                        <div>Potrawa nie jest dostępna</div>
                                    @endif
                                @endforeach
                                <div>
                                    <span class="font-weight-bold">Całkowita cena zamówienia:</span> {{ $totalCost }} zł
                                </div>
                            </div>

                            <div>
                                <div style="display: inline;">
                                    <form action="{{ route('zamowieniaEdit', $zamowienie->id_zamowienia) }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Edytuj</button>
                                    </form>
                                    <form action="{{ route('zamowienia.destroy', $zamowienie->id_zamowienia) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger">Usuń</button>
                                    </form>
                                </div>
                                <div style="text-align: center;">
                                    @php
                                        $wszystkieWydane = true;
                                    @endphp
                                    @foreach ($zamowienie->szczegoly as $szczegol)
                                        @if ($szczegol->status !== 'wydane')
                                            @php
                                                $wszystkieWydane = false;
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if ($wszystkieWydane)
                                        <a href="{{ route('rachunek.show', ['id' => $zamowienie->id_zamowienia]) }}" class="btn btn-primary">Rachunek</a>
                                    @endif
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="py-5 text-center">
            Dodawanie Zamówień
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('zamowienia.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="stolik_id">Numer stolika:</label>
                            <input type="number" class="form-control" id="stolik_id" name="stolik_id" required>
                            <div class="invalid-feedback">
                                Wymagany jest prawidłowy ID stolika.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="add_item" type="button" class="btn btn-primary">Dodaj potrawę</button>
                    </div>
                    <div id="items_group">
                        <div class="item_row">
                            <div class="col-md-6 mb-3">
                                <label for="menu_id">Potrawa:</label>
                                <select class="form-control" id="menu_id" name="items[0][menu_id]" required>
                                    @foreach($potrawy as $potrawa)
                                        <option value="{{ $potrawa->menu->id_menu }}">{{ $id_potrawa }}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">
                                    Wymagana jest prawidłowa potrawa.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ilosc">Ilość:</label>
                                <input type="number" class="form-control" id="ilosc" name="items[0][ilosc]" required>
                                <div class="invalid-feedback">
                                    Wymagana jest prawidłowa ilość.
                                </div>
                            </div>


                            <button type="button" class="btn btn-danger remove_item">Usuń</button>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Dodaj zamówienie</button>
                </form>
            </div>
        </div>

    </div>



    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        let itemIndex = 1;
        document.getElementById('add_item').addEventListener('click', function() {
            let clone = document.querySelector('.item_row').cloneNode(true);
            clone.querySelectorAll('input, select').forEach(function(input) {
                input.name = input.name.replace('[0]', '[' + itemIndex + ']');
                input.id = input.id + '_' + itemIndex; // dodajemy unikalne identyfikatory
            });
            // Set the selected option to the first one for the new item
            clone.querySelector('select').selectedIndex = 0;
            document.getElementById('items_group').appendChild(clone);
            itemIndex++;
        });

        document.getElementById('items_group').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove_item')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
