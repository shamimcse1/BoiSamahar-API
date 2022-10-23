<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Create Category
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Category </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>
            <li class="breadcrumb-item active">Create Category</li>
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
    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        <div>
            @csrf

            <x-backend.form.input name="name" type="text" label="Name" />

            <x-backend.form.button>Save</x-backend.form.button>
        </div>
    </form>

</x-backend.layouts.master>
