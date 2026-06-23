@extends('backend.layouts.app')

@section('title', 'Testimonials')

@section('content')
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Testimonial List</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Testimonial
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Testimonial</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $key => $testimonial)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if(Storage::disk('public')->exists('testimonial/'.$testimonial->image))
                                <img src="{{ Storage::url('testimonial/'.$testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 object-cover rounded-full">
                            @endif
                        </td>
                        <td>{{ $testimonial->name }}</td>
                        <td class="max-w-64 truncate text-sm">{{ $testimonial->testimonial }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteTestimonial({{ $testimonial->id }})"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" id="del-testimonial-{{ $testimonial->id }}" class="hidden">
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
function deleteTestimonial(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-testimonial-' + id).submit(); } });
}
</script>
@endpush
