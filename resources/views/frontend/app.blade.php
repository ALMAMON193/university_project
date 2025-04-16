<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\CMS_Content;

    $head_cms = CMS_Content::all();
@endphp

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Saudi Car Hub</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon"
          href="{{ $head_cms[1]->image_url ? $head_cms[1]->image_url : asset('frontend/images/logo.svg') }}" />

    <!-- Styles -->
    @include('frontend.partials.style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
<!-- Header -->
@include('frontend.partials.header')

<!-- Main Content -->
@yield('main--content')

<!-- Footer -->
@include('frontend.partials.footer')

<!-- 🆕 New Chat Button -->
<button id="openChatModal" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; padding: 15px 25px; border: none; border-radius: 30px; background: #fd7f54; color: white; font-size: 16px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); cursor: pointer;">
    Ask Open AI
</button>

<!-- 🤖 Updated Chat Modal (Larger) -->
<div id="chatModal" style="display: none; position: fixed; bottom: 90px; right: 20px; width: 400px; max-height: 600px; background: #20232a; color: #fff; border-radius: 16px; z-index: 1000; box-shadow: 0 8px 20px rgba(0,0,0,0.3); overflow: hidden; font-family: 'Segoe UI', sans-serif;">
    <div style="padding: 14px 16px; background: #282c34; display: flex; justify-content: space-between; align-items: center;">
        <button id="newChatBtn" style="border: none; background: none; color: #ccc; font-size: 18px; cursor: pointer; font-weight: bold;" title="New Chat">New Chat</button>


        <!-- Close Button -->
        <button id="closeChatModal" style="border: none; background: none; color: #ccc; font-size: 20px; cursor: pointer;">
            &times;
        </button>
    </div>
    <div id="chatDisplay" style="padding: 16px; height: 400px; overflow-y: auto; display: flex; flex-direction: column; gap: 10px;"></div>
    <div style="padding: 14px">
        <textarea id="chatInput" rows="2" placeholder="Type your message..." style="width: 100%; resize: none; padding: 12px; border-radius: 10px; border: none; background: #2d313a; color: #fff; font-size: 14px; outline: none;"></textarea>
    </div>
</div>

<!-- 💬 Chat Script -->
<script>
    $(document).ready(function () {
        // Open chat modal & reset chat
        $('#openChatModal').on('click', function () {
            $('#chatDisplay').html(''); // Clear previous messages
            $('#chatModal').fadeIn();
            $('#chatInput').focus();
        });

        // Close chat modal
        $('#closeChatModal').on('click', function () {
            $('#chatModal').fadeOut();
        });

        // Handle message send on Enter
        $('#chatInput').on('keypress', function (e) {
            if (e.which === 13 && !e.shiftKey) {
                e.preventDefault();
                let msg = $('#chatInput').val().trim();
                if (msg !== '') {
                    appendMessage(msg, 'user');
                    $('#chatInput').val('');
                    setTimeout(() => {
                        botReply(msg);
                    }, 500);
                }
            }
        });

        // New chat button: reset chat
        $('#newChatBtn').on('click', function () {
            $('#chatDisplay').html(''); // Clear previous messages
            $('#chatInput').val(''); // Clear input
            $('#chatInput').focus(); // Focus input field
            console.log('New chat started!');
        });

        // Append message to chat
        function appendMessage(text, sender) {
            const bubbleStyle = sender === 'user'
                ? 'align-self: flex-end; background: #4e54c8; color: #fff; border-bottom-right-radius: 0;'
                : 'align-self: flex-start; background: #6c63ff; color: #fff; border-bottom-left-radius: 0;';

            $('#chatDisplay').append(`
                <div style="max-width: 75%; padding: 10px 14px; border-radius: 14px; ${bubbleStyle}">
                    ${text}
                </div>
            `);
            $('#chatDisplay').scrollTop($('#chatDisplay')[0].scrollHeight);
        }

        // Simple bot responses
        function botReply(userMsg) {
            let response = "Hmm 🤔 I didn't quite catch that.";
            const lower = userMsg.toLowerCase();

            if (lower.includes('hello')) response = "Hey there! 👋";
            else if (lower.includes('how are you')) response = "Doing awesome! 💯 What about you?";
            else if (lower.includes('bye')) response = "Goodbye! 🌟 Come back soon!";

            appendMessage(response, 'bot');
        }
    });
</script>

<!-- Footer Scripts -->
@include('frontend.partials.script')
</body>
</html>
