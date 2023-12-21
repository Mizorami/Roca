@extends('templates.app')


@section('css')
    @vite(['resources/css/chapitreDetails.css'])
@append

@section('content')

    <!DOCTYPE html>
    <html>

    <head>
        <title>Chapitre - {{ $chapitre->titre }}</title>
        <!-- Inclure vos styles CSS ou liens nécessaires -->
    </head>

    <body>

        <div class="ambi-light">
            @if ($chapitre->media)
                @if (pathinfo($chapitre->media, PATHINFO_EXTENSION) === 'jpg' ||
                        pathinfo($chapitre->media, PATHINFO_EXTENSION) === 'jpeg' ||
                        pathinfo($chapitre->media, PATHINFO_EXTENSION) === 'png')
                    <img src="{{ $chapitre->media }}" alt="Image du chapitre">
                @else
                    <img src="{{ $chapitre->media }}" alt="Image du chapitre">
                @endif
            @endif
        </div>
        <p>Fin de l'histoire</p>
    @auth
        <form method="POST" action="{{ route('ajouterAvis') }}">
            @csrf
            <input type="hidden" name="histoire_id" value="{{ $chapitre->histoire->id }}">
            <textarea name="contenu" placeholder="Votre commentaire ici"></textarea>
            <button type="submit">Ajouter un commentaire</button>
        </form>
    @endauth
    <h3>Avis sur cette histoire :</h3>
    <ul>
        @foreach($chapitre->histoire->avis as $avis)
            <li>
                <p>Utilisateur : <button><a href="{{ route('user.show', $avis->user->id) }}">{{ $avis->user->name }}</a></button></p>

                <p>Commentaire : {{ $avis->contenu }}</p>
                <!-- Ajoutez d'autres détails de l'avis au besoin -->
            </li>
        @endforeach
    </ul>

        <div class="card">
            @if ($chapitre->media)
                @if (pathinfo($chapitre->media, PATHINFO_EXTENSION) === 'jpg' ||
                        pathinfo($chapitre->media, PATHINFO_EXTENSION) === 'jpeg' ||
                        pathinfo($chapitre->media, PATHINFO_EXTENSION) === 'png')
                    <div class="cover">
                        <img src="{{ $chapitre->media }}" alt="Image du chapitre">
                    </div>
                @else
                    <div class="cover">
                        <img src="{{ $chapitre->media }}" alt="Image du chapitre">
                    </div>
                @endif
            @endif
            
            
            <h1>{{ $chapitre->titrecourt }}</h1>
            <h1>{{ $chapitre->titre }}</h1>
            <p>{{ $chapitre->texte }}</p>
            
             @if ($chapitre->question)
                <p>{{ $chapitre->question }}</p>
                <!-- Affichage des choix sous forme de boutons -->
                <div class="choices">
                    @foreach ($chapitre->suivants as $suivant)
                        <form method="POST" action="{{ route('makeChoice') }}">
                            @csrf
                            <input type="hidden" name="chapitre_id" value="{{ $chapitre->id }}">
                            <input type="hidden" name="reponse" value="{{ $suivant->id }}">
                            <button type="submit" class="submit">{{ $suivant->titrecourt }}</button>
                        </form>
                    @endforeach
                </div>
            <p>L'histoire est terminée</p>
            <div class="container-cta-end">
                <a class="submit submit-primary" href='{{ route('index') }}'>Retourner à l'accueil</a>
            </div>


            
{{-- page de fin, cta recommencer, cta aller acceuil --}} 

        @endif
        </div>

    </body>

    </html>
@endsection
