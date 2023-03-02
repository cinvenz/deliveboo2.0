@extends('layouts.app')

@section('content')
  <div class="container">
        <div class="card">
            <h2 class="card-header">{{ $order->name }}</h2>
            <div class="card-body">
             <div class="row justify-content-start">
             <div class="col-6">
                <h5>Indirizzo</h5>
             </div>
             <div class="col-6">
                    {{ $order->address }}
             </div>
             <div class="col-6">
                    <h5>Telefono</h5>
             </div>
             <div class="col-6">
                    {{ $order->phone }}
             </div>
             <div class="col-6">
                    <h5>E-mail</h5>
             </div>
             <div class="col-6">
                    {{  $order->email }}
              </div>
             <div class="col-6">
                  <h5>Data Ordine</h5>
             </div>
             <div class="col-6">
                    {{ $order->order_date }}
             </div>
             <div class="col-6">
                  <h5>Prezzo</h5>
             </div>
             <div class="col-6">
                    {{ $order->total_price }}
             </div>
             <div class="col-6">
                    <h5>Note</h5>
             </div>
             <div class="col-6">
                    {{ $order->notes }}
             </div>
             <div class="col-6">
                  <h5>Piatti Ordinati</h5>
              </div>
             <div class="col-6">
                  <ul>
                      @foreach($order->dishes as $dish)
                         <li>{{ $dish->dish_name }}</li>
                     @endforeach
                 </ul>
             </div>

             </div>
            </div>
        </div>
 </div>

@endsection
