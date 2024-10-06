@extends('layout.app')

@section('content')
    <h1>Edytuj zamówienie</h1>

    <form method="POST" action="{{ route('zamowienia.update', $zamowienie->id_zamowienia) }}" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="pracownik_id">Pracownik ID:</label>
                <input type="number" class="form-control" id="pracownik_id" name="pracownik_id" value="{{ $zamowienie->pracownik_id }}" required>
                <div class="invalid-feedback">
                    Wymagany jest prawidłowy ID pracownika.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="stolik_id">Stolik ID:</label>
                <input type="number" class="form-control" id="stolik_id" name="stolik_id" value="{{ $zamowienie->stolik_id }}" required>
                <div class="invalid-feedback">
                    Wymagany jest prawidłowy ID stolika.
                </div>
            </div>
        </div>

        <div class="form-group">
            <button id="add_item" type="button" class="btn btn-primary">Dodaj potrawę</button>
        </div>

        <div id="items_group">
            @foreach($zamowienie->szczegoly as $index => $szczegol)
                <div class="item_row">
                    <div class="col-md-6 mb-3">
                        <label for="menu_id">Potrawa:</label>
                        <select class="form-control" id="menu_id" name="items[{{ $index }}][menu_id]" required>
                            @foreach($potrawy as $potrawa)
                                <option value="{{ $potrawa->menu->id_menu }}" {{ $szczegol->menu_id == $potrawa->menu->id_menu ? 'selected' : '' }}>{{ $potrawa->nazwa }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Wymagana jest prawidłowa potrawa.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ilosc">Ilość:</label>
                        <input type="number" class="form-control" id="ilosc" name="items[{{ $index }}][ilosc]" value="{{ $szczegol->ilosc }}" required>
                        <div class="invalid-feedback">
                            Wymagana jest prawidłowa ilość.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="items[{{ $index }}][status]" required>
                            <option value="gotowe" {{ $szczegol->status == 'gotowe' ? 'selected' : '' }}>Gotowe</option>
                            <option value="w trakcie przygotowania" {{ $szczegol->status == 'w trakcie przygotowania' ? 'selected' : '' }}>W trakcie przygotowania</option>
                            <option value="oczekuje" {{ $szczegol->status == 'oczekuje' ? 'selected' : '' }}>Oczekuje</option>
                            <option value="wydane" {{ $szczegol->status == 'wydane' ? 'selected' : '' }}>Wydane</option>
                        </select>
                    </div>
                    <input type="hidden" name="items[{{ $index }}][id_szczegoly]" value="{{ $szczegol->id_szczegoly }}">

                    <button type="button" class="btn btn-danger remove_item">Usuń</button>
                </div>
            @endforeach
        </div>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Zapisz zmiany</button>
    </form>
    <script>
        let itemIndex = {{ count($zamowienie->szczegoly) }};
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
