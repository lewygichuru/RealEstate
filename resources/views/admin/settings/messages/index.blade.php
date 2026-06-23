@extends('backend.layouts.app')

@section('title', 'Messages')

@section('content')
<div>
    <h2 class="font-bold text-lg mb-4">Messages</h2>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $key => $message)
                    <tr class="{{ $message->status == 0 ? 'font-semibold' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $message->name }}</td>
                        <td class="text-sm">{{ $message->email }}</td>
                        <td class="text-sm">{{ $message->phone }}</td>
                        <td class="max-w-48 truncate text-sm">{{ \Illuminate\Support\Str::limit($message->message, 40) }}</td>
                        <td>
                            <div class="flex gap-1">
                                @if($message->status == 0)
                                    <a href="{{ route('admin.message.read', $message->id) }}" class="btn btn-warning btn-xs" title="Unread"><span class="material-icons text-sm">local_library</span></a>
                                @else
                                    <a href="{{ route('admin.message.read', $message->id) }}" class="btn btn-success btn-xs" title="Read"><span class="material-icons text-sm">done</span></a>
                                @endif
                                <a href="{{ route('admin.message.replay', $message->id) }}" class="btn btn-primary btn-xs" title="Reply"><span class="material-icons text-sm">reply</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteMessage({{ $message->id }})" title="Delete"><span class="material-icons text-sm">delete</span></button>
                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" id="del-message-{{ $message->id }}" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
function deleteMessage(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-message-' + id).submit(); } });
}
</script>
@endpush
