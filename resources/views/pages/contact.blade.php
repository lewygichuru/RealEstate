@extends('frontend.layouts.app')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Contact Us</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Contact Form --}}
            <div class="lg:col-span-2">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <h2 class="card-title">Send a Message</h2>
                        <form id="contact-us" action="" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <input type="hidden" name="mailto" value="{{ $footersettings[0]['email'] ?? '' }}">
                            @auth
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            @endauth

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Your Name</legend>
                                @auth
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" readonly
                                           class="input w-full bg-base-200">
                                @else
                                    <input type="text" name="name" placeholder="Your full name" class="input w-full">
                                @endauth
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Email Address</legend>
                                @auth
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" readonly
                                           class="input w-full bg-base-200">
                                @else
                                    <input type="email" name="email" placeholder="your@email.com" class="input w-full">
                                @endauth
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Phone Number</legend>
                                <input type="number" name="phone" placeholder="Your phone number" class="input w-full">
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Message</legend>
                                <textarea name="message" rows="5" placeholder="Write your message..."
                                          class="textarea w-full"></textarea>
                            </fieldset>

                            <button id="msgsubmitbtn" type="submit" class="btn btn-primary gap-2 w-fit">
                                <span class="material-icons text-sm">send</span> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Contact Info --}}
            <aside>
                <div class="card bg-base-100 shadow-sm sticky top-20">
                    <div class="card-body gap-6">
                        <h2 class="card-title text-base">Get In Touch</h2>

                        @if(isset($footersettings[0]) && !empty($footersettings[0]['phone']))
                        <div class="flex items-start gap-3">
                            <span class="material-icons text-primary mt-0.5">call</span>
                            <div>
                                <p class="text-xs text-base-content/50 uppercase font-semibold tracking-wide">Call Us Now</p>
                                <p class="font-semibold">{{ $footersettings[0]['phone'] }}</p>
                            </div>
                        </div>
                        @endif

                        @if(isset($footersettings[0]) && !empty($footersettings[0]['email']))
                        <div class="flex items-start gap-3">
                            <span class="material-icons text-primary mt-0.5">mail</span>
                            <div>
                                <p class="text-xs text-base-content/50 uppercase font-semibold tracking-wide">Email</p>
                                <p class="font-semibold">{{ $footersettings[0]['email'] }}</p>
                            </div>
                        </div>
                        @endif

                        @if(isset($footersettings[0]) && !empty($footersettings[0]['address']))
                        <div class="flex items-start gap-3">
                            <span class="material-icons text-primary mt-0.5">map</span>
                            <div>
                                <p class="text-xs text-base-content/50 uppercase font-semibold tracking-wide">Address</p>
                                <p class="font-semibold">{!! $footersettings[0]['address'] !!}</p>
                            </div>
                        </div>
                        @endif
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
    $(document).on('submit', '#contact-us', function(e) {
        e.preventDefault();
        var btn = $('#msgsubmitbtn');
        btn.addClass('loading').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: "{{ route('contact.message') }}",
            data: $(this).serialize(),
            success: function(data) { if (data.message) toastr.success(data.message); },
            error: function() { toastr.error('Failed to send message.'); },
            complete: function() {
                $('form#contact-us')[0].reset();
                btn.removeClass('loading').prop('disabled', false);
            },
            dataType: 'json'
        });
    });
});
</script>
@endsection
