<?php
namespace App\Http\Controllers;

use App\Models\Stolik;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grafik;

class GrafikController extends Controller
{
    public function index()
    {
        $grafik = Grafik::all();
        // Pobierz listę pracowników i przekaż do widoku
        $pracownicy = User::all();

return view('grafik', compact('grafik', 'pracownicy'));
}

    public function create()
    {
        $pracownicy = User::all();
        $stoliki = Stolik::all();

        return view('grafik_create', compact('pracownicy', 'stoliki'));
    }

    public function store(Request $request)
    {
        // Walidacja danych wejściowych
        $validatedData = $request->validate([
            'id_pracownika' => 'required',
            'id_stolika1' => 'nullable',
            'id_stolika2' => 'nullable',
            'id_stolika3' => 'nullable',
            'data' => 'required|date',
            'nr_zmiany' => 'required|in:1,2'
        ]);

        // Sprawdzenie, czy wybrano unikalne id_stolika
        $idStolika1 = $validatedData['id_stolika1'];
        $idStolika2 = $validatedData['id_stolika2'];
        $idStolika3 = $validatedData['id_stolika3'];

        if ($idStolika1 && ($idStolika1 == $idStolika2 || $idStolika1 == $idStolika3)) {
            return redirect()->back()->withErrors('Identyfikator stolika powtarza się.');
        }

        if ($idStolika2 && $idStolika2 == $idStolika3) {
            return redirect()->back()->withErrors('Identyfikator stolika powtarza się.');
        }

        // Tworzenie nowego wpisu w grafiku
        $grafik = new Grafik;
        $grafik->id_pracownika = $validatedData['id_pracownika'];
        $grafik->id_stolika1 = $validatedData['id_stolika1'];
        $grafik->id_stolika2 = $validatedData['id_stolika2'];
        $grafik->id_stolika3 = $validatedData['id_stolika3'];
        $grafik->data = $validatedData['data'];
        $grafik->nr_zmiany = $validatedData['nr_zmiany'];

        $grafik->save();

        // Przekierowanie użytkownika po pomyślnym dodaniu rekordu
        return redirect()->route('grafik')->with('success', 'Pracownik został przypisany do grafiku.');
    }


    public function destroy(Grafik $grafik)
    {
        $grafik->delete();

        return redirect()->route('grafik')->with('success', 'Pracownik został usunięty z grafiku.');
    }

    public function edit(Grafik $grafik)
    {
        $stoliki = Stolik::all();
        $pracownicy = User::all();
        return view('grafik_edit', compact('grafik', 'pracownicy', 'stoliki'));
    }

    public function update(Request $request, $id_grafika)
    {
        // Walidacja danych wejściowych
        $validatedData = $request->validate([
            'id_pracownika' => 'required',
            'id_stolika1' => 'nullable',
            'id_stolika2' => 'nullable',
            'id_stolika3' => 'nullable',
            'data' => 'required|date',
            'nr_zmiany' => 'required|in:1,2'
        ]);

        // Sprawdzenie, czy wybrano unikalne id_stolika
        $idStolika1 = $validatedData['id_stolika1'];
        $idStolika2 = $validatedData['id_stolika2'];
        $idStolika3 = $validatedData['id_stolika3'];

        if ($idStolika1 && ($idStolika1 == $idStolika2 || $idStolika1 == $idStolika3)) {
            return redirect()->back()->withErrors('Identyfikator stolika powtarza się.');
        }

        if ($idStolika2 && $idStolika2 == $idStolika3) {
            return redirect()->back()->withErrors('Identyfikator stolika powtarza się.');
        }

        $grafik = Grafik::findOrFail($id_grafika);

        // Aktualizacja danych w rekordzie grafiku
        $grafik->id_pracownika = $validatedData['id_pracownika'];
        $grafik->id_stolika1 = $validatedData['id_stolika1'];
        $grafik->id_stolika2 = $validatedData['id_stolika2'];
        $grafik->id_stolika3 = $validatedData['id_stolika3'];
        $grafik->data = $validatedData['data'];
        $grafik->nr_zmiany = $validatedData['nr_zmiany'];
        $grafik->save();

        return redirect()->route('grafik')->with('success', 'Grafik został zaktualizowany.');
    }
}
