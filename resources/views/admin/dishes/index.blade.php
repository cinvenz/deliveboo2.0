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
                <th scope="col">Slug</th>
                <th scope="col">Nome piatto</th>
                <th scope="col">Ingredienti</th>
                <th scope="col">Prezzo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dishes as $dish)
                <tr>
                    <th scope="row">{{ $dish->id }}</th>
                    <td>{{ $dish->slug}}</td>
                    <td>{{ $dish->dish_name }}</td>
                    <td>{{ $dish->ingredients }}</td>
                    <td>{{ $dish->price }}€</td>
                    <td>
                        <a href="{{ route('admin.dishes.show', ['dish' => $dish]) }}" class="btn btn-primary">Visita</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.dishes.edit', ['dish' => $dish]) }}" class="btn btn-warning">Edita</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.dishes.destroy', ['dish' => $dish]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-delete-me">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $dishes->links() }}

</div>


@endsection
