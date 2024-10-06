<?php

namespace App\Http\Controllers;

use App\Models\Rachunek;
use App\Models\Zamowienie;
use App\Models\SzczegolyZamowien;

use Illuminate\Http\Request;

class RachunekController extends Controller
{
    public function wyswietlRachunki()
    {
        $rachunki = Rachunek::all();

        return view('wyswietl_rachunki', ['rachunki' => $rachunki]);
    }

    public function showRachunek($id)
    {
        $zamowienie = Zamowienie::findOrFail($id);
        return view('rachunek', compact('zamowienie'));
    }

    public function createRachunek($id)
    {
        $zamowienie = Zamowienie::findOrFail($id);

        // Tworzenie nowego rachunku
        $rachunek = new Rachunek();
        $rachunek->zamowienie_id = $zamowienie->id_zamowienia;

        // Obliczanie ceny rachunku na podstawie szczegółów zamówienia
        $cenaRachunku = 0;
        foreach ($zamowienie->szczegoly as $szczegol) {
            $cenaRachunku += $szczegol->menu->cena * $szczegol->ilosc;
        }
        $rachunek->cena_rachunku = $cenaRachunku;


        $rachunek->save();

        // Aktualizowanie statusu w szczegółach zamówienia na "opłacone"
        foreach ($zamowienie->szczegoly as $szczegol) {
            $szczegol->status = 'opłacone';
            $szczegol->save();
        }

        return redirect()->route('rachunek.show', $zamowienie->id_zamowienia)->with('success', 'Rachunek został utworzony i zamówienie zostało oznaczone jako opłacone.');
    }
}
