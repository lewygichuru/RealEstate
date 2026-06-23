@extends('backend.layouts.app')

@section('title', 'Posts')

@section('content')
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Post List</h2>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Post
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Approved</th>
                        <th>Status</th>
                        <th>Comments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $key => $post)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if(Storage::disk('public')->exists('posts/'.$post->image))
                                <img src="{{ Storage::url('posts/'.$post->image) }}" alt="{{ $post->title }}" class="w-14 h-10 object-cover rounded">
                            @endif
                        </td>
                        <td class="max-w-32 truncate" title="{{ $post->title }}">
                            {{ \Illuminate\Support\Str::limit($post->title, 20) }}
                        </td>
                        <td class="text-sm">{{ $post->user->name }}</td>
                        <td class="text-sm">
                            @foreach($post->categories as $i => $category)
                                @if($i != 0)<span>,</span>@endif
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td>{{ $post->view_count }}</td>
                        <td>
                            @if($post->is_approved)
                                <span class="badge badge-success badge-sm">Approved</span>
                            @else
                                <span class="badge badge-warning badge-sm">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($post->status)
                                <span class="badge badge-success badge-sm">Published</span>
                            @else
                                <span class="badge badge-warning badge-sm">Draft</span>
                            @endif
                        </td>
                        <td>{{ $post->comments_count }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-success btn-xs"><span class="material-icons text-sm">visibility</span></a>
                                <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deletePost({{ $post->id }})"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="POST" id="del-post-{{ $post->id }}" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
function deletePost(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-post-' + id).submit(); } });
}
</script>
@endpush
