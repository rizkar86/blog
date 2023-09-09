<form action="{{ route('posts.index') }}" method="get">
    <div class="row">
        <div class="col-md-10">
            <input type="text" class="form-control mb-3" placeholder="search" name="q">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i>
              </button>
        </div>
    </div>
</form>
    <h2>Categories</h2>
    <div class="post-preview">
        <ul class="list-group list-group-light">
            @foreach ($categoriesWithMostPosts as $category)
                <li class="list-group-item border-bottom border-0 ">
                    <a href="{{ route('posts.category', $category->id) }}" >{{$category->name}}</a>
                    <span class="badge rounded-pill  text-dark float-end">( {{$category->posts_count}} )</span>
                </li>
            @endforeach
        </ul>
    </div>

    <h2 class="mt-5">Authors</h2>
    <div class="post-preview">
        <ul class="list-group list-group-light">
            @foreach($usersWithMostPosts as $user)
                <li class="list-group-item border-bottom border-0 ">
                    <a href="{{ route('posts.author', $user->id) }}">{{$user->name}}</a>
                    <span class="badge rounded-pill  text-dark float-end">( {{$user->posts_count}} )</span>
                </li>
            @endforeach
          </ul>
    </div>

