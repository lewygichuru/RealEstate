@extends('backend.layouts.app')

@section('title', 'Services')

@section('content')
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Service List</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Service
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $key => $service)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $service->title }}</td>
                        <td class="max-w-48 truncate text-sm">{{ $service->description }}</td>
                        <td><span class="material-icons">{{ $service->icon }}</span></td>
                        <td>{{ $service->service_order }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteService({{ $service->id }})"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" id="del-service-{{ $service->id }}" class="hidden">
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
function deleteService(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-service-' + id).submit(); } });
}
</script>
@endpush
