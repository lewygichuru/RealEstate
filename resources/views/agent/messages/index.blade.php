@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('agent.sidebar')</aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-0">
                        <div class="px-4 py-3 border-b border-base-200">
                            <h2 class="font-bold text-lg">Messages</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $key => $message)
                                    <tr class="{{ $message->status == 0 ? 'font-semibold' : '' }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ ucfirst(strtok($message->name, ' ')) }}</td>
                                        <td class="text-sm">{{ $message->email }}</td>
                                        <td class="max-w-48 truncate text-sm" title="{{ $message->message }}">
                                            {{ \Illuminate\Support\Str::limit($message->message, 30) }}
                                        </td>
                                        <td>
                                            <div class="flex gap-1">
                                                @if($message->status == 0)
                                                    <a href="{{ route('agent.message.read', $message->id) }}" class="btn btn-warning btn-xs" title="Unread"><span class="material-icons text-sm">local_library</span></a>
                                                @else
                                                    <a href="{{ route('agent.message.read', $message->id) }}" class="btn btn-success btn-xs" title="Read"><span class="material-icons text-sm">done</span></a>
                                                @endif
                                                <a href="{{ route('agent.message.replay', $message->id) }}" class="btn btn-primary btn-xs" title="Reply"><span class="material-icons text-sm">reply</span></a>
                                                <button type="button" class="btn btn-error btn-xs" onclick="deleteMessage({{ $message->id }})" title="Delete"><span class="material-icons text-sm">delete</span></button>
                                                <form action="{{ route('agent.messages.destroy', $message->id) }}" method="POST" id="del-message-{{ $message->id }}" class="hidden">
                                                    @csrf @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 py-3 flex justify-center">
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function deleteMessage(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => {
        if (value) { document.getElementById('del-message-' + id).submit(); }
    });
}
</script>
@endsection
