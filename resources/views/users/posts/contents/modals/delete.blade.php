<div class="modal fade" id="delete-post-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger" id="modalTitleId">
                    <i class="fa-solid fa-circle-exclamation"></i>Delete Post
                </h5>

            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="{{ $post->description }}" class="img-thumbnail">
                    <p class="text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{route('post.destroy',$post->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
