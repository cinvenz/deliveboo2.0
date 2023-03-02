@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $dish->dish_name }}</h1>
        <img src="{{ $dish->image }}" alt="" class="img-fluid">
        <img class="float-start" src="{{ asset('storage/' . $dish->uploaded_img) }}" alt="">
        <div class="row">
            <div class="col">
                <h2>Descrizione</h2>
                <p>
                    {{ $dish->description }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h3>Ingredienti</h3>
                <p>
                    {{ $dish->ingredients }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4>Prezzo</h4>
                <p>
                    {{ $dish->price }} €
                </p>
            </div>
        </div>

    </div>

@endsection
