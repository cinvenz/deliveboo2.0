@extends('layouts.app')

@section('content')
    <div id="root">
        <user-details :user="{{ $user }}"></user-details>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/front.js') }}" defer></script>
@endsection
