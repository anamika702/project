<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Potrawa;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');

        if ($sort === 'dostepne') {
            $menuItems = Menu::where('dostepnosc', true)->get();
        } elseif ($sort === 'niedostepne') {
            $menuItems = Menu::where('dostepnosc', false)->get();
        } else {
            $menuItems = Menu::all();
        }

        return view('menu', compact('menuItems'));
    }



    public function create()
    {
        $potrawy = Potrawa::all();

        return view('dodawanie_menu', compact('potrawy'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_potrawa' => 'required|exists:potrawy,id_potrawy',
            'cena' => 'required|numeric',
            'dostepnosc' => 'required|boolean',
        ]);

        $data = [
            'id_potrawa' => $request->input('potrawa'),
            'cena' => $request->input('cena'),
            'dostepnosc' => $request->input('dostepnosc'),
        ];

        Menu::create($data);

        return redirect()->route('menu.index')->with('success', 'Menu item created successfully.');
    }

    public function editKucharz(Menu $menu)
    {
        return view('edycja_menu_kucharz', compact('menu'));
    }

    public function editMenedzer(Menu $menu)
    {
        return view('edycja_menu_menedzer', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'dostepnosc' => 'required|boolean',
        ]);

        $menu->update($request->all());

        return redirect()->route('menu.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully.');
    }


}
