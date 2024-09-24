@extends('layout')

@section('content')
    <h1>Résultats de recherche</h1>
    <form action="{{ route('vulnerable.search') }}" method="GET">
        <input type="text" name="username" placeholder="Nom d'utilisateur">
        <button type="submit">Recherche Vulnérable</button>
    </form>
    <form action="{{ route('safe.search') }}" method="GET">
        <input type="text" name="username" placeholder="Nom d'utilisateur">
        <button type="submit">Recherche Sécurisée</button>
    </form>
    @if(isset($users))
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }} ({{ $user->email }})</li>
            @endforeach
        </ul>
    @endif
@endsection
