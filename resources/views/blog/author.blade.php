@include('layouts.blog.header')
@include('layouts.blog.nav')
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>{{$author->name}}</h1>
                            <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
      <!-- Main Content-->
      <div class="container authors px-4 px-lg-5">
        @csrf
        <div class="row gx-4 gx-lg-5 ">
            <div class=" col-md-10 col-lg-8 col-xl-8">
                <div class="authors-posts">
                    @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('posts.show', $post->slug) }}">

                            <h2 class="post-title">{{$post->title}}</h2>
                            <h3 class="post-subtitle">{{$post->short_content}}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            @foreach ($post->users as $user)
                                <a class="link-opacity-75-hover user-link" href="{{ route('posts.authors', $user->slug) }}">{{$user->name}}</a>{{$user != $post->users->last() ? ',' : ''}}
                            @endforeach
                            on {{$post->created_at->format('d-m-Y')}}
                        </p>
                        <p>
                            @foreach ($post->categories as $category)
                                <a style="text-decoration: none" class="link-opacity-75-hover category-span" href="{{ route('posts.categories', $category->slug) }}" >{{$category->name}}</a>{{$category != $post->categories->last() ? ',' : ''}}
                            @endforeach
                        </p>
                    </div>
                        <!-- Divider-->
                    <hr class="my-4" />
                    @endforeach
                @else
                    <p>No results found.</p>
                @endif
                <div class=" mb-4">
                    @if ($posts->previousPageUrl())
                    <a href="{{ $posts->previousPageUrl() }}" class="btn btn-primary text-uppercase">Newer Posts</a>

                    @endif

                    @if ($posts->nextPageUrl())
                    <a  href="{{ $posts->nextPageUrl() }}" class="btn btn-primary text-uppercase float-end">Older Posts</a>

                    @endif
                </div>
                </div>
            </div>
           <div class="col-md-2 col-lg-4 col-xl-4  pt-5">
             @include('layouts.blog.rightside')
           </div>
        </div>
    </div>

    @include('layouts.blog.footer')


