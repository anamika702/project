<?php

namespace App\Http\Controllers;

use App\Models\KelnerRaport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Rachunek;
use App\Models\Zamowienie;

class KelnerRaportController extends Controller
{
    public function index()
    {
        $raport = KelnerRaport::all();
        $pracownicy = User::all();
        $user = auth()->user();
        $zamowienia = Zamowienie::where('pracownik_id', $user->id)->get();


        return view('kelner_raport', compact('raport', 'pracownicy', 'zamowienia'));
    }

    public function create()
    {
        $pracownicy = User::all();
        $id_pracownika = auth()->user()->id;
        $zamowienia = Zamowienie::where('pracownik_id', $id_pracownika)->get();
        $rachunki = Rachunek::where('zamowienie_id', $id_pracownika)->get();

        // Pobierz sumę wartości kolumny 'cena_rachunku' ze wszystkich rachunków
        $dochod = Rachunek::where('zamowienie_id', $id_pracownika)->sum('cena_rachunku');

        return view('kelner_raport_create', compact('pracownicy', 'dochod', 'zamowienia', 'rachunki'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pracownika' => 'required|exists:pracownik,id',
            'data_raportu' => 'required|date',
            'dochod' => 'required|numeric',
        ]);

        KelnerRaport::create([
            'id_pracownika' => $request->input('id_pracownika'),
            'data_raportu' => $request->input('data_raportu'),
            'dochod' => $request->input('dochod'),
        ]);

        return redirect()->route('raport.kelner')->with('success', 'Raport został dodany.');
    }


    public function showCreateRaport()
    {
        $pracownik = auth()->user();
        $dochod = Rachunek::whereDate('created_at', now()->toDateString())->sum('cena_rachunku');

        return view('kelner_raport_create', compact('pracownik', 'dochod'));
    }
}
