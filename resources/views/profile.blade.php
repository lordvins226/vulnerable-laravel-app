@extends('layout')

@section('content')
    <h1>Profil</h1>
    @if(isset($user))
        <form action="{{ route('vulnerable.update') }}" method="POST">
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="text" name="name" value="{{ $user->name }}">
            <input type="text" name="name" value="{{ $user->email }}" readonly disabled>
            <button type="submit">Mettre à jour (Vulnérable au CSRF)</button>
        </form>

        {{--        <form action="{{ route('safe.update') }}" method="POST">--}}
        {{--            @csrf--}}
        {{--            <input type="hidden" name="id" value="{{ $user->id }}">--}}
        {{--            <input type="text" name="name" value="{{ $user->name }}">--}}
        {{--            <button type="submit">Mettre à jour (Protégé contre CSRF)</button>--}}
        {{--        </form>--}}

        <h2>Ajouter une carte de crédit</h2>
        <form action="{{ route('vulnerable.addCreditCard') }}" method="POST">
            <input type="text" name="credit_card" placeholder="Numéro de carte">
            <button type="submit">Ajouter</button>
        </form>

        {{--        <form action="{{ route('safe.addCreditCard') }}" method="POST">--}}
        {{--            @csrf--}}
        {{--            <input type="text" name="credit_card" placeholder="Numéro de carte">--}}
        {{--            <button type="submit">Ajouter (Chiffré)</button>--}}
        {{--        </form>--}}
    @endif
@endsection
