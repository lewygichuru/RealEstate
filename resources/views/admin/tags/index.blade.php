@extends('backend.layouts.app')

@section('title', 'Tags')

@section('content')
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Tag List</h2>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Tag
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Posts</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $key => $tag)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->posts->count() }}</td>
                        <td class="text-sm text-base-content/60">{{ $tag->slug }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteTag({{ $tag->id }})"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" id="del-tag-{{ $tag->id }}" class="hidden">
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
function deleteTag(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-tag-' + id).submit(); } });
}
</script>
@endpush
