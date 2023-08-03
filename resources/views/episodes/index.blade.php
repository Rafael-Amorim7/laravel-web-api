<x-layout title="Episodes">
    @isset($mensagem)
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
    @endisset
    <form method="POST">
    @csrf
    <ul>
        @foreach ($episodes as $episode)
            <li>
                Episode {{ $episode->number }}
                <input type="checkbox" name="episodes[]" value="{{ $episode->id }}"
                @if ($episode->watched) checked @endif />
            </li>
        @endforeach
    </ul>
    <button type="submit">Salvar</button>
    </form>

    <script>
        const episodes = {{ Js::from($episodes) }};
    </script>
</x-layout>
