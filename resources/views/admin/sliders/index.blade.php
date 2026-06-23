@extends('backend.layouts.app')

@section('title', 'Sliders')

@section('content')
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Slider List</h2>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Slider
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $key => $slider)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if(Storage::disk('public')->exists('slider/'.$slider->image))
                                <img src="{{ Storage::url('slider/'.$slider->image) }}" alt="{{ $slider->title }}" class="w-24 h-14 object-cover rounded-box">
                            @endif
                        </td>
                        <td>{{ $slider->title }}</td>
                        <td class="max-w-48 truncate text-sm">{{ $slider->description }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteSlider({{ $slider->id }})"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" id="del-slider-{{ $slider->id }}" class="hidden">
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
function deleteSlider(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-slider-' + id).submit(); } });
}
</script>
@endpush
