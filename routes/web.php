<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PotrawyController;
use App\Http\Controllers\StolikController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PracownikController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ZamowienieController;
use App\Http\Controllers\SzczegolZamowienController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\KelnerWidokController;
use App\Http\Controllers\RezerwacjeController;
use App\Http\Controllers\RachunekController;
use App\Http\Controllers\Strona_glownaController;
use App\Http\Controllers\LogowanieController;
use App\Http\Controllers\KelnerRaportController;
use App\Http\Controllers\MenadzerRaportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/logowanie', function () { return view('logowanie');
    })->name('logowanie');

    Route::get('/strona_glowna', [Strona_glownaController::class, 'index'])->name('strona_glowna');


    Route::get('/login', [LogowanieController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LogowanieController::class, 'login'])->name('login.post');
    Route::post('/logout', [LogowanieController::class, 'logout'])->name('logout');

    Route::get('/pracownicy', [PracownikController::class, 'index'])->name('pracownicy.index');
    Route::get('/pracownicy/create', [PracownikController::class, 'create'])->name('pracownicyCreate');
    Route::post('/pracownicy', [PracownikController::class, 'store'])->name('pracownicy.store');
    Route::get('/pracownicy/{pracownik}/edit', [PracownikController::class, 'edit'])->name('pracownicyEdit');
    Route::put('/pracownicy/{pracownik}', [PracownikController::class, 'update'])->name('pracownicy.update');
    Route::delete('/pracownicy/{pracownik}', [PracownikController::class, 'destroy'])->name('pracownicy.destroy');

    Route::get('/potrawy', [PotrawyController::class, 'index'])->name('potrawy.index');
    Route::post('/potrawy', [PotrawyController::class, 'store'])->name('potrawy.store');
    Route::delete('/potrawy/{potrawa}', [PotrawyController::class, 'destroy'])->name('potrawy.destroy');
    Route::get('/potrawy/{potrawa}/edit', [PotrawyController::class, 'edit'])->name('potrawy.edit');
    Route::put('/potrawy/{potrawa}', [PotrawyController::class, 'update'])->name('potrawy.update');
    Route::get('/dodawanie-potraw', function () { return view('dodawanie_potraw'); })->name('dodawanie_potraw');

    Route::get('/stoliki', [StolikController::class, 'show'])->name('stoliki.show');
    Route::post('/dodaj_stolik', [StolikController::class, 'store']);
    Route::delete('/usun_stolik/{id}', [StolikController::class, 'destroy'])->name('usun_stolik.destroy');
    Route::get('/edytuj_stolik/{id}', [StolikController::class, 'edit'])->name('edytuj_stolik');
    Route::put('/aktualizuj_stolik/{id}', [StolikController::class, 'update'])->name('aktualizuj_stolik');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/dodawanie_menu', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::get('menu/{menu}/edycja_menu_kucharz', [MenuController::class, 'editKucharz'])->name('menu.edit-kucharz');
    Route::put('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
    Route::get('menu/{menu}/edycja_menu_menedzer', [MenuController::class, 'editMenedzer'])->name('menu.edit-menedzer');

    Route::get('/kelnerwidok', [KelnerWidokController::class, 'show'])->name('KelnerWidok.show');

    Route::get('/grafik', [GrafikController::class, 'index'])->name('grafik');
    Route::get('/grafik/create', [GrafikController::class, 'create'])->name('grafik.create');
    Route::post('/grafik', [GrafikController::class, 'store'])->name('grafik.store');
    Route::delete('/grafik/{grafik}', [GrafikController::class, 'destroy'])->name('grafik.destroy');
    Route::get('/grafik/{grafik}/edit', [GrafikController::class, 'edit'])->name('grafik.edit');
    Route::put('/grafik/{grafik}', [GrafikController::class, 'update'])->name('grafik.update');

    Route::get('/zamowienia', [ZamowienieController::class, 'index'])->name('zamowienia.index');
    Route::get('/zamowienia/create', [ZamowienieController::class, 'create'])->name('zamowienia.create');
    Route::post('/zamowienia', [ZamowienieController::class, 'store'])->name('zamowienia.store');
    Route::get('/zamowienia/{zamowienie}/edit', [ZamowienieController::class, 'edit'])->name('zamowieniaEdit');
    Route::put('/zamowienia/{zamowienie}', [ZamowienieController::class, 'update'])->name('zamowienia.update');
    Route::delete('/zamowienia/{zamowienie}', [ZamowienieController::class, 'destroy'])->name('zamowienia.destroy');

    Route::post('/zamowienia/{zamowienie}/szczegoly', [SzczegolZamowienController::class, 'store'])->name('szczegoly.store');

    Route::get('/stoliki', [StolikController::class, 'show'])->name('stoliki.show');
    Route::post('/dodaj_stolik', [StolikController::class, 'store']);
    Route::delete('/usun_stolik/{id}', [StolikController::class, 'destroy'])->name('usun_stolik.destroy');
    Route::get('/edytuj_stolik/{id}', [StolikController::class, 'edit'])->name('edytuj_stolik');
    Route::put('/aktualizuj_stolik/{id}', [StolikController::class, 'update'])->name('aktualizuj_stolik');

    Route::get('/rezerwacje', [RezerwacjeController::class, 'index'])->name('rezerwacje.index');
    Route::get('/rezerwacje/dodawanie', [RezerwacjeController::class, 'create'])->name('rezerwacje.create');
    Route::post('/rezerwacje', [RezerwacjeController::class, 'store'])->name('rezerwacje.store');
    Route::get('/rezerwacje/{id}/edytowanie', [RezerwacjeController::class, 'edit'])->name('rezerwacje.edit');
    Route::put('/rezerwacje/{id}', [RezerwacjeController::class, 'update'])->name('rezerwacje.update');
    Route::delete('/rezerwacje/{id}', [RezerwacjeController::class, 'destroy'])->name('rezerwacje.destroy');


    Route::put('/szczegolZamowien/{szczegolZamowien}', [SzczegolZamowienController::class, 'update'])->name('szczegolZamowien.update');

    Route::get('/kuchnia', [ZamowienieController::class, 'kuchnia'])->name('kuchnia');

    Route::get('/rachunek/{id}', [RachunekController::class, 'showRachunek'])->name('rachunek.show');
    Route::post('/rachunek/{id}/create', [RachunekController::class, 'createRachunek'])->name('rachunek.create');
    Route::get('/rachunki', [RachunekController::class, 'wyswietlRachunki']);
    Route::get('/rachunki', [RachunekController::class, 'wyswietlRachunki'])->name('rachunek.wyswietl');

    Route::get('/raport/kelner', [KelnerRaportController::class, 'index'])->name('raport.kelner');
    Route::get('/raport/kelner/create', [KelnerRaportController::class, 'create'])->name('raport_kelner.create');
    Route::post('/raport/kelner', [KelnerRaportController::class, 'store'])->name('raport_kelner.store');

    Route::get('/raport/menadzer', [MenadzerRaportController::class, 'index'])->name('raport.menadzer');
    Route::get('/raport/menadzer/make', [MenadzerRaportController::class, 'make'])->name('raport.menadzer.make');
    Route::post('/raport/menadzer', [MenadzerRaportController::class, 'store'])->name('raport.store');
    Route::post('/raport/calculate-income', [MenadzerRaportController::class, 'calculateIncome'])->name('raport.calculateIncome');
