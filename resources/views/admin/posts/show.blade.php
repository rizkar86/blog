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
                           <div class="float-end mb-4">
                            <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Add new Post</a>
                            <a class="btn btn-success" href="{{route('admin.posts.edit', $post->id)}}">update the post</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete the post</button>
                            </form>
                           </div>

                            <div class="row" >
                                    <!-- Page Header-->

                                    <!-- Post Content-->
                                    <article class="mb-4">
                                        <div class="container px-4 px-lg-5">
                                            <div class="row gx-4 gx-lg-5 justify-content-center">
                                                <div class="col-md-10 col-lg-8 col-xl-7 mb-4">
                                                    <img src="{{ asset('img/' . $post->image) }}" class="img-fluid rounded" alt="..." style="height: 500px;" />
                                                </div>
                                                <div class="col-md-10 col-lg-8 col-xl-7">
                                                    <h1 class="display-5 fw-bolder">{{$post->title}}</h1>
                                                    <p class="lead fw-normal">{{$post->description}}</p>
                                                    <p>{{$post->created_at->format('d-m-Y')}}</p>
                                                    <p>
                                                        @foreach ($post->categories as $category)
                                                            <span class="btn btn-outline-secondary">{{$category->name}}</span>
                                                        @endforeach
                                                    </p>
                                                    {!! $post->content !!}
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('layouts.footer')
