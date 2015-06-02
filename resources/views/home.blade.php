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
              @if(Auth::check())
              <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Explore</a></li>
              @endif
            </ul>

            <div id="myTabContent" class="tab-content">

                  <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                  @if(Auth::check())
                    <h1 class='tab-head'>
                     Hear the latest posts from the people you're following
                    </h1>
                  @endif
                    <div class="tab-content">
                      
                      <div class="container-fluid stream">
          @if(Auth::check())
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
            <p>Sorry, There are no music to view, Be the first publisher. <a href="{!!URL::to('upload')!!}">Upload</a> your awesom music!</p>
          @endif
          @else
          VISITOR
          @endif

        

                      </div>


                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                  </div>
                  
            </div>
@stop

@section('sidebar')
 @if(Auth::check())
                <div class="container-fluid">
                  <div class="row">
                      
                      <div class="widget col-lg-12">
                        <h2 class="widget-title">
                          <i class="fa fa-users"></i>They have your same taste
                        </h2>

                        <div class="widget-content container-fluid">
<!-- friend row-->
                          <div class="row no-padding fr-row">

                            <div class="col-lg-2 no-padding">
                              <img class="img-responsive" src='http://lorempixel.com/400/400'/>
                            </div>

                            <div class="col-lg-5">
                              <div class='fr-name'><a href="#" >Nadia Hussein</a></div>
                              <div class='fr-count'><i class="fa fa-user-plus"></i>17152</div>
                            </div>

                            <div class="col-lg-5">
                              <button type="button" class="btn btn-default btn-sm btn-block btn-follow" data='1' action=' follow '>Follow</button>
                            </div> 
                          </div>
<!-- fr end -->

<!-- friend row-->
                          <div class="row no-padding fr-row">

                            <div class="col-lg-2 no-padding">
                              <img class="img-responsive" src='http://lorempixel.com/400/400'/>
                            </div>

                            <div class="col-lg-5">
                              <div class='fr-name'><a href="#" >Samy Hussein</a></div>
                              <div class='fr-count'><i class="fa fa-user-plus"></i>17152</div>
                            </div>

                            <div class="col-lg-5">
                              <button type="button" class="btn btn-default btn-sm btn-block btn-follow" data='1' action=' follow '>Follow</button>
                            </div> 
                          </div>
<!-- fr end -->
                        </div>
                      </div>
                      



                  </div>
                </div>
              @endif
@stop