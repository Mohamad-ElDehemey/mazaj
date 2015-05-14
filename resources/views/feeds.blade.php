<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LaMusica Del Mondo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        {!!Html::style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css')!!}
        {!!Html::style('css/bootstrap.min.css')!!}
        {!!Html::style('css/fontello.css')!!}
        {!!Html::style('css/main_player.css')!!}
        {!!Html::script('js/jquery-2.1.1.min.js')!!}
        {!!Html::script('js/bootstrap.min.js')!!}
        {!!Html::style('css/Indix-style.css')!!}

    </head>
@if(!Auth::check())
    <!-- Register modal begin-->
      <div class="modal fade" id="register-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Register</h4>
      </div>
       
  {!!Form::open(['url'=>URL::to('user/new')])!!}
      <div class="modal-body">

        <div class="form-group">
          <label for="username">User Name:</label>
          {!!Form::input('text','username',Input::old('username'),['placeholder'=>'eg.:  John Medhat','class'=>'form-control'])!!}
        </div>
    
        <div class="form-group">
          <p class="alert alert-danger" id='alert-username'>
            
          </p>
        </div>

        <div class="form-group">
           <label for="email">Email :</label>
           {!!Form::input('email','email',Input::old('email'),['placeholder'=>'email@site.com','class'=>'form-control'])!!}
        </div>

        <div class="form-group">
          <p class="alert alert-danger" id='alert-email'>
            
          </p>
        </div>

        <div class="form-group">
           <label for="password">Password :</label>
           {!!Form::input('password','password',Input::old('password'),['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
          <p class="alert alert-danger" id='alert-password'>
            
          </p>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="register-btn">Save changes</button>
      </div>
    {!!Form::close()!!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- Egister modal end-->


     <!-- Login modal begin-->
      <div class="modal fade" id="login-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Login</h4>
      </div>
       
  {!!Form::open(['url'=>URL::to('user/new')])!!}
      <div class="modal-body">

        <div class="form-group">
           <label for="email">Email :</label>
           {!!Form::input('email','email',Input::old('email'),['id'=>'lgn-email','placeholder'=>'email@site.com','class'=>'form-control'])!!}
        </div>

        <div class="form-group">
          <p class="alert alert-danger" id='lgn-alert-email'>
            
          </p>
        </div>

        <div class="form-group">
           <label for="password">Password :</label>
           {!!Form::input('password','password',Input::old('password'),['id'=>'lgn-pass','class'=>'form-control'])!!}
        </div>

        <div class="form-group">
          <p class="alert alert-danger" id='lgn-alert-password'>
            
          </p>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="login-btn">Login</button>
      </div>
    {!!Form::close()!!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- Login modal end-->
@endif


    <body>
 <!-- messages modal start -->
  @if(Auth::check())
<div class="modal fade" id='mazaj-messages'>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4" id='messages-lt'>
             <div class="container-fluid">

                <div class="row message-row message-active" msg =''>
                 <div class="col-lg-4">
                   <img class="img-thumbnail" src="" />
                 </div>
                 <div class="col-lg-8">
                   <p class='sender-name'></p>
                   <p class='time'></p>
                 </div>
               </div>

               <div class="row message-row" msg ='1'>
                 <div class="col-lg-4">
                   <img class="img-thumbnail" />    </div>
                 <div class="col-lg-8">
                   <p class='sender-name'></p>
                   <p class='time'></p>
                 </div>
               </div>

             </div>
            </div>

            <div class="col-lg-8" id='messages-rt'>
              <p id='msg-content'>
              </p>
              {!!Form::open(['url'=>URL::to('/'),'id'=>'reply-area'])!!}
              <div class="form-group">
             <textarea class="form-control" rows="3" name='message-content'></textarea>
            </div>
            </div>
            
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id='send-message'>Send</button>
          {!!Form::close()!!}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  @endif
 <!-- messages modal end -->   
    @if(Auth::check())
        <nav class="navbar navbar-default navbar-default-music navbar-fixed-top">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="img/music.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Playlists</a></li>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Find Your Taste ...">
                </div>
                <button type="submit" class="btn btn-default nav-search"><span class="glyphicon glyphicon-search"></span> </button>
              </form>
              <ul class="nav navbar-nav navbar-right navbar-music ">
                <li><a href="upload.html">Upload</a></li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{$avatar}}" height="19px" width="19px"> {{Auth::user()->username}}<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="Profile.html">Profile</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="{{URL::to('user/logout')}}">Log out</a></li>
                      </ul>
                  </li>     
                 
                 <li id='show-notif'>
                 <a href="#" class="btn btn-link"><i class="fa fa-bell"></i></a>
                   <span class="navbar-text mazaj-count ">
                      
                  </span>
                 </li>

                 <li id='show-msg'>
                 <a href="#" class="btn btn-link"><i class="fa fa-envelope"></i></a>
                   <span class="navbar-text mazaj-count ">
                     
                  </span>
                 </li>


                     
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <!--End navbar-->
    @else
    <nav id="guest-nav" class="navbar navbar-default navbar-default-music navbar-fixed-top">
      <div class="container">
        <div class="row">
          <div class="container-fluid">
            <div class="row">

              <div class="col-xs-2">
                <div class="navbar-header nav-div">
                   <a  id='geust-logo' href="{{URL::to('/')}}" class="navbar-brand">Mazaj</a>

                </div>
              </div>

              <div class="col-xs-6">
                <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Find Your Taste ...">
                </div>
                <button type="submit" class="btn btn-default nav-search"><span class="glyphicon glyphicon-search"></span> </button>
              </form>
              </div>

              <div class="col-xs-4">
                <div class="navbar-right nav-div">
                  <button id='show-register' class="btn btn-default">Register</button>
                  <button id='show-login' class="btn btn-success">Login</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    @endif  
       
    <div class="container">
      <div class="row">
        <div class="container-fluid">
          <div class="row">

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
                      
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                  </div>
                  
            </div>


            </div>
            
            <div class="col-lg-4">
              sidebar
            </div>

          </div>
        </div>
      </div>
    </div>
    
    <script>BASE = '{{URL::to('/')}}'</script>
    {!!Html::script('js/main_player.js')!!}
    {!!HTML::script('js/guest.js')!!}
    </body>
   
</html>
