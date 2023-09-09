@if ($posts->count() > 0)
    @foreach ($posts as $post)
    <div class="post-preview">
        <a href="{{ route('posts.show', $post->id) }}">

            <h2 class="post-title">{{$post->title}}</h2>
            <h3 class="post-subtitle">{{$post->short_content}}</h3>
        </a>
        <p class="post-meta">
            Posted by
            @foreach ($post->users as $user)
                <a class="link-opacity-75-hover user-link" href="{{ route('posts.author', $user->id) }}">{{$user->name}}</a>{{$user != $post->users->last() ? ',' : ''}}
            @endforeach
            on {{$post->created_at->format('d-m-Y')}}
        </p>
        <p>
            @foreach ($post->categories as $category)
                <a style="text-decoration: none" class="link-opacity-75-hover category-span" href="{{ route('posts.category', $category->id) }}" >{{$category->name}}</a>{{$category != $post->categories->last() ? ',' : ''}}
            @endforeach
        </p>
    </div>
        <!-- Divider-->
    <hr class="my-4" />
    @endforeach
@else
    <p>No results found.</p>
@endif
<div class="simple-pagination  mb-4">
    @if ($posts->previousPageUrl())
    <a href="{{ $posts->previousPageUrl() }}" class="btn btn-primary text-uppercase">Newer Posts</a>

    @endif

    @if ($posts->nextPageUrl())
    <a  href="{{ $posts->nextPageUrl() }}" class="btn btn-primary text-uppercase float-end">Older Posts</a>

    @endif
</div>
