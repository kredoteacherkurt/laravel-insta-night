{{-- Clickable Image --}}
<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
    </a>
</div>

<div class="card-body">
    {{-- heart icon + no. of likes + categories --}}
    <div class="row align-items-center">
        <div class="col-auto">
            @if ($post->isLiked())
                <form action="{{route('like.destroy',$post->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm shadow-none p-0"><i
                            class="fa-solid fa-heart text-danger"></i></button>
                </form>
            @else
                <form action="{{ route('like.store', $post->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm shadow-none p-0"><i
                            class="fa-regular fa-heart"></i></button>
                </form>
            @endif
        </div>
        <div class="col-auto px-0">
            <span>{{ $post->likes->count() }}</span>
        </div>
        <div class="col text-end">
            @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50">
                    {{ $category_post->category->name }}
                </div>
            @endforeach
        </div>
    </div>

    {{-- Owner + description of the post --}}
    <a href="#" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
    &nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>
    <p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>

    {{-- include comments here later on --}}

    <div class="mt-3">
        @if ($post->comments->isNotEmpty())
            <ul class="list-group mt-2">
                @foreach ($post->comments->take(3) as $comment)
                    <li class="list-group-item border-0 p-0 mb-2">
                        <a href="#" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                        &nbsp;
                        <p class="d-inline fw-light">{{ $comment->body }}</p>
                        <form action="{{ route('comment.delete', $comment->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <span class=" text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                            @if (Auth::user()->id == $comment->user_id)
                                &middot;
                                <button type="submit" class="btn border-0 text-danger p-0 small">Delete</button>
                            @endif

                        </form>

                    </li>
                @endforeach
                @if ($post->comments->count() > 3)
                    <li class="list-group-item border-0 p-0">
                        <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none fw-bold">View all
                            {{ $post->comments->count() }}
                            comments</a>
                    </li>
                @endif
            </ul>

        @endif

        <form action="{{ route('comment.store', $post->id) }}" method="post">
            @csrf
            <div class="input-group">
                <textarea name="body" id="" rows="1" class="form-control form-control-sm"></textarea>
                <button type="submit" class="btn btn-secondary btn-sm"> <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
</div>
