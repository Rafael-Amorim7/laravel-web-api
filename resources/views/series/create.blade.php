<x-layout title="Create Serie">
    <form action="{{ route('series.store') }}" method="POST">
    @csrf
    <label for="name">Name</label>
    <input type="name" id="name" name="name" value="{{ old('name') }}">

    <label for="seasons">Seassons</label>
    <input type="name" id="seasons" name="seasons" value="{{ old('seasons') }}">

    <label for="episodes">episodes</label>
    <input type="name" id="episodes" name="episodes" value="{{ old('episodes') }}">

    <button type="submit">Create</button>
</form>

</x-layout>
