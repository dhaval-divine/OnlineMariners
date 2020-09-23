
<?php

// echo '<pre>';
// print_r($users);
// echo url('/public/empProfile/1600154803.jpg');
// exit;

?>

@extends('layouts.messagefromcandi_app')
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
                                            // echo 'profile : '.$user->pic_path;
                                            if(($user->pic_path == '')||  ($user->pic_path == null) || ($user->pic_path == 'emp-default.png')){
                                                $url = url('/public/assets/img/emp-default.png');
                                            }else{
                                                $url = url('/public/empProfile/'.$user->pic_path);
                                            }
                                            
                                        ?>
                                        <img src="{{ $url }}" alt="chat-user-left" class="media-object">
                                        <div style="position: relative;bottom: 6px;left: 9px;">
                                           @if($user->login_status == 1)
                                            <span class="activeStatus"></span>
                                           @else
                                            <span class="deactiveStatus"></span>
                                           @endif
                                        </div>
                                    </div>

                                    <div class="media-body" >
                                        <p class="name" style="text-transform: capitalize;">{{ $user->employer_name }}</p>
                                        <p class="email" style="text-transform: lowercase;">{{ $user->email }}</p>
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

