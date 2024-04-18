<!-- navbar -->
<nav class="navbar navbar-light bg-light" id="navbar">
       
       <div class="d-flex justify-content-between w-100">
           <div class="d-flex align-items-center">
               <button onclick="openNav()" class="openbtn openbtn-custom-style" id="menuButton">☰</button>
               <img src="{{ asset('images/gjc_logo.png') }}" alt="GJC Logo" class="logo-image mr-1" style="width: 34px;">
               <a class="navbar-brand" href="/"> GJC {{ $navbarTitle ?? 'Library' }}</a>
           </div>
           <div class="text-center d-none d-md-block mt-3"> <!-- Added d-none d-md-block classes here -->
                <div class="input-group mb-3">
                <input type="text" class="form-control input-lg" style="width: 350px;" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button"> <i class="fa-solid fa-search"></i></button>
            </div>

       </div>
       <!-- User avatar -->
       <div class="d-flex align-items-center">
           <div class="profile-pic border border-secondary rounded">
               <button id="themeToggleBtn" class="btn" onclick="toggleTheme()"><i class="fas fa-moon"></i></button>
           </div>
           <div class="btn-group dropstart">
            <img src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="Profile Picture" class="mx-2 dropdown-toggle profile-pic" style="cursor: pointer" data-bs-toggle="dropdown" aria-expanded="false">

            <ul class="dropdown-menu" style="padding-bottom: 0;">
                <li><a class="dropdown-item" href="#">Account</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item logout-btn"><span class="fw-bold">Logout</span></button>
                    </form>
                </li>
            </ul>
        </div>

           <!-- <div class="profile-pic  mx-2">
               <img src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="Profile Picture">
           </div>
           <div class="mr-2">
               <form action="{{ route('logout') }}" method="post">
                   @csrf
                   <button type="submit" class="btn btn-primary mt-2">Logout</button>
               </form>
           </div> -->
       </div>
       <div class="collapse sidebar-collapse" id="basic-navbar-nav">
           <ul class="navbar-nav mr-auto">
               <li class="nav-item"><a class="nav-link text-dark" href="">">Signin</a></li>
               <li class="nav-item"><a class="nav-link text-dark" href="">">Register</a></li>
               <li class="nav-item"><a class="nav-link text-dark" href="">Team</a></li>
               <li class="nav-item"><a class="nav-link text-dark" href="">Home</a></li>
           </ul>
       </div>
   </nav>

   <!-- sidebar-->
   <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="">Books</a>
        <a href="">Categories</a>
        <a href={{ route('about') }}>About</a>
        <a href="">Team</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>