<form action="{{ $action }}" method="POST">
    @csrf
    @isset($update)
        @method('PUT')
    @endisset
    <label for="name">Name</label>
    <input type="name" id="name" name="name" @isset($name) value="{{ $name }}" @endisset>
    <button type="submit">Create</button>
</form>
