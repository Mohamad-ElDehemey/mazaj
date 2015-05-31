@extends('feeds')
@section('main')

<!-- 
========== ADD TO PLAYLIST ==============
-->
{!!Form::token()!!}
<div class="modal fade" id='add-to-pl'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="col-lg-8">

            <ul id="#feed-tabs" class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Stream</a></li>
              <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Explore</a></li>

            </ul>

            <div id="myTabContent" class="tab-content">

                  <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                    <h1 class='tab-head'>
                     Hear the latest posts from the people you're following
                    </h1>

                    <div class="tab-content">
                      
                      <div class="container-fluid stream">

          @if($posts->count())
					@foreach($posts as $post)

          <?php 

            $posted = false;
            $liked  =false;

            if(Auth::check()){

              $like = App\Like::where('track_id','=',$post->track->id)->where('user_id','=',Auth::user()->id)->first();
              if($like)
                $like = true;

              $post = App\Post::where('user_id','=',Auth::user()->id)->where('track_id','=',$post->track->id)->first();
              if($post)
                $posted = true;

            }
            
          ?>
					<!-- post item start -->
                      	<div class="row item-row" id='{!!$post->track->id!!}' status='off' track='{!!$post->track->name!!}.mp3' afterPuase='false'>
                      		<div class="container-fluid no-padding">
                      			<div class="row">
                      				<div class="col-lg-4">
										<div class='player-post-data'>
											<img class="img-responsive cover" src='{!!URL::to("/")!!}/storage/pics/{!!$post->track->cover!!}'/>
										</div>
							
                      				</div>
                      				<div class="col-lg-8 no-padding">
                      					
                      					<div class="player-ctrl container-fluid no-padding">
                      						<div class="row">
                      							<div class="col-lg-8">
                      								<a class="btn btn-link prev ctrl-btn"><span class="glyphicon  glyphicon-backward"></span></a>
                      								<a class="btn btn-link play ctrl-btn"><span class="glyphicon glyphicon-play"></span></a>
                      								<a class="btn btn-link next ctrl-btn"><span class="glyphicon glyphicon-forward"></span></a>
                      								<a class="btn btn-link add-to-list ctrl-btn"><span class="glyphicon glyphicon-list-alt"></span></a>
                      							</div>
                      							<div class="col-lg-4">
                      								<div class="action-btn">
                      									<p>
                                          <a type="button" class="btn btn-link share ctrl-btn @if($posted) used-btn @endif" action='@if($posted)unshare @else share @endif'>
                                            <span class="glyphicon glyphicon-retweet"></span>
                                          </a>
                                        </p>
                      									
                      								</div>
                      								<div class="action-btn">
                      									<p><a type="button" class="btn btn-link share ctrl-btn @if($liked)used-btn @endif" action='@if($liked)unlike @else like @endif'><span class="fa fa-heart"></span></a></p>
                      									<p class='action-count'>{!!App\Like::where('track_id','=',$post->track->id)->get()->count()!!}</p>
                      								</div>
                      							</div>
                      						</div>
                      					</div>

                      					<div class="track-name container-fluid">
                      						<div class="row">
                      							<div class="col-lg-6">
                      								<p>
                      								<strong>{{$post->track->title}}</strong>
                      								<a class="track-owner" href='{!!URL::to("/")!!}/user/{!!$post->user->id!!}'>{{$post->user->username}}</a>
                      								</p>
                      								
                      							</div>
                                    <div class="col-lg-6 rate">
                                      <i class="fa fa-star star" data='1'></i>
                                      <i class="fa fa-star star" data='2'></i>
                                      <i class="fa fa-star star" data='3'></i>
                                      <i class="fa fa-star star" data='4'></i>
                                      <i class="fa fa-star star" data='5'></i>
                                    </div>
                      						</div>
                      					</div> 

                      					<div class="track-seeker container-fluid">
                      						<div class="timer seeker-div">
                      							<p></p>
                      						</div>
                      						<div class="seeker-div seeker">
                      							<div class="seeker-inner"></div>
                      						</div>
                      					</div>
                      				</div>
                      			</div>
                      		</div>
                      	</div>
					<!-- post item end -->
          @endforeach
          @else
            <p>Sorry, There are no music to view, Be the first publisher. <a href="{!!URL::to('upload')!!}">Upload</a> your awesom music!</p>
          @endif

        

                      </div>


                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                  </div>
                  
            </div>
@stop