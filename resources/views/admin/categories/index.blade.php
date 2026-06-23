@extends('backend.layouts.app')

@section('title', 'Categories')

@section('content')
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Category List</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Category
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Posts</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if(Storage::disk('public')->exists('category/thumb/'.$category->image))
                                <img src="{{ Storage::url('category/thumb/'.$category->image) }}" alt="{{ $category->name }}" class="w-12 h-12 object-cover rounded-box">
                            @endif
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->posts->count() }}</td>
                        <td class="text-sm text-base-content/60">{{ $category->slug }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteCategory({{ $category->id }})"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" id="del-category-{{ $category->id }}" class="hidden">
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
function deleteCategory(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-category-' + id).submit(); } });
}
</script>
@endpush
