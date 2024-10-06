<?php

namespace App\Http\Controllers;

use App\Models\Stolik;
use App\Models\Grafik;
use App\Models\Zamowienie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StolikController;

class KelnerWidokController extends Controller
{
    public function whereHas($id_pracownika)
    {
        $stoliki = Stolik::all();
        $stoliki = Grafik::whereHas('pracownik', function ($query) use ($id_pracownika) {
            $query->where('id', $id_pracownika);
        })->get();

        return $stoliki;
    }

    public function whereHasZamowienia($id_pracownika)
    {
        $zamowienia = Zamowienie::where('pracownik_id', $id_pracownika)
            ->with(['szczegoly.zamowienie', 'szczegoly.menu'])
            ->get();


        return $zamowienia;
    }

    public function show()
    {
        $id_pracownika = auth()->user()->id;

        $kelnerWidokController = new KelnerWidokController();
        $stoliki = $kelnerWidokController->whereHas($id_pracownika);

        $zamowienia = $kelnerWidokController->whereHasZamowienia($id_pracownika);

        return view('kelner_widok', ['stoliki' => $stoliki, 'zamowienia' => $zamowienia]);
    }


}

