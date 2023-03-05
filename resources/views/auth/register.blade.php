
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registra il tuo ristoante...') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h3>Campi obbligatori:</h3>
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="p_iva" class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}</label>

                            <div class="col-md-6">
                                <input id="p_iva" type="number" min="10000000000" max="99999999999" class="form-control @error('p_iva') is-invalid @enderror" name="p_iva" value="{{ old('p_iva') }}" required autocomplete="p_iva" autofocus>

                                @error('p_iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- <div class="form-group row mb-3">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                            <div class="col-md-6">
                                <select id="category_id" name="category_id[]" required multiple="multiple" style="width: 250px; height: 150px">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                    @endforeach
                                </select>
                                <p style="font-size: 12px">*Per selezionare più categorie tieni premuto "Ctrl".</p>
                            </div>
                        </div>

                        <h3>Campi facoltativi:</h3> --}}

                        <div class="form-group row mb-3">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                            <div class="col-md-6">
                              @foreach($categories as $category)
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="category_id[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                                  <label class="form-check-label" for="category_{{ $category->id }}">
                                    {{ ucfirst($category->name) }}
                                  </label>
                                </div>
                              @endforeach
                            </div>
                          </div>


                        <div class="form-group row mb-3">
                            <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">{{ __('Nome ristorante') }}</label>

                            <div class="col-md-6">
                                <input id="restaurant_name" type="text" class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" autocomplete="restaurant_name" autofocus>

                                @error('restaurant_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Foto ristorante') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="delivery_cost" class="col-md-4 col-form-label text-md-right">{{ __('Costo spedizione') }}</label>

                            <div class="col-md-6">
                                <input id="delivery_cost" type="number" step=".01" class="form-control @error('delivery_cost') is-invalid @enderror" name="delivery_cost" value="{{ old('delivery_cost') }}" autocomplete="delivery_cost" autofocus>

                                @error('delivery_cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="opening_hours" class="col-md-4 col-form-label text-md-right">{{ __('Orario apertura') }}</label>

                            <div class="col-md-6">
                                <input id="opening_hours" type="time" class="form-control @error('opening_hours') is-invalid @enderror" name="opening_hours" value="{{ old('opening_hours') }}" autocomplete="opening_hours" autofocus>

                                @error('opening_hours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="closing_hours" class="col-md-4 col-form-label text-md-right">{{ __('Orario chiusura') }}</label>

                            <div class="col-md-6">
                                <input id="closing_hours" type="time" class="form-control @error('closing_hours') is-invalid @enderror" name="closing_hours" value="{{ old('closing_hours') }}" autocomplete="closing_hours" autofocus>

                                @error('closing_hours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
