@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('user.sidebar')</aside>

            <div class="lg:col-span-3 flex flex-col gap-6">

                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <span class="material-icons text-4xl">comment</span>
                        </div>
                        <div class="stat-title">Comments</div>
                        <div class="stat-value text-primary">{{ $commentcount }}</div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-0">
                        <div class="px-4 py-3 border-b border-base-200">
                            <h2 class="font-bold text-lg">Recent Comments</h2>
                        </div>
                        <ul class="divide-y divide-base-200">
                            @foreach($comments as $key => $comment)
                            <li class="px-4 py-3 text-sm text-base-content/80">
                                <span class="font-medium text-base-content">{{ ++$key }}.</span> {{ $comment->body }}
                            </li>
                            @endforeach
                        </ul>
                        <div class="px-4 py-3 flex justify-center">
                            {{ $comments->links() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection
