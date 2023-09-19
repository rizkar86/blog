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
                            <h6 class="m-0 font-weight-bold text-primary ">Category: {{$category->name}}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row" id="posts-container" >
                                @foreach($posts as $post)
                                    <div class="col-lg-3 mb-3 d-flex align-items-stretch">
                                        <div class="card">
                                            <img src="{{ asset('img/' . $post->image) }}" class="card-img-top" alt="..." style="height: 300px;">
                                           <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{$post->title}}</h5>
                                            <p class="card-text mb-4 ">Posted on {{$post->created_at->format('d-m-Y')}}</p>
                                            <p class="card-text mb-4">
                                                Posted by:
                                                @foreach ($post->users as $user)
                                                    <a class="link-opacity-75-hover " href="{{route('admin.users.show',$user)}}" data-user-id="{{$user->id}}">{{$user->name}}</a> ,
                                                @endforeach
                                            <br>
                                                Categories:
                                                @foreach ($post->categories as $category)
                                                    <a class="link-opacity-75-hover " href="{{route('categories.show',$category)}}"  data-category-id="{{$category->id}}">{{$category->name}}</a> ,
                                                @endforeach
                                            </p>
                                            <p class="card-text mb-4">{{$post->short_content}}</p>
                                           <div class="mt-auto align-self-start">
                                                <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-primary ">show</a>
                                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-success ">edit</a>
                                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-lg-12 d-flex ">
                                    {!! $posts->links('pagination::bootstrap-5') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('layouts.footer')
