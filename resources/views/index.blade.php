<div>
    <form action="{{ route('link.store') }}" method="POST">
        @csrf
        <label for="original_url">
            Original URL
            <input type="url" id="original_url" name="original_url" required>
        </label>
        <button type="submit">Shorten</button>
    </form>
</div>
