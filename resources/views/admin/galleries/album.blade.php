@extends('backend.layouts.app')

@section('title', 'Gallery Albums')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 card bg-base-100 shadow-sm">
        <div class="card-body p-0">
            <div class="px-4 py-3 border-b border-base-200">
                <h2 class="font-bold text-lg">Albums</h2>
            </div>
            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($albums as $album)
                <a href="{{ route('admin.album.gallery', $album->id) }}" class="card bg-base-200 hover:bg-base-300 transition-colors shadow-sm overflow-hidden">
                    @if($album->files->isNotEmpty())
                        @foreach($album->files as $key => $file)
                            @if($key == 0)
                                <figure class="h-28 overflow-hidden">
                                    <img src="{{ Storage::url('gallery/'.$file->file_name) }}" alt="{{ $album->title }}" class="w-full h-full object-cover">
                                </figure>
                            @endif
                        @endforeach
                    @else
                        <div class="h-28 flex items-center justify-center bg-base-300">
                            <span class="material-icons text-4xl text-base-content/30">collections</span>
                        </div>
                    @endif
                    <div class="card-body p-3">
                        <p class="font-semibold text-sm">{{ $album->title }}</p>
                        <p class="text-xs text-base-content/50">{{ $album->files->count() }} images</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm h-fit">
        <div class="card-body gap-4">
            <h2 class="card-title text-base">Create Album</h2>
            <form action="{{ route('admin.album.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Album Name</legend>
                    <input type="text" name="name" class="input w-full" required>
                </fieldset>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Create Album
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
