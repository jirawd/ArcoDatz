
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
 @if (Auth::check())
        <div class="topnav">
        @if (Auth::user()->role == "Admin")
              <a class="active" href="/adminprofile">Profile</a>
              <a href="/checkup">Check Ups</a>
              <a href="/medicalhistory">Medical History</a>
              <a href="/services">Services</a>
              <a href="/servicetransactions">Transactions</a>
              <a href="/chartsdate">Service Chart</a>
              <div class="topnav-right">
                <a href="/logout">Logout</a>    
              </div>
            </div>
        @elseif(Auth::user()->role == "Customer")
        <a class="active" href="/customerprofile">Profile</a>
        <a href="/services">Services</a>
        <div class="topnav-right">
          
                <a href="/logout">Logout</a>    
              </div>
            </div>
        @else
              <a class="active" href="/employeeprofile">Profile</a>
              <a href="/checkup">Check Ups</a>
              <a href="/medicalhistory">Medical History</a>
              <a href="/services">Services</a>
              <a href="/servicetransactions">Transactions</a>
              <a href="/chartsdate">Service Chart</a>
              <div class="topnav-right">
                <a href="/logout">Logout</a>    
              </div>
            </div>
        @endif
       
        
@else
      <div class="topnav">
        <a class="active" href="/services">Services</a>
        <div class="topnav-right">
          <a href="/signin">Sign In</a>
          <a href="/signupC">Create Customer</a>
          <a href="/signupE">Create Employee</a>
        </div>
      </div>
@endif
</div>


