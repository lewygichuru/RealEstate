@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('agent.sidebar')</aside>

            <div class="lg:col-span-3 space-y-6">
                <h1 class="text-2xl font-bold">Dashboard</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="stat bg-base-100 rounded-box shadow-sm">
                        <div class="stat-figure text-primary"><span class="material-icons text-4xl">home</span></div>
                        <div class="stat-title">Properties</div>
                        <div class="stat-value text-primary">{{ $propertytotal }}</div>
                    </div>
                    <div class="stat bg-base-100 rounded-box shadow-sm">
                        <div class="stat-figure text-secondary"><span class="material-icons text-4xl">mail</span></div>
                        <div class="stat-title">Messages</div>
                        <div class="stat-value text-secondary">{{ $messagetotal }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-0">
                            <div class="px-4 py-3 border-b border-base-200">
                                <h2 class="font-bold text-sm uppercase tracking-wide">Recent Properties</h2>
                            </div>
                            <ul class="divide-y divide-base-200">
                                @foreach($properties as $key => $property)
                                <li>
                                    <a href="{{ route('property.show', $property->slug) }}" target="_blank"
                                       class="flex items-center justify-between px-4 py-2 hover:bg-base-200 transition-colors text-sm">
                                        <span class="truncate">{{ ++$key }}. {{ \Illuminate\Support\Str::limit($property->title, 28) }}</span>
                                        <span class="text-primary font-semibold ml-2">Ksh {{ number_format($property->price) }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-0">
                            <div class="px-4 py-3 border-b border-base-200">
                                <h2 class="font-bold text-sm uppercase tracking-wide">Recent Messages</h2>
                            </div>
                            <ul class="divide-y divide-base-200">
                                @foreach($messages as $message)
                                <li>
                                    <span class="flex px-4 py-2 text-sm">
                                        <strong class="mr-1">{{ strtok($message->name, ' ') }}:</strong>
                                        <span class="truncate text-base-content/70">{{ \Illuminate\Support\Str::limit($message->message, 25) }}</span>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
