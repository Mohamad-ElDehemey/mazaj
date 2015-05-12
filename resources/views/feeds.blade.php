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
    <body>
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
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-bell"></span> </a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
                  </li>  
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-envelope"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
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
       

    <div class="footer navbar-fixed-bottom">
        <footer id='footer_wrap' class="footer navbar-fixed-bottom">
            <div id='footer_arrow' align='center'>hide</div>
            <div id='player' align='center'><br><br>under construction ;)</div>
        </footer>
    </div>
    
    <script>BASE = '{{URL::to('/')}}'</script>
    {!!Html::script('js/main_player.js')!!}
    {!!HTML::script('js/guest.js')!!}
    </body>
   
</html>
