@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('user.sidebar')</aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title">Reply to Message</h2>
                            <a href="{{ route('user.message') }}" class="btn btn-outline btn-sm gap-1">
                                <span class="material-icons text-sm">arrow_back</span> Back
                            </a>
                        </div>

                        @if($message->sender_id)
                        <form action="{{ route('user.message.send') }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">To</legend>
                                <input type="text" value="{{ $message->sender->name }} ({{ $message->sender->email }})" class="input w-full bg-base-200" readonly>
                            </fieldset>
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Subject</legend>
                                <input type="text" name="subject" value="Re: {{ $message->subject }}" class="input w-full">
                            </fieldset>
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Message</legend>
                                <textarea name="body" rows="5" class="textarea w-full" required></textarea>
                            </fieldset>
                            <div>
                                <button type="submit" class="btn btn-primary gap-2">
                                    <span class="material-icons text-sm">send</span> Send Reply
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
