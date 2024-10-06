<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogowanieController extends Controller
{
public function showLoginForm()
{
return view('logowanie');
}

public function login(Request $request)
{
$credentials = $request->validate([
'email' => 'required|email',
'password' => 'required',
]);

if (Auth::attempt($credentials)) {
// Pomyślne uwierzytelnienie użytkownika
return redirect($this->redirectPath());
}

return back()->withErrors([
'email' => 'Nieprawidłowe dane uwierzytelniające.',
]);
}
public function logout()
{
Auth::logout();
return redirect('/login');
}

protected function redirectPath()
{
// Pobierz zalogowanego użytkownika
$user = Auth::user();

// Sprawdź stanowisko użytkownika i przekieruj na odpowiednią stronę
switch ($user->stanowisko) {
case 'Menadżer':
return route('strona_glowna');
case 'Kelner':
return route('KelnerWidok.show');
case 'Kucharz':
return route('kuchnia');
default:
return '/home'; // domyślna ścieżka, jeśli żadne z powyższych stanowisk nie pasuje
}
}
}
