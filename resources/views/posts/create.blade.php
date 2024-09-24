@extends('layout')

@section('content')
    <h1>Créer un nouveau post</h1>
    <form action="{{ route('vulnerable.createPost') }}" method="POST">
        <input type="text" name="title" placeholder="Titre">
        <textarea name="content" placeholder="Contenu"></textarea>
        <button type="submit">Créer (Sans validation)</button>
    </form>

{{--    <form action="{{ route('safe.createPost') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <input type="text" name="title" placeholder="Titre">--}}
{{--        <textarea name="content" placeholder="Contenu"></textarea>--}}
{{--        <button type="submit">Créer (Avec validation)</button>--}}
{{--    </form>--}}
@endsection
