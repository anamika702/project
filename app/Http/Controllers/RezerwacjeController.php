<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rezerwacje;
use App\Models\Stolik;

class RezerwacjeController extends Controller
{
    public function index(Request $request)
    {
        $ID_stolika = $request->input('ID_stolika');

        if ($ID_stolika) {
            $rezerwacje = Rezerwacje::where('ID_stolika', $ID_stolika)
                ->orderBy('Data_rezerwacji')
                ->orderBy('Godzina_rezerwacji')
                ->get();

        } else {
            $rezerwacje = Rezerwacje::all();
        }

        return view('rezerwacje', compact('rezerwacje'));
    }

    public function create()
    {
        $stoliki = Stolik::all();
        return view('dodawanie_rezerwacji', compact( 'stoliki'));
    }

    public function store(Request $request)
    {
        // Walidacja danych wejściowych
        $validatedData = $request->validate([
            'Nazwisko' => 'required',
            'Numer_tel' => 'required',
            'ID_stolika' => 'required',
            'Data_rezerwacji' => 'required',
            'Godzina_rezerwacji' => 'required',
            'Liczba_osob' => 'required',
            'Status_rezerwacji' => 'required',
            // Dodaj inne wymagane pola wraz z regułami walidacji
        ]);

        // Zapisanie nowej rezerwacji w bazie danych
        $rezerwacja = Rezerwacje::create([
            'Nazwisko' => $request->input('Nazwisko'),
            'Numer_tel' => $request->input('Numer_tel'),
            'ID_stolika' => $request->input('ID_stolika'),
            'Data_rezerwacji' => $request->input('Data_rezerwacji'),
            'Godzina_rezerwacji' => $request->input('Godzina_rezerwacji'),
            'Liczba_osob' => $request->input('Liczba_osob'),
            'Status_rezerwacji' => $request->input('Status_rezerwacji'),
            'Inne_informacje' => $request->input('Inne_informacje'),
            // Uzupełnij inne pola rezerwacji
        ]);

        // Aktualizacja statusu rezerwacji w powiązanej tabeli 'Stolik'
        $statusRezerwacji = $rezerwacja->Status_rezerwacji;
        if ($statusRezerwacji === 'Potwierdzona' || $statusRezerwacji === 'potwierdzona') {
            $stolik = Stolik::find($request->input('ID_stolika'));
            if ($stolik) {
                $stolik->Status_rezerwacji = 'Zarezerwowany';
                $stolik->save();
            }
        }

        // Przekierowanie użytkownika po pomyślnym dodaniu rezerwacji
        return redirect()->route('rezerwacje.index')->with('success', 'Rezerwacja została dodana.');
    }


    public function edit($id)
    {
        $stoliki = Stolik::all();
        $rezerwacja = Rezerwacje::where('ID_rezerwacji', $id)->firstOrFail();

        return view('edytuj_rezerwacje', compact('rezerwacja', 'stoliki'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            // Określ reguły walidacji dla poszczególnych pól
            'Nazwisko' => 'required',
            'Numer_tel' => 'required',
            'ID_stolika' => 'required',
            'Data_rezerwacji' => 'required',
            'Godzina_rezerwacji' => 'required',
            'Liczba_osob' => 'required',
            'Status_rezerwacji' => 'required',
            // Dodaj inne wymagane pola wraz z ich regułami walidacji
        ]);

        // Znajdź rezerwację o określonym ID_rezerwacji
        $rezerwacja = Rezerwacje::where('ID_rezerwacji', $id)->firstOrFail();

        // Pobierz oryginalne ID stolika przed aktualizacją
        $oryginalneIdStolika = $rezerwacja->ID_stolika;

        // Zaktualizuj dane rezerwacji na podstawie przesłanych danych formularza
        $rezerwacja->Nazwisko = $request->input('Nazwisko');
        $rezerwacja->Numer_tel = $request->input('Numer_tel');
        $rezerwacja->ID_stolika = $request->input('ID_stolika');
        $rezerwacja->Data_rezerwacji = $request->input('Data_rezerwacji');
        $rezerwacja->Godzina_rezerwacji = $request->input('Godzina_rezerwacji');
        $rezerwacja->Liczba_osob = $request->input('Liczba_osob');
        $rezerwacja->Status_rezerwacji = $request->input('Status_rezerwacji');
        // Uzupełnij inne pola rezerwacji

        // Zapisz zaktualizowane dane rezerwacji
        $rezerwacja->save();

        // Zaktualizuj status rezerwacji w stoliku, jeśli zmieniono stolik
        if ($rezerwacja->ID_stolika !== $oryginalneIdStolika) {
            $nowyStolik = Stolik::find($rezerwacja->ID_stolika);
            $staryStolik = Stolik::find($oryginalneIdStolika);

            if ($nowyStolik) {
                $liczbaRezerwacjiNowegoStolika = Rezerwacje::where('ID_stolika', $rezerwacja->ID_stolika)
                    ->where('Status_rezerwacji', 'Potwierdzona')
                    ->count();

                $nowyStatusNowegoStolika = $liczbaRezerwacjiNowegoStolika > 0 ? 'Zarezerwowany' : $nowyStolik->Status_rezerwacji;
                $nowyStolik->Status_rezerwacji = $nowyStatusNowegoStolika;
                $nowyStolik->save();
            }

            if ($staryStolik) {
                $liczbaRezerwacjiStaregoStolika = Rezerwacje::where('ID_stolika', $oryginalneIdStolika)
                    ->where('Status_rezerwacji', 'Potwierdzona')
                    ->count();

                $nowyStatusStaregoStolika = $liczbaRezerwacjiStaregoStolika === 0 ? 'Brak' : $staryStolik->Status_rezerwacji;
                $staryStolik->Status_rezerwacji = $nowyStatusStaregoStolika;
                $staryStolik->save();
            }
        }

        // Przekieruj użytkownika po pomyślnym zaktualizowaniu rezerwacji
        return redirect()->route('rezerwacje.index')->with('success', 'Rezerwacja została zaktualizowana.');
    }



    public function destroy($id)
    {
        // Pobierz rezerwację o podanym ID
        $rezerwacja = Rezerwacje::find($id);

        // Sprawdź, czy rezerwacja została znaleziona
        if (!$rezerwacja) {
            return redirect()->route('rezerwacje.index')->with('error', 'Rezerwacja nie została znaleziona.');
        }

        // Usuń rezerwację
        $rezerwacja->delete();

        return redirect()->route('rezerwacje.index')->with('success', 'Rezerwacja została usunięta.');
    }


}
