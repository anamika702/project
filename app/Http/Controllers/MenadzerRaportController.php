<?php

namespace App\Http\Controllers;

use App\Models\MenadzerRaport;
use App\Models\KelnerRaport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Rachunek;

class MenadzerRaportController extends Controller
{
    public function index()
    {
        $menadzer_raport = MenadzerRaport::all();
        $raport = KelnerRaport::all();
        $pracownicy = User::all();

        return view('menadzer_raport', compact('raport','menadzer_raport', 'pracownicy'));
    }

    public function make()
    {
        $pracownicy = User::all();
        $dochod = Rachunek::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('cena_rachunku');

        return view('menadzer_raport_create', compact('pracownicy', 'dochod'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'data_raportu' => 'required|date',
            'dochod' => 'required|numeric',
        ]);

        MenadzerRaport::create([
            'data_raportu' => $request->input('data_raportu'),
            'dochod' => $request->input('dochod'),
        ]);

        return redirect()->route('raport.menadzer')->with('success', 'Raport został dodany.');
    }
}
