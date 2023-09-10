@include('layouts.header')
@include('layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('layouts.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary ">DataTables Example</h6>
                        </div>
                        <div class="card-body">

                           <div class="row">
                           <div class="col-6">
                                <a class="btn btn-primary" href="{{route('categories.create')}}">Add new Category</a>
                           </div>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4 float-end">
                                <form action="{{ route('categories.index') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{$search}}">
                                        <button type="submit" class="btn btn-primary">  <i class="fas fa-search fa-fw"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Details</th>
                                            <th>created_at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Details</th>
                                            <th>created_at</th>
                                             <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td>{{ substr($category->details, 0, 50) }}...</td>
                                            <td>{{$category->created_at}}</td>
                                            <td>
                                                <a href="{{route('categories.edit', $category)}}" class="btn btn-info btn-sm">Edit</a>
                                                <form action="{{route('categories.destroy', $category)}}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $categories->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('layouts.footer')
