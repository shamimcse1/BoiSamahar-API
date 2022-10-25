<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Category List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Category </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($categories) || empty($categories))
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                    </div>
                </div>
            @else
                @if (session('message'))
                    <div class="alert alert-success">
                        <span class="close" data-dismiss="alert">&times;</span>
                        <strong>{{ session('message') }}.</strong>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary" href={{ route('categories.create') }}>Create</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- category Table goes here --}}

                                <table id="datatablesSimple" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Name</th>
                                            <th>Number of Book</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->books->count() }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm mx-1 my-1"
                                                        href={{ route('categories.edit', ['category' => $category->id]) }}>Edit</a>
                                                    <a class="btn btn-primary btn-sm mx-1 my-1"
                                                        href={{ route('categories.show', ['category' => $category->id]) }}>Show</a>

                                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                        method="POST">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-danger btn-sm mx-1 my-1" type="submit">Delete</button>
                            </form>
                                                  
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    @endif
</x-backend.layouts.master>
