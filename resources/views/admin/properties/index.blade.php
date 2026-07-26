@extends('backend.layouts.app')

@section('title', 'Properties')

@section('content')
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Property List</h2>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Property
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Owner</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Beds</th>
                        <th>Baths</th>
                        <th><span class="material-icons text-sm">comment</span></th>
                        <th><span class="material-icons text-sm">stars</span></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $key => $property)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @php($cover = $property->gallery->first())
                            @if($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path))
                                <img src="{{ Storage::url($cover->file_path) }}" alt="{{ $property->title }}" class="w-14 h-10 object-cover rounded">
                            @elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image)))
                                @php($legacyImg = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image)
                                <img src="{{ Storage::url($legacyImg) }}" alt="{{ $property->title }}" class="w-14 h-10 object-cover rounded">
                            @endif
                        </td>
                        <td class="max-w-32 truncate" title="{{ $property->title }}">{{ \Illuminate\Support\Str::limit($property->title, 18) }}</td>
                        <td class="text-sm">{{ $property->user->name }}</td>
                        <td><span class="badge badge-outline badge-sm">{{ $property->type }}</span></td>
                        <td><span class="badge badge-outline badge-sm">{{ ucfirst($property->status) }}</span></td>
                        <td class="text-sm">Ksh {{ number_format($property->price ?? 0) }}</td>
                        <td>{{ $property->bedroom }}</td>
                        <td>{{ $property->bathroom }}</td>
                        <td><span class="badge badge-primary badge-sm">{{ $property->comments_count }}</span></td>
                        <td>
                            @if($property->is_featured)
                                <span class="badge badge-warning badge-sm"><span class="material-icons text-xs">star</span></span>
                            @endif
                        </td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.properties.show', $property->id) }}" class="btn btn-success btn-xs"><span class="material-icons text-sm">visibility</span></a>
                                <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteProperty('{{ $property->id }}')"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" id="del-property-{{ $property->id }}" class="hidden">
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
function deleteProperty(id) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            document.getElementById('del-property-' + id).submit();
        }
    });
}
</script>
@endpush
