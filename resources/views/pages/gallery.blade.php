@extends('frontend.layouts.app')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Gallery</h1>

        <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4">
            @forelse($galleries as $gallery)
                @if(Storage::disk('public')->exists('gallery/'.$gallery->image) && $gallery->image)
                <div class="break-inside-avoid">
                    <img src="{{ Storage::url('gallery/'.$gallery->image) }}"
                         alt="Gallery image"
                         class="w-full rounded-box cursor-pointer hover:opacity-90 transition-opacity shadow-sm"
                         onclick="openGalleryLightbox('{{ Storage::url('gallery/'.$gallery->image) }}')">
                </div>
                @endif
            @empty
            <div class="col-span-3">
                <div class="alert"><span class="material-icons">info</span> No gallery images yet.</div>
            </div>
            @endforelse
        </div>

        <div class="mt-10 flex justify-center">
            {{ $galleries->links() }}
        </div>
    </div>
</section>

<dialog id="gallery-modal" class="modal">
    <div class="modal-box max-w-4xl p-2 bg-black">
        <img id="gallery-img" src="" class="w-full h-auto max-h-[80vh] object-contain rounded" />
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>
@endsection

@section('scripts')
<script>
function openGalleryLightbox(src) {
    document.getElementById('gallery-img').src = src;
    document.getElementById('gallery-modal').showModal();
}
</script>
@endsection
