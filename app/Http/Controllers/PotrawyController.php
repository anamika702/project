<?php

namespace App\Http\Controllers;

use App\Models\Potrawa;
use Illuminate\Http\Request;

class PotrawyController extends Controller
{
    public $timestamps = false;
    public function index()
    {
        $potrawy = Potrawa::all();
        return view('potrawy')->with('potrawy', $potrawy);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nazwa' => 'required',
            'opis' => 'required',
            'kategoria' => 'required',
        ]);

        $potrawa = new Potrawa();
        $potrawa->nazwa = $request->nazwa;
        $potrawa->opis = $request->opis;
        $potrawa->kategoria = $request->kategoria;
        $potrawa->save();

        return redirect()->route('potrawy.index')->with('success', 'Potrawa została dodana.');
    }

    public function destroy($id)
    {
        $potrawa = Potrawa::find($id);
        $potrawa->delete();

        return redirect()->route('potrawy.index')->with('success', 'Potrawa została usunięta.');
    }

    public function edit($id)
    {
        $potrawa = Potrawa::find($id);
        return view('edytuj_potrawe')->with('potrawa', $potrawa);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nazwa' => 'required',
            'opis' => 'required',
            'kategoria' => 'required',
        ]);

        $potrawa = Potrawa::find($id);
        $potrawa->nazwa = $request->nazwa;
        $potrawa->opis = $request->opis;
        $potrawa->kategoria = $request->kategoria;
        $potrawa->save();

        return redirect()->route('potrawy.index')->with('success', 'Potrawa została zaktualizowana.');
    }

}


