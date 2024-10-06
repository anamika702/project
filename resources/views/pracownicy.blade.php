@extends('layout.app')

@section('content')
    <div id="zawartosc_strony">

    <h1>Pracownicy</h1>

    <!-- Przycisk dodania nowego pracownika -->
        <div class="d-flex justify-content-center">
            <a href="{{ route('pracownicyCreate') }}" class="btn-dodaj" target="_blank">Dodaj nowego pracownika</a>
        </div>

        <div class="menu-tabela">
            <!-- Menu wyboru stanowiska -->
            <select id="stanowisko" onchange="filterByPosition()">
                <option value="">Wszystkie stanowiska</option>
                @foreach($pracownicy->unique('stanowisko')->sortBy('stanowisko') as $pracownik)
                    <option value="{{ $pracownik->stanowisko }}">{{ $pracownik->stanowisko }}</option>
                @endforeach
            </select>
        </div>

        <table>
            <!-- Kod tabeli -->
        </table>




        <table>
            <thead>
            <tr>
                <th>Stanowisko</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Email</th>
                <th>Numer telefonu</th>
                <th>Inne informacje</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody id="filteredTableBody">
            @foreach($pracownicy->sortBy('stanowisko') as $pracownik)
                <tr>
                    <td>{{ $pracownik->stanowisko }}</td>
                    <td>{{ $pracownik->imie }}</td>
                    <td>{{ $pracownik->nazwisko }}</td>
                    <td>{{ $pracownik->email }}</td>
                    <td>{{ $pracownik->numer_telefonu }}</td>
                    <td>{{ $pracownik->inne_informacje }}</td>
                    <td>
                        <!-- Przycisk edycji -->
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('pracownicyEdit', $pracownik->id) }}" class="btn btn-edytuj" target="_blank">Edytuj</a>
                            </div>


                        </form>

                        <!-- Przycisk usuwania -->
                            <form action="{{ route('pracownicy.destroy', $pracownik->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-usun">Usuń</button>
                                </div>
                            </form>


                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <script>
        function filterByPosition() {
            var dropdown = document.getElementById("stanowisko");
            var selectedPosition = dropdown.value;
            var tableBody = document.getElementById("filteredTableBody");
            var rows = tableBody.getElementsByTagName("tr");

            for (var i = 0; i < rows.length; i++) {
                var positionCell = rows[i].getElementsByTagName("td")[0];
                if (selectedPosition === "" || positionCell.innerText === selectedPosition) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>

@endsection
