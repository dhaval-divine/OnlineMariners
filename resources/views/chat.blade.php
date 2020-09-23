

@extends('layouts.message_app')
@section('content')
    <div class="container-fluid">
        <div class="row" style="margin: 8% 1% 0 1%;">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users">
                        @foreach($users as $user)
                            <li class="user" id="{{ $user->id }}">
                                
                                <div class="media">
                                    <div class="media-left">
                                        <?php                                            
                                            if($user->profile_path == '' || ($user->profile_path == 'emp-default.png')){
                                                $url = url('/public/assets/img/emp-default.png');
                                            }else{
                                                $url = url('/public/profile/'.$user->profile_path);
                                            }                                            
                                        
                                        ?>
                                        <img src="{{  $url }}" alt="chat-user-left" class="media-object">
                                        <div style="position: relative;bottom: 6px;left: 9px;">
                                           @if($user->login_status == 1)
                                            <span class="activeStatus"></span>
                                           @else
                                            <span class="deactiveStatus"></span>
                                           @endif
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <p class="name" style="text-transform: capitalize;">{{ $user->candidate_name }}</p>
                                        <p class="email">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
@endsection

