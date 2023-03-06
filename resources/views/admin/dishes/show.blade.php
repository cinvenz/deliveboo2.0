@extends('layouts.app')

@section('content')
    <!-- Styles -->
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">

    <div class="container">
        <div class="card">
            <div class="d-flex">
                <img class="float-start" src="{{ asset('storage/' . $dish->uploaded_img) }}" alt="">
                <div class="card-body">
                    <h1 class="card-title">{{ $dish->dish_name }}</h1>
                    <p class="card-text"><strong>Descrizione:</strong> {{ $dish->description }}</p>
                    <p class="list-group-item"><strong>Ingredienti:</strong> {{ $dish->ingredients }}</p>
            </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Prezzo:</strong> {{ $dish->price }} €</li>
            </ul>
        </div>
    </div>
@endsection
