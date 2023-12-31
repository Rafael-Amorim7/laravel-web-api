<x-layout title="Create Serie">
    <form action="{{ route('series.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" type="name" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="col-2">
                <label class="form-label" for="seasons">Seassons</label>
                <input class="form-control" type="name" id="seasons" name="seasons" value="{{ old('seasons') }}">
            </div>

            <div class="col-2">
                <label for="episodes" class="form-label">Episodes per season</label>
                <input type="name" class="form-control" id="episodes" name="episodes" value="{{ old('episodes') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label">Capa</label>
                <input type="file"
                       id="cover"
                       name="cover"
                       class="form-control"
                       accept="image/gif, image/jpeg, image/png">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
</form>

</x-layout>
