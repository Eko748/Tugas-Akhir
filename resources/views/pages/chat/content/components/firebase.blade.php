<div id="messages">
    @foreach ($messages as $message)
        <div>
            <strong>{{ $message->sender_id }}</strong>: {{ $message->content }}
        </div>
    @endforeach
</div>

<form id="message-form" action="{{ route('message.post') }}" method="post">
    @csrf
    <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
    <input type="text" name="content">
    <button type="submit">Send</button>
</form>
