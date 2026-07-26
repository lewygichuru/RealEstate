@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('agent.sidebar')</aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-0">
                        <div class="px-4 py-3 border-b border-base-200 flex items-center justify-between">
                            <h2 class="font-bold text-lg">Property List</h2>
                            <a href="{{ route('agent.properties.create') }}" class="btn btn-primary btn-sm gap-1">
                                <span class="material-icons text-sm">add</span> Add Property
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>City</th>
                                        <th>Price</th>
                                        <th>Beds</th>
                                        <th>Baths</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($properties as $key => $property)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="max-w-40 truncate" title="{{ $property->title }}">
                                            {{ \Illuminate\Support\Str::limit($property->title, 30) }}
                                        </td>
                                        <td>{{ ucfirst($property->type) }}</td>
                                        <td>{{ ucfirst($property->status) }}</td>
                                        <td>{{ ucfirst($property->city) }}</td>
                                        <td>Ksh {{ number_format($property->price ?? 0) }}</td>
                                        <td>{{ $property->bedroom }}</td>
                                        <td>{{ $property->bathroom }}</td>
                                        <td>
                                            @if($property->is_featured)
                                                <span class="badge badge-warning badge-sm">Featured</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex gap-1">
                                                <a href="{{ route('property.show', $property->slug) }}" target="_blank" class="btn btn-success btn-xs" title="View">
                                                    <span class="material-icons text-sm">visibility</span>
                                                </a>
                                                <a href="{{ route('agent.properties.edit', $property->id) }}" class="btn btn-warning btn-xs" title="Edit">
                                                    <span class="material-icons text-sm">edit</span>
                                                </a>
                                                <button type="button" class="btn btn-error btn-xs" onclick="deleteProperty('{{ $property->id }}')" title="Delete">
                                                    <span class="material-icons text-sm">delete</span>
                                                </button>
                                                <form action="{{ route('agent.properties.destroy', $property->id) }}" method="POST" id="del-property-{{ $property->id }}" class="hidden">
                                                    @csrf @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 py-3 flex justify-center">
                            {{ $properties->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function deleteProperty(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => {
        if (value) { document.getElementById('del-property-' + id).submit(); }
    });
}
</script>
@endsection
