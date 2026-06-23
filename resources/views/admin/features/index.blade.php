@extends('backend.layouts.app')

@section('title', 'Features')

@section('content')
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Feature List</h2>
        <a href="{{ route('admin.features.create') }}" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Feature
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($features as $key => $feature)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $feature->name }}</td>
                        <td class="text-sm text-base-content/60">{{ $feature->slug }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.features.edit', $feature->id) }}" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteFeature({{ $feature->id }})"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.features.destroy', $feature->id) }}" method="POST" id="del-feature-{{ $feature->id }}" class="hidden">
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
function deleteFeature(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-feature-' + id).submit(); } });
}
</script>
@endpush
