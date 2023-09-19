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
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <form action="{{ route('admin.users.index') }}" method="POST">
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
                                            <th>Email</th>
                                            <th>email_verified_at</th>
                                            <th>is_admin</th>
                                            <th>Posts's count</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>email_verified_at</th>
                                            <th>is_admin</th>
                                            <th>Posts's count</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td><a href="{{route('admin.users.show', $user)}}">{{$user->name}}</a></td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->email_verified_at}}</td>
                                            <td>{{$user->admin}}</td>
                                            <td>{{ count($user->posts) }}</td>
                                            <td>
                                                <a href="{{route('admin.users.edit', $user)}}" class="btn btn-info btn-sm">Edit</a>
                                                <form action="{{route('admin.users.destroy', $user)}}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $users->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('layouts.footer')
