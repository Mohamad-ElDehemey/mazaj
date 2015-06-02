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
        
        <div class="new-pl">
          {!!Form::open([
              'class' =>'form-inline'
          ])!!}
            <div class="form-group">
              {!!Form::input('text','name','',[

              'class'       =>'form-control',
              'placeholder' =>'Playlist name',
              'id'          => 'list-name'    
              ])!!}

                <button type="submit" id='cr-new-pl'  class='btn btn-warning' name='submit'>New playlist</button>
            </div>
        </div>

        <div class="old-pl">
          <div class="list container-fluid" listid='2'>
            <div class="row">
              <div class="col-lg-8">

                <a href='#' class='list-name'>First pl</a>
            
              </div>
              <div class="col-lg-4">
                <button type="button" class="btn btn-success btn-sm add-to-list pull-right"><span class="glyphicon glyphicon-ok"></span></button>
              </div>
            </div>
          </div>


                    <div class="list container-fluid" listid='1'>
            <div class="row">
              <div class="col-lg-8">

                <strong class='btn-link list-name '>First pl</strong>
            
              </div>
              <div class="col-lg-4">
                <button type="button" class="btn btn-danger btn-sm add-to-list pull-right"><span class="glyphicon glyphicon-remove"></span></button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="col-lg-8">

            <ul id="#feed-tabs" class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Stream</a></li>
              <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Playlists</a></li>

            </ul>

            <div id="myTabContent" class="tab-content">

                  <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                    <h1 class='tab-head'>
	                    {!!$user->username!!} : latest posts
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

              $posted = App\Post::where('user_id','=',Auth::user()->id)->where('track_id','=',$post->track->id)->first();
              if($posted)
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

                            
                              
                            
                            <?php
                              $tags = App\Track::find($post->track->id)->tag('track_id','=',$post->track->id)->get();
                             ?>

                             @if($tags)
                         <div class='tag-list'>
                             @foreach($tags as $tag)
                                      <a class="btn btn-link add-to-list ctrl-btn tag" href='{!!URL::to('/')!!}/tag/id/{!!$tag->id!!}'>
                                        #{!!$tag->name!!}
                                      </span></a>
                              @endforeach
                        </div>
                              @endif      
                          
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
                                      <a class="track-owner" href='{!!URL::to("/")!!}/user/profile/{!!$post->user->id!!}'>{{$post->user->username}}</a>
                                      </p>
                                      
                                    </div>
                                    <div class="col-lg-6 rate">
                              <?php 
                                $rate = '';
                                if(Auth::check()):
                                $rate = App\Rate::where('user_id','=',Auth::user()->id)
                                                ->where('track_id','=',$post->track->id)->first();
                                if($rate)
                                $rate = $rate->rate;
                                endif;
                              ?>

                              @if($rate !='')
                                @for($i=1;$i<=$rate;$i++)
                                  <i class="fa fa-star star star-active" data='{!!$i!!}'></i>
                                @endfor
                                @for($i;$i<=5;$i++)
                                  <i class="fa fa-star star" data='{!!$i!!}'></i>
                                @endfor
                              @else 
                                      <i class="fa fa-star star" data='1'></i>
                                      <i class="fa fa-star star" data='2'></i>
                                      <i class="fa fa-star star" data='3'></i>
                                      <i class="fa fa-star star" data='4'></i>
                                      <i class="fa fa-star star" data='5'></i>
                              @endif
                                      


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
            <p> {!!$user->username!!} has no Music to share :(</p>
          @endif

        

                      </div>


                    </div>
                  </div>


                  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                  	
                  	<!-- PLAYLISTS START -->
                  		<div class="container-fluid">
                  			<div class="row">
                  			
                        
                  				<div class="col-lg-4 list-playlist">
                  					<a href="{!!URL::to('/')!!}/playlist/id/1">
                  						<img class="img-thumbnail" src='http://localhost/mazaj/storage/pics/35659.jpg'/>
                  						<div class='tracks-num'>
                  							<p class="counter">
                  								2
                  							</p>
                  							<p>Tracks</p>
                  						</div>

                  					</a>
                  				</div>


                  			</div>
                  		</div>
                  	<!-- PLAYLISTS END -->
                  </div>
                  
            </div>
@stop

@section('sidebar')
	<div class="container-fluid">
                  <div class="row">
                      
                      <div class="widget col-lg-12">
                        <h2 class="widget-title">
                          <i class="fa fa-user"></i>{!!$user->username!!}
                        </h2>

                        <div class="widget-content container-fluid">
							
							<img class="img-thumbnail" src='{!!Nav::avatar($user->id,400)!!}'/>

							<div class="user-data">
								<i class="fa fa-user-plus"></i> <count>{!!Nav::followers($user->id)->count()!!}</count> Followers
							</div>

							<div class="user-buttons">
            
            @if(Auth::check())
              @if(Auth::user()->id != $user->id)
								<button type="button" class="btn btn-default btn-sm btn-block btn-follow" data="{!!$user->id!!}" action="@if($follows)unfollow @else follow @endif">
                    @if($follows)
                    unfollow
                    @else
                    follow
                    @endif
                </button>							</div>
              @endif
            @endif
                        </div>
                      </div>
                      



                  </div>
                </div>
@stop