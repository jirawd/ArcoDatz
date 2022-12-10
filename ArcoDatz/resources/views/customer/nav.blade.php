
<style>
.topnav {
    background-color: #333;
    overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

/* Right-aligned section inside the top navigation */
.topnav-right {
  float: right;
}
</style>
  
<div class="topnav">
  <a class="active" href="/index">Home</a>
  <a href="/services">Services</a>
  <a href="#contact">Contact</a>
@if (Auth::check())
  <div class="topnav-right">
    <a href="{{ url('/edit-customer/'.$customer->id) }}">Edit Profile</a>
    <a href="/logout">Logout</a>    
  </div>
@else
  <div class="topnav-right">
    <a href="/signin">Sign In</a>
    <a href="/signupC">Create Customer</a>
    <a href="/signupE">Create Employee</a>
  </div>
@endif
</div>


