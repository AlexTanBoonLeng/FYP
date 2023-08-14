
<!doctype html>
<html lang="en">
  <style>


ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f8f9fa;
}

li a {
  display: block;
  color: #000;
  padding: 8px 6px;
  text-decoration: none;
}

/* Change the link color on hover */
li a:hover {
  background-color: grey;
  color: white;
}


  </style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Campus Network</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
     
      <ul class="navbar-nav me-2  mb-3 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          @if(session()->has('user'))
    <p> {{ session('user')->name }}</p>
@endif
          </a>
        
          <ul class="dropdown-menu">
          
           
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            </form>
          </ul>
        </li>
</ul>
    </div>
  </div>
</nav>
  </head>
 
 <ul>
  <li><a href="{{ route('lecturer.timetable',session('user')->userID) }}">View Timetable</a></li>

</ul>

</html>