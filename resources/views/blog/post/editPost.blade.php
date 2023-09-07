@include('layouts.blog.header')
@include('layouts.blog.nav')
        <!-- Page Header-->
        <header class="masthead">
            <div class="container position-relative px-4 px-lg-4">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1> Edit Post</h1>
                            <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
                            <span class="meta">
                                Edit Post

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
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="col-md-10 col-lg-8 col-xl-8">
                        <form action="{{ route('blog.storePost') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <select name="categories[]"  class="selectpicker form-control" data-placeholder="Choose Categories" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Post Title</label>
                                <input type="text" class="form-control" name="title" id="exampleFormControlTextarea1" value="{{$post->title}}"/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Post Image</label>
                                <input type="file" class="form-control" name="image" id="exampleFormControlTextarea1" value="{{$post->image}}/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">short Content</label>
                                <textarea class="form-control" name="short_content" id="exampleFormControlTextarea1" rows="3"  value="{{$post->short_content}}""></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"  value="{{$post->content}}"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">edit Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </article>
        @include('layouts.blog.footer')

