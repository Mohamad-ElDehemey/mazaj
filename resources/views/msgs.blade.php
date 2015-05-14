
@foreach($msgs as $msg)
<div class="row message-row @if($msg->new){{'new-msg'}} @endif" msg ='{{$msg->id}}'>
	<div class="col-lg-4">
		<img class="img-thumbnail" src="http://www.gravatar.com/avatar/{{md5( strtolower( trim( $msg->sender->email ) ) ) }}&s=100" />
	</div>
	<div class="col-lg-8">
		<p class='sender-name'>{{$msg->sender->username}}</p>
		<p class='time'>{{date('D-F-Y',strtotime($msg->created_at))}}</p>
	</div>
</div>
@endforeach