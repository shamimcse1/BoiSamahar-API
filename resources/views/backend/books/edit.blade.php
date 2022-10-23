<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Book
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Book </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Book</a></li>
            <li class="breadcrumb-item active">Edit Book</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            <span class="close" data-dismiss="alert">&times;</span>
            <strong>{{ session('message') }}.</strong>
        </div>
    @endif

    <form action="{{ route('books.update', ['book' => $book->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div>
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Book Name"
                    value="{{ $book->name }}">
            </div>
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <select class="form-control" name="category_id" id="category_name">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="details">Book Details</label>
                <textarea class="form-control" name="details" id="details" rows="3">{{ $book->details }}</textarea>
            </div>
            <div class="form-group">
                <label for="download_link">Book Download Link</label>
                <input type="file" class="form-control" name="download_link" id="download_link"
                    placeholder="Enter Book Download Link" value="{{ $book->download_link }}">
            </div>

            <x-backend.form.button>Save</x-backend.form.button>
        </div>
    </form>

</x-backend.layouts.master>
