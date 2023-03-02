@extends('layouts.app')

@section('content')
 <div class="container-fluid">
    @if (session('success_delete'))
        <div class="alert alert-warning" role="alert">
            Il piatto con ID {{ session('success_delete')->id }} è stato eliminato correttamente
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Total Price</th>
                <th scope="col">Date</th>
                <th scope="col">Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->total_price }}€</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->notes }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', ['order' => $order]) }}" class="btn btn-primary">Visita</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $orders->links() }} --}}
 </div>

@endsection
