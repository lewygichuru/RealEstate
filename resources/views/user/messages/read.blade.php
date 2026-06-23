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
                            <h2 class="card-title">Message</h2>
                            <a href="{{ route('user.message') }}" class="btn btn-outline btn-sm gap-1">
                                <span class="material-icons text-sm">arrow_back</span> Back
                            </a>
                        </div>

                        <div class="bg-base-200 rounded-box p-4 space-y-1 text-sm">
                            <p><strong>From:</strong> {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
                            <p><strong>Phone:</strong> {{ $message->phone }}</p>
                        </div>

                        <div class="bg-base-100 border border-base-300 rounded-box p-4">
                            <p class="text-sm font-semibold mb-2">Message:</p>
                            <p class="text-base-content/80">{!! $message->message !!}</p>
                        </div>

                        <div class="flex items-center gap-3 flex-wrap">
                            <a href="{{ route('user.message.replay', $message->id) }}" class="btn btn-primary btn-sm gap-1">
                                <span class="material-icons text-sm">reply</span> Reply
                            </a>
                            <form action="{{ route('user.message.readunread') }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="{{ $message->status }}">
                                <input type="hidden" name="messageid" value="{{ $message->id }}">
                                <button type="submit" class="btn btn-warning btn-sm gap-1">
                                    <span class="material-icons text-sm">local_library</span>
                                    {{ $message->status ? 'Mark Unread' : 'Mark Read' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
