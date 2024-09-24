@extends('layout')

@section('content')
    <h1>Commentaires</h1>
    <form action="{{ route('vulnerable.comment') }}" method="POST">
        @csrf
        <textarea name="content" placeholder="Votre commentaire"></textarea>
        <button type="submit">Ajouter un commentaire</button>
    </form>
    @if(isset($comments))
        <h2>Affichage vulnérable (XSS possible) :</h2>
        <ul>
            @foreach($comments as $comment)
                <li>{!! $comment->content !!}</li>
            @endforeach
        </ul>

{{--        <h2>Affichage sécurisé :</h2>--}}
{{--        <ul>--}}
{{--            @foreach($comments as $comment)--}}
{{--                <li>{{ $comment->content }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
    @endif
@endsection
