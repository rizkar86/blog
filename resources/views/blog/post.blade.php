@include('layouts.blog.header')
@include('layouts.blog.nav')
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('{{ asset('img/' . $post->image) }}')">
            <div class="container position-relative px-4 px-lg-4">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>{{$post->title}}</h1>
                            <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
                            <span class="meta">
                                Posted by
                                @foreach ($post->users as $user)
                                    <a class="link-opacity-75-hover user-link" href="#" data-user-id="{{$user->id}}">{{$user->name}}</a> ,
                                @endforeach
                                on {{$post->created_at->format('d-m-Y')}}

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    @if(Auth::check() &&  in_array(auth()->user()->id, $post->users->pluck('id')->toArray()))
                        <div class="col-md-10 col-lg-8 col-xl-8">
                            <div class="float-end mb-4">
                                <a class="btn btn-primary" href="{{route('posts.create')}}">Add new Post</a>
                            </div>
                            <div class="mt-auto align-self-start">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success ">edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                           </div>
                        </div>
                    @endif
                    <div class="col-md-10 col-lg-8 col-xl-8">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </article>
        @include('layouts.blog.footer')

