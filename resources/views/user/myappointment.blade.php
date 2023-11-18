<!DOCTYPE html>
<html lang="en">
<head>

  @include('user.css')
  <style>
    table, th, td{
      text-align: center;
      padding: 10px 20px;
                 
    }
    
    .firstrow{
      background-color: #00D9A5;
      border-top: 2px solid black;
    }
    .row2{
      background-color: #2C3844;
      color: white;
    }
    .head1{
      font-size: 40px;
      padding-top: 30px;
      padding-bottom: 20px;
      text-align: center;
      
      margin-left: 93px;
      margin-right: 93px;
      margin-top: 40px;
     
    }
  </style>
</head>
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="tel:+00 123 4455 6666"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="mailto:hammaadk123@gmail.com"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
          <div class="social-mini-button">
              <a href="https://web.facebook.com/" target="_blank"><span class="mai-logo-facebook-f"></span></a>
              <a href="https://twitter.com/" target="_blank"><span class="mai-logo-twitter"></span></a>
              <a href="https://dribbble.com/" target="_blank"><span class="mai-logo-dribbble"></span></a>
              <a href="https://www.instagram.com/" target="_blank"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">One</span>-Health</a>

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('about')}}">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('Doctors')}}">Doctors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('blog')}}">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('contact')}}">Contact</a>
            </li>

            @if(Route::has('login'))
            @auth
             <li class="nav-item">
            <a class="nav-link" href="{{url('myappointment')}}" style="background-color: greenyellow; color: white;">My Appointment</a>
          </li>
            <x-app-layout>  
            </x-app-layout>
            @else
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register</a>
            </li>
            @endauth
            @endif
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>
  <div class="head1">
    <h1>My Appointments</h1>
  </div>

  <div align="Center">
  	<table>
  	<tr class="firstrow">
  		<th>Patient name</th>
  		<th>Doctor name</th>
  		<th>Date</th>
  		<th width="450px">Message</th>
  		<th>Status</th>
  		<th>Cancel Appointment</th>
  	</tr>
  	@foreach($appoint as $appoints)
  	<tr class="row2">
  		<td>{{$appoints->name}}</td>
  		<td>{{$appoints->doctor}}</td>
  		<td>{{$appoints->date}}</td>
  		<td>{{$appoints->message}}</td>
  		<td style="background-color: #ADFF2F; color:black;">{{$appoints->status}}</td>
  		<td><a href="{{url('cancel_appoint',$appoints->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel the Appointment...')">Cancel</a></td>
  	</tr>
  	@endforeach
  </table>
  </div>

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  
</body>
</html>