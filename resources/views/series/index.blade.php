<x-layout title="Series">
    <a href="{{ route('series.create') }}">Create</a>
    @isset($mensagem)
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
    @endisset
    <ul>
        @foreach ($series as $serie)
            <a href="{{ route('series.edit', $serie->id) }}">Edit</a>
            <a href="{{ route('seasons.index', $serie->id) }}"> {{ $serie->name }} </a>
            <form method="POST" action="{{ route('series.destroy', $serie->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">X</button>
            </form>
        @endforeach
    </ul>

    <script>
        const series = {{ Js::from($series) }};
    </script>
</x-layout>
