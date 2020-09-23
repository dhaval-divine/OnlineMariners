<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <?php 
                    $emp = Session::get('employerEmail');
                    $employer = DB::select("select id from employer where email ='".$emp."'"); 
                    if($employer[0]->id){
                        $EmdID = $employer[0]->id;//Auth::id();    
                    }
                ?>
                <div class="{{ ($message->from == $EmdID) ? 'sent' : 'received' }}">
                    <p>{{ $message->message }}</p>
                    <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<div class="input-text">
    <input type="text" name="message" class="submit">
</div>
<script>


setTimeout(function(){
    // var url = "{{URL::to('message')}}";
    $('ul .active').trigger('click');
    // // alert(url);
    // // window.location=url
    }, 
    20000);
</script>