@extends('backend.layouts.app')

@section('title', 'Reply Message')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-2xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Reply to Message</h2>
            <a href="{{ route('admin.message') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>

        @if($message->user_id)
        <form action="{{ route('admin.message.send') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="hidden" name="agent_id" value="{{ $message->user_id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
            <input type="hidden" name="email" value="{{ auth()->user()->email }}">

            <div class="bg-base-200 rounded-box p-3 text-sm">
                <strong>Reply To:</strong> {{ $message->email }}
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Phone</legend>
                <input type="number" name="phone" class="input w-full">
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Message</legend>
                <textarea name="message" rows="5" class="textarea w-full"></textarea>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">reply</span> Send Reply
                </button>
            </div>
        </form>
        @else
        <form action="{{ route('admin.message.mail') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="hidden" name="name" value="{{ $message->name }}">
            <input type="hidden" name="mailfrom" value="{{ auth()->user()->email }}">

            <fieldset class="fieldset">
                <legend class="fieldset-legend">To</legend>
                <input type="email" name="email" value="{{ $message->email }}" class="input w-full bg-base-200" readonly>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Subject</legend>
                <input type="text" name="subject" class="input w-full">
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Message</legend>
                <textarea name="message" rows="5" class="textarea w-full"></textarea>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">send</span> Send Email
                </button>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
