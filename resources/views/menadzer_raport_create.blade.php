@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tworzenie raportu miesięcznego</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('raport.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Data utworzenia raportu</label>

                                <div class="col-md-6">
                                    <input id="data_raportu" type="date" class="form-control" name="data_raportu" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required readonly>

                                    @error('data_raportu')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Miesiąc raportu</label>

                                <div class="col-md-6">
                                    <div class="form-control" readonly>{{ \Carbon\Carbon::now()->locale('pl')->isoFormat('MMMM') }} </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Dochód</label>

                                <div class="col-md-6">
                                    <input id="dochod" type="number" class="form-control" name="dochod" value="{{ $dochod }}" required readonly>

                                    @error('dochod')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dodaj">
                                        Dodaj raport
                                    </button>
                                    <a href="{{ route('raport.menadzer') }}" class="btn btn-anuluj">Anuluj</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
