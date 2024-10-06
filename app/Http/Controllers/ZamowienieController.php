<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zamowienie;
use App\Models\SzczegolZamowien;
use App\Models\Stolik;
use App\Models\User;
use App\Models\Menu;
use App\Models\Potrawa;


class ZamowienieController extends Controller
{
    public function index()
    {
        $zamowienia = Zamowienie::with('szczegoly')->get();
        $potrawy = Potrawa::has('menu')->get();
        return view('zamowienia', compact('zamowienia', 'potrawy'));
    }

    public function create()
    {
        return view('zamowienia.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'stolik_id' => 'required|exists:stoliki,ID_stolika',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menu,id_menu',
            'items.*.ilosc' => 'required|integer|min:1',
        ]);

        $zamowienie = new Zamowienie();
        $zamowienie->pracownik_id = auth()->user()->id;
        $zamowienie->stolik_id = $validatedData['stolik_id'];
        $zamowienie->save();

        foreach ($validatedData['items'] as $item) {
            SzczegolZamowien::create([
                'zamowienie_id' => $zamowienie->id_zamowienia,
                'menu_id' => $item['menu_id'],
                'ilosc' => $item['ilosc'],
                'status' => 'oczekuje',
            ]);
        }

        return redirect()->route('zamowienia.index')->with('success', 'Zamówienie zostało utworzone.');
    }

    public function edit(Zamowienie $zamowienie)
    {
        $pracownicy = User::all();
        $stoliki = Stolik::all();
        $menuItems = Menu::all();
        $potrawy = Potrawa::all();

        return view('zamowieniaEdit', compact('zamowienie', 'pracownicy', 'stoliki', 'menuItems', 'potrawy')); // dodaj 'potrawy' tutaj
    }

    public function update(Request $request, Zamowienie $zamowienie)
    {
        $validatedData = $request->validate([
            'pracownik_id' => 'required|exists:pracownik,id',
            'stolik_id' => 'required|exists:stoliki,ID_stolika',
            'items.*.id_szczegoly' => 'exists:szczegoly_zamowien,id_szczegoly',
            'items.*.menu_id' => 'required|exists:menu,id_menu',
            'items.*.ilosc' => 'required|integer',
            'items.*.status' => 'required|in:gotowe,w trakcie przygotowania,oczekuje,wydane',
        ]);

        $ids = collect($validatedData['items'])->pluck('id_szczegoly')->filter()->all();
        $zamowienie->szczegoly()->whereNotIn('id_szczegoly', $ids)->delete();

        $zamowienie->update([
            'pracownik_id' => $validatedData['pracownik_id'],
            'stolik_id' => $validatedData['stolik_id'],
        ]);

        foreach ($validatedData['items'] as $item) {
            $szczegol = $zamowienie->szczegoly->where('id_szczegoly', $item['id_szczegoly'])->first();
            if ($szczegol) {
                $szczegol->update($item);
            } else {
                $zamowienie->szczegoly()->create($item);
            }
        }

        // Sprawdź czy zamówienie zostało oznaczone jako opłacone
        if ($request->has('czyOplacone')) {
            $zamowienie->czyOplacone = true;
            $zamowienie->save();
        }

        return redirect()->route('zamowienia.index')->with('success', 'Zamówienie zostało zaktualizowane.');
    }


    public function destroy(Zamowienie $zamowienie)
    {
        $zamowienie->delete();

        return redirect()->route('zamowienia.index')->with('success', 'Zamówienie zostało usunięte.');
    }

    public function show(Zamowienie $zamowienie)
    {
        return view('zamowienia.show', compact('zamowienie'));
    }

        public function kuchnia() {
        $szczegoly = SzczegolZamowien::with('zamowienie', 'menu.potrawa')->get();
        return view('kuchnia', ['szczegoly' => $szczegoly]);
    }



}
