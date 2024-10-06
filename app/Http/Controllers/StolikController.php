<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stolik;
use App\Models\Rezerwacje;

class StolikController extends Controller
{
    public function show()
    {
        $stoliki = Stolik::all();

        foreach ($stoliki as $stolik) {
            $rezerwacje = Rezerwacje::where('ID_stolika', $stolik->ID_stolika)
                ->where('Status_rezerwacji', 'Potwierdzona')
                ->get();

            if ($rezerwacje->isEmpty()) {
                $stolik->Status_rezerwacji = 'Brak';
            } else {
                $stolik->Status_rezerwacji = 'Zarezerwowany';
            }

            $stolik->save();
        }

        return view('stoliki', compact('stoliki'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numer_stolika' => 'required|integer',
            'ilosc_miejsc' => 'required|integer',
            'status_stolika' => 'nullable|string',
        ]);


        $stolik = new Stolik;
        $stolik->Numer_stolika = $validatedData['numer_stolika'];
        $stolik->Ilosc_miejsc = $validatedData['ilosc_miejsc'];
        $stolik->Status_stolika = $validatedData['status_stolika'];
        $stolik->save();

        return redirect('/stoliki');
    }

    public function destroy($id)
    {
        $stolik = Stolik::findOrFail($id);
        $stolik->delete();

        return redirect()->route('stoliki.show');
    }

    public function edit($id)
    {
        $stolik = Stolik::findOrFail($id);
        return view('edytuj_stolik', compact('stolik'));
    }

    public function update(Request $request, $id)
    {
        $stolik = Stolik::findOrFail($id);
        $stolik->Numer_stolika = $request->numer_stolika;
        $stolik->Ilosc_miejsc = $request->ilosc_miejsc;
        $stolik->Status_stolika = $request->status_stolika;
        $stolik->save();

        return redirect()->route('stoliki.show');
    }
}

