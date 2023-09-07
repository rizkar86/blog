@if ($posts->previousPageUrl())
<a href="{{ $posts->previousPageUrl() }}" class="btn btn-primary text-uppercase">Newer Posts</a>

@endif

@if ($posts->nextPageUrl())
<a  href="{{ $posts->nextPageUrl() }}" class="btn btn-primary text-uppercase float-end">Older Posts</a>

@endif
