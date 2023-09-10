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
                            <h6 class="m-0 font-weight-bold text-primary ">Create Category</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="name">{{$user->name}}</label>
                                <label for="email">{{$user->email}}</label>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="admin" type="checkbox" id="flexSwitchCheckDefault"  @if ($user->admin == 1) checked @endif>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Admin</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">update</button>

                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('layouts.footer')
