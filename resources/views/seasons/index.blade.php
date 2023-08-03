<x-layout title="Seasons of {!! $series->name !!}">
    @isset($mensagem)
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
    @endisset
    <ul>
        @foreach ($seasons as $season)
            <li> <a href="{{ route('episodes.index', $season->id) }}">Temporada {{ $season->number }} </a> - Episodes {{ $season->episodes->watched()->count() }} {{ $season->episodes->count() }} </li>
        @endforeach
    </ul>

    <script>
        const seasons = {{ Js::from($seasons) }};
    </script>
</x-layout>
