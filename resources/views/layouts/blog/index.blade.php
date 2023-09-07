
@include('layouts.blog.header')
@include('layouts.blog.nav')
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Clean Blog</h1>
                            <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 ">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="post-preview">
                                <a href="{{ route('blog.posts.show', $post->id) }}">
                                    <h2 class="post-title">{{$post->title}}</h2>
                                    <h3 class="post-subtitle">{{$post->short_content}}</h3>
                                </a>
                                <p class="post-meta">
                                    Posted by
                                    @foreach ($post->users as $user)
                                        <a class="link-opacity-75-hover user-link" href="{{ route('authors.show', $user->id) }}">{{$user->name}}</a> ,
                                    @endforeach
                                    on {{$post->created_at->format('d-m-Y')}}
                                </p>
                            </div>
                                <!-- Divider-->
                        <hr class="my-4" />
                        @endforeach
                    @else
                        <p>No results found.</p>
                    @endif
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
                </div>
               <div class="col-md-2 col-lg-4 col-xl-5 text-center">
                    <h2>Categories</h2>
                    <div class="post-preview">
                        <ul class="list-group list-group-light">
                            @foreach ($categories as $category)
                                <li class="list-group-item border-bottom border-0">
                                    <a href="#" data-category-id="{{$category->id}}">{{$category->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <h2 class="mt-5">Users</h2>
                    <div class="post-preview">
                        <ul class="list-group list-group-light">
                            @foreach($users as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                                <div class="d-flex align-items-center">
                                  <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 60px; height: 60px"
                                    class="rounded-circle" />
                                  <div class="ms-3">
                                    <p class="fw-bold mb-1">{{$user->name}}</p>
                                    <p class="text-muted mb-0">{{$user->email}}</p>
                                  </div>
                                </div>
                                <a class="btn btn-info rounded-circle" href="#" role="button" >{{$user->posts_count}}</a>


                              </li>
                            @endforeach


                          </ul>
                    </div>
               </div>
            </div>
        </div>
        @include('layouts.blog.footer')

