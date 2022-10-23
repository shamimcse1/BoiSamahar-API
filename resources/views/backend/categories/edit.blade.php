<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Category Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Category </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>
            <li class="breadcrumb-item active">Edit Category Information</li>
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
    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post"
        enctype="multipart/form-data">
        <div>
            @csrf
            @method('put')
            <x-backend.form.input name="name" type="text" label="Name" :value="$category->name" />
            <br>

            <x-backend.form.button>Save</x-backend.form.button>
        </div>
    </form>


</x-backend.layouts.master>
