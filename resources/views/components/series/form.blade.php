<form action="{{ $action }}" method="post">
    @csrf

    @isset($update)
        @method('PUT')
    @endisset
    <div class="mb-3">
    <label for="name">Name</label>
    <input type="name" id="name" name="name" @isset($name) value="{{ $name }}" @endisset>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
