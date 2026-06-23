@extends('frontend.layouts.app')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Agent Properties --}}
            <div class="lg:col-span-2">
                {{-- Agent card --}}
                <div class="card card-side bg-base-100 shadow-sm mb-8">
                    <figure class="w-32 shrink-0">
                        <img src="{{ Storage::url('users/'.$agent->image) }}" alt="{{ $agent->name }}"
                             class="h-full w-full object-cover">
                    </figure>
                    <div class="card-body p-5">
                        <h2 class="card-title">{{ $agent->name }}</h2>
                        <p class="text-sm text-base-content/60">{{ $agent->email }}</p>
                        <p class="text-sm text-base-content/70">{{ $agent->about }}</p>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-4">Properties by {{ $agent->name }}</h2>

                <div class="space-y-4">
                    @forelse($properties as $property)
                    <div class="card card-side bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                        <figure class="w-36 shrink-0">
                            @php($cover = $property->gallery->first())
                            <div class="h-full w-full bg-cover bg-center"
                                 style="background-image: url('{{ $cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path) ? Storage::url($cover->file_path) : ($property->image ? Storage::url('property/'.$property->image) : '') }}')"></div>
                        </figure>
                        <div class="card-body p-4">
                            <a href="{{ route('property.show', $property->slug) }}">
                                <h3 class="card-title text-base hover:text-primary transition-colors line-clamp-1">
                                    {{ \Illuminate\Support\Str::limit($property->title, 40) }}
                                </h3>
                            </a>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary">
                                    Ksh {{ number_format($property->price) }}
                                    @if($property->type === 'apartment' && optional($property->units->first())->rent_amount)
                                        <span class="text-xs font-normal">/mo</span>
                                    @endif
                                </span>
                                <span class="badge badge-outline badge-sm">{{ ucfirst($property->type) }} · {{ $property->status }}</span>
                            </div>
                            <div class="flex gap-3 text-xs text-base-content/60">
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">bed</span> {{ $property->bedroom }}</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">bathtub</span> {{ $property->bathroom }}</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">square_foot</span> {{ $property->area }} sqft</span>
                                @if($property->is_featured)
                                    <span class="badge badge-warning badge-sm ml-auto">Featured</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert"><span>No properties listed by this agent yet.</span></div>
                    @endforelse
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $properties->links() }}
                </div>
            </div>

            {{-- Contact form --}}
            <aside>
                <div class="card bg-base-100 shadow-sm sticky top-20">
                    <div class="card-body gap-3">
                        <h2 class="card-title text-base">Send a Message</h2>
                        <form class="agent-message-box flex flex-col gap-3 mt-1" action="" method="POST">
                            @csrf
                            <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Name</legend>
                                <input type="text" name="name" placeholder="Your Name" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Email</legend>
                                <input type="email" name="email" placeholder="Your Email" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Phone</legend>
                                <input type="number" name="phone" placeholder="Your Phone" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Message</legend>
                                <textarea name="message" rows="4" placeholder="Your Message" class="textarea textarea-sm w-full"></textarea>
                            </fieldset>
                            <button id="msgsubmitbtn" type="submit" class="btn btn-primary btn-sm w-full gap-1">
                                <span class="material-icons text-sm">send</span> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(function(){
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $(document).on('submit', '.agent-message-box', function(e) {
        e.preventDefault();
        var btn = $('#msgsubmitbtn');
        btn.addClass('loading').prop('disabled', true);
        $.ajax({
            type: 'POST', url: "{{ route('property.message') }}",
            data: $(this).serialize(),
            success: function(data) { if (data.message) toastr.success(data.message); },
            error: function() { toastr.error('Failed to send message.'); },
            complete: function() { btn.removeClass('loading').prop('disabled', false); $('form.agent-message-box')[0].reset(); },
            dataType: 'json'
        });
    });
});
</script>
@endsection
