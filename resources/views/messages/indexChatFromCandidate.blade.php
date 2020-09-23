<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <?php 
                    $candiuser = Session::get('userEmail');
                    $candidate = DB::select("select id from candidates where email ='".$candiuser."'"); 
                    if($candidate[0]->id){
                        $candiID = $candidate[0]->id;//Auth::id();    
                    }else{
                        $candiID = null;
                    }
                ?>
                <div class="{{ ($message->from == $candiID) ? 'sent' : 'received' }}">
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
    $('ul .active').trigger('click');
    }, 
    20000);
</script>