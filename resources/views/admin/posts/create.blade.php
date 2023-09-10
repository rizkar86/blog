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
                            <h6 class="m-0 font-weight-bold text-primary ">Create Post</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.posts.store') }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <select name="users[]"  class="selectpicker form-control" multiple aria-label="size 3 select example" data-placeholder="Choose users">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <select name="categories[]"  class="selectpicker form-control" data-placeholder="Choose Categories" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Post Title</label>
                                    <input type="text" class="form-control" name="title" id="exampleFormControlTextarea1" />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Post Image</label>
                                    <input type="file" class="form-control" name="image" id="exampleFormControlTextarea1" />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">short Content</label>
                                    <textarea class="form-control" name="short_content" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                                    <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="20"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">add</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('layouts.footer')
