<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Create Book
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Book </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Book</a></li>
            <li class="breadcrumb-item active">Create Book</li>
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

    <form action="{{ route('books.store') }}" method="post">
        <div>
            @csrf
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Book Name">
            </div>
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" name="category_name" id="category_name"
                    placeholder="Enter Category Name">
            </div>
            <div class="form-group">
                <label for="details">Book Details</label>
                <textarea class="form-control" name="details" id="details" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="download_link">Book Download Link</label>
                <input type="file" class="form-control" name="download_link" id="download_link"
                    placeholder="Enter Book Download Link">
            </div>

            <x-backend.form.button>Save</x-backend.form.button>
        </div>
    </form>



</x-backend.layouts.master>
