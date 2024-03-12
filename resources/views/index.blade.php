@include('layouts.header')

<div class="container shadow-sm p-3 bg-white rounded-3">
    <form action="{{ route('link.store') }}" method="POST">
        @csrf
        <div class="mb-3 d-flex flex-column align-items-start">
            <label for="original_url" class="form-label mt-3">Original URL *</label>
            <input type="url" id="original_url" name="original_url" required class="form-control">

            <label for="redirect_limit" class="form-label mt-3">Redirect limit (optional)</label>
            <input type="number" id="redirect_limit" name="redirect_limit" class="form-control">

            <label for="expiration_hours" class="form-label mt-3">Expiration Time in Hours (Up to 24)</label>
            <input type="number" id="expiration_hours" name="expiration_hours" min="1" max="24" class="form-control">
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-100">Shorten</button>
        </div>
    </form>


    @if (session('original_url') && session('shortened_url'))

        <button type="button" class="btn btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
            See shortened URL
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Shortened URL</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="{{ session('shortened_url') }}" target="_blank" class="text-blue-500 hover:text-blue-700">{{ session('shortened_url') }}</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@include('layouts.footer')
