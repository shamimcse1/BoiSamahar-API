      <x-backend.layouts.master>

          <x-slot name="pageTitle">
              Dashboard
          </x-slot>

          <x-slot name='breadCrumb'>
              <x-backend.layouts.elements.breadcrumb>
                  <x-slot name="pageHeader">  </x-slot>
                  <li class="breadcrumb-item active">Dashboard</li>
              </x-backend.layouts.elements.breadcrumb>
          </x-slot>
          <section class="content">
              <div class="container-fluid">
                  @if (is_null($books) || empty($books))
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
                          <div class="card ">
                              <!-- <div class="card-header">
                                  <a class="btn btn-primary" href={{ route('books.create') }}>Create</a>
                              </div> -->
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <table id="datatablesSimple" class="table table-bordered table-hover">
                                      <thead>
                                          <tr>
                                              <th>SL</th>
                                              <th>Book Name</th>
                                              <th>Category Name</th>
                                              <th>Book Details</th>
                                              <th>Book Download Link</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($books as $book)
                                          <tr>
                                              <td>{{ $loop->iteration }}</td>
                                              <td>{{ $book->name }}</td>
                                              <td>{{ $book->category->name }}</td>
                                              <td>{{ $book->details }}</td>
                                              <td>
                                                  <a href="{{ asset('storage/books/'.$book->download_link) }}" target="_blank">
                                                  {{$book->download_link}}</i>
                                                  </a>
                                              </td>
                                              <td>

                                                  <a class="btn btn-info btn-sm mx-1 my-1" href="{{ route('books.edit', $book->id) }}">Edit</a>
                                                  <a class="btn btn-primary btn-sm mx-1 my-1" href={{ route('books.show', ['book' => $book->id]) }}>Show</a>
                                                  <form action="{{ route('books.destroy', $book->id) }}" method="POST">
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

      <script>
          // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

          $('#reservation').daterangepicker()

          //   Date picker JS
      </script>
      {{-- @endif --}}