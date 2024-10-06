<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PracownikController extends Controller
{
    public function index()
    {
        $pracownicy = User::all();
        return view('pracownicy', compact('pracownicy'));
    }

    public function create()
    {
        return view('pracownicyCreate');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'imie' => 'required',
            'nazwisko' => 'required',
            'stanowisko' => 'required',
            'email' => 'required|email',
            'numer_telefonu' => 'required',
            'password' => 'required',
        ]);

        $pracownik = new User();
        $pracownik->imie = $request->imie;
        $pracownik->nazwisko = $request->nazwisko;
        $pracownik->stanowisko = $request->stanowisko;
        $pracownik->email = $request->email;
        $pracownik->numer_telefonu = $request->numer_telefonu;
        $pracownik->password = bcrypt($request->password); // hashowanie hasła
        $pracownik->inne_informacje = $request->inne_informacje;
        $pracownik->save();

        return redirect()->route('pracownicy.index')->with('success', 'Pracownik został dodany.');
    }

    public function edit(User $pracownik)
    {
        return view('pracownicyEdit', compact('pracownik'));
    }

    public function update(Request $request, User $pracownik)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'imie' => 'required',
            'nazwisko' => 'required',
            'stanowisko' => 'required',
            'email' => 'required|email',
            'numer_telefonu' => 'required',
            'password' => 'nullable',
            'inne_informacje' => 'nullable',
        ]);

        // Update the attributes of the pracownik object based on the form data
        $pracownik->imie = $validatedData['imie'];
        $pracownik->nazwisko = $validatedData['nazwisko'];
        $pracownik->stanowisko = $validatedData['stanowisko'];
        $pracownik->email = $validatedData['email'];
        $pracownik->numer_telefonu = $validatedData['numer_telefonu'];

        // Check if the 'haslo' field is present and not empty in the request
        if ($request->filled('password')) {
            $pracownik->password = Hash::make($validatedData['password']);

        }
        $pracownik->inne_informacje = $validatedData['inne_informacje'];

        // Save the updated pracownik object
        $pracownik->save();

        // Redirect to the desired page
        return redirect()->route('pracownicy.index')->with('success', 'Dane pracownika zostaly zaktualizowane.');
    }

    public function destroy(User $pracownik)
    {
        // Delete the pracownik object
        $pracownik->delete();

        // Redirect to the desired page
        return redirect()->route('pracownicy.index')->with('success', 'User zostal usuniety.');
    }


}
