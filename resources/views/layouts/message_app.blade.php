    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('public/js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/css/plugins.css') }}">
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">    
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('public/assets/css/colors/green-style.css') }}"> 
    <!-- Custom css -->
    <link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet">
    <!-- Js Jquery basic-->
    <script type="text/javascript" src="{{ asset('public/assets/plugins/js/jquery.min.js') }}"></script> 
    <?php
        // setcookie('websocket', 'pusherval', time()+(7*24*3600), "/; SameSite=None; Secure");
    ?>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #8eefd16e;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }

        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
        .activeStatus {
            width: 12px;
            height: 12px;
            background: #1baf65;
            border-radius: 20px;
            position: absolute;
            bottom: 12%;
            right: 6%;
            transition: border .10s;
        }
        .deactiveStatus {
            width: 12px;
            height: 12px;
            background: red;
            border-radius: 20px;
            position: absolute;
            bottom: 12%;
            right: 6%;
            transition: border .10s;
        }
        .media, .media-body {
            overflow: hidden;
            zoom: 1;
            padding-left: 2% !important;
            padding-right: 2% !important;
        }
        p{
            text-transform: lowercase !important;
        }
    </style>
</head>
<body>
<div id="app">
    <!-- Nav bar 2 -->
    @include('includes.navbar2')

    <main class="py-4">
        @yield('content')
    </main>
    @yield('customjs')
</div>

<!-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script> -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function () {
        // ajax setup form csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('7bc8baf4f92749b3de40', {
            cluster: 'ap2',
            forceTLS: true,
            // disableStats: true
        }); 
        
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            // alert(JSON.stringify(data));
            alert(my_id+' '+data.from+' '+ data.to);
            if (my_id == data.from) {
                $('#' + data.to).click();
            } else if (my_id == data.to) {
                if (receiver_id == data.from) {
                    // if receiver is selected, reload the selected user ...
                    $('#' + data.from).click();
                } else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.from).find('.pending').html());

                    if (pending) {
                        $('#' + data.from).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.from).append('<span class="pending">1</span>');
                    }
                }
            }
        });

        $('.user').click(function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            //$receiver_id = $(this).attr('id');
            
            receiver_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "message1/" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data+"<input type='hidden' name='receiver_id' value='"+ receiver_id +"'>");
                    scrollToBottomFunc();
                }
            });
        });

        $(document).on('keyup', '.input-text input', function (e) {
            var message = $(this).val();

            // check if enter key is pressed and message is not null also receiver is selected
            if (e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val(''); // while pressed enter text box will be empty

                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "get",
                    url: "message1", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data+"<input type='hidden' name='receiver_id' value='"+ receiver_id +"'>");
                    scrollToBottomFunc();
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
            }
        });
    });

    // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 20000);
    }
</script>
</body>
</html>
