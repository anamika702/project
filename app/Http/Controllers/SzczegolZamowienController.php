<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SzczegolZamowien;
use App\Models\Rachunek;

class SzczegolZamowienController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'zamowienie_id' => 'required|exists:zamowienia,id_zamowienia',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menu,id_menu',
            'items.*.ilosc' => 'required|integer|min:1',
            'items.*.status' => 'required|in:gotowe,w trakcie przygotowania,oczekuje,wydane,opłacone',
        ]);

        foreach ($validatedData['items'] as $item) {
            SzczegolZamowien::create([
                'zamowienie_id' => $validatedData['zamowienie_id'],
                'menu_id' => $item['menu_id'],
                'ilosc' => $item['ilosc'],
                'status' => $item['status'],
            ]);
        }

        return redirect()->route('zamowienia.show', $validatedData['zamowienie_id'])->with('success', 'Pozycje zamówienia zostały dodane.');
    }
    public function rachunek()
    {
        return $this->belongsTo(Rachunek::class, 'zamowienie_id', 'id_zamowienia');
    }

    public function update(Request $request, SzczegolZamowien $szczegolZamowien)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:gotowe,w trakcie przygotowania,oczekuje,opłacone',
        ]);

        $szczegolZamowien->update($validatedData);

        return redirect()->back()->with('success', 'Status potrawy został zaktualizowany.');
    }
}
