<div>
    <form action="{{ route('link.store') }}" method="POST">
        @csrf
        <label for="original_url">
            Original URL
            <input type="url" id="original_url" name="original_url" required>
        </label>
        <button type="submit">Shorten</button>
    </form>

    @if (session('original_url') && session('shortened_url'))
        <div>
            <p>{{ session('original_url') }} -> <a href="{{ session('shortened_url') }}" target="_blank">{{ session('shortened_url') }}</a></p>
        </div>
    @endif
</div>
