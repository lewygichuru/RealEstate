@extends('frontend.layouts.app')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Our Agents</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($agents as $agent)
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow text-center">
                <div class="card-body items-center gap-3">
                    <div class="avatar">
                        <div class="w-20 h-20 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="{{ Storage::url('users/'.$agent->image) }}" alt="{{ $agent->name }}">
                        </div>
                    </div>
                    <a href="{{ route('agents.show', $agent->id) }}">
                        <h3 class="card-title text-base hover:text-primary transition-colors">{{ $agent->name }}</h3>
                    </a>
                    <p class="text-sm text-base-content/60">{{ $agent->email }}</p>
                    <p class="text-sm text-base-content/70 line-clamp-2">
                        {{ \Illuminate\Support\Str::limit($agent->about, 80) }}
                    </p>
                    <a href="{{ route('agents.show', $agent->id) }}" class="btn btn-primary btn-sm mt-1">View Profile</a>
                </div>
            </div>
            @empty
            <div class="col-span-3">
                <div class="alert"><span class="material-icons">info</span> No agents found.</div>
            </div>
            @endforelse
        </div>

        <div class="mt-10 flex justify-center">
            {{ $agents->links() }}
        </div>
    </div>
</section>
@endsection
