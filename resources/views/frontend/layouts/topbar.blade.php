 {{-- ------------------navbar------------------------- --}}
 <!-- Navbar -->
 <div class="topbar">
     <a href="{{ route('homepage') }}">
         <div class="logo">
             <img src="/frontend/images/logo_image.jpg" alt="Logo">
         </div>
     </a>
     <div class="topbar-content">
         <!-- Hamburger Menu Icon for Mobile -->
         <span class="menu-toggle" onclick="toggleMenu()" aria-label="Open navigation menu" aria-expanded="false"><i
                 class="fas fa-bars"></i></span>

         <!-- Navigation Items -->
         <nav class="nav-items">
             <a href="{{ route('jobs') }}" class="nav-link">Job</a>

             <!-- Marketplace Dropdown -->
             <div class="dropdown">
                 <a href="#" class="nav-link">Marketplace</a>
                 <div class="dropdown-box">
                    <a href="{{route('development-it')}}" class="dropdown-link">Development & IT</a>
                    <a href="#" class="dropdown-link">Design & Creative</a>
                    <a href="#" class="dropdown-link">Sales & Marketing</a>
                    <a href="#" class="dropdown-link"> Artificial Intelligence</a>
                    <a href="#" class="dropdown-link"> Admin & Customer support</a>
                    <a href="#" class="dropdown-link"> Human Resources</a>
                    <a href="#" class="dropdown-link"> Data Entry</a>
                    <a href="#" class="dropdown-link">  Data Mining</a>
                 </div>
             </div>

             <a href="{{ route('blog') }}" class="nav-link">Blog</a>
             <a href="#" class="nav-link">Currency</a>
             <a href="#" class="nav-link">Language</a>

             <!-- Dropdown Menus -->
             <div class="dropdown">
                 <a href="#" class="nav-link">Job Portal &#9662;</a>
                 <div class="dropdown-content">
                     <a href="#" class="dropdown-link">Login</a>
                     <a href="#" class="dropdown-link">Signup</a>
                 </div>
             </div>
             <div class="dropdown">
                 <a href="#" class="nav-link">Marketplace &#9662;</a>
                 <div class="dropdown-content">
                     <a href="#" class="dropdown-link">Login</a>
                     <a href="#" class="dropdown-link">Signup</a>
                 </div>
             </div>
         </nav>
     </div>
 </div>

 <!-- Side Menu for Mobile -->
 <div id="side-menu" class="side-menu" role="navigation" aria-hidden="true">
     <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()" aria-label="Close navigation menu"><i
             class="fas fa-times"></i></a>
     <a href="{{ route('jobs') }}" class="side-nav-link">Job</a>

     <!-- Marketplace Dropdown -->
     <div class="dropdown">
         <a href="#" class="nav-link">Marketplace</a>
         <div class="dropdown-box">
             <a href="#" class="dropdown-link">Development & IT</a>
             <a href="#" class="dropdown-link">Design & Creative</a>
             <a href="#" class="dropdown-link">Sales & Marketing</a>
             <a href="#" class="dropdown-link"> Artificial Intelligence</a>
             <a href="#" class="dropdown-link"> Admin & Customer support</a>
             <a href="#" class="dropdown-link"> Human Resources</a>
             <a href="#" class="dropdown-link"> Data Entry</a>
             <a href="#" class="dropdown-link">  Data Mining</a>
         </div>
     </div>

     <a href="{{ route('blog') }}" class="side-nav-link">Blog</a>
     <a href="#" class="side-nav-link">Currency</a>
     <a href="#" class="side-nav-link">Language</a>

     <!-- Side Menu Dropdowns -->
     <div class="side-dropdown">
         <button class="side-dropbtn">Job Portal &#9662;</button>
         <div class="side-dropdown-content">
             <a href="#" class="dropdown-link">Login</a>
             <a href="#" class="dropdown-link">Signup</a>
         </div>
     </div>

     <div class="side-dropdown">
         <button class="side-dropbtn">Marketplace &#9662;</button>
         <div class="side-dropdown-content">
             <a href="#" class="dropdown-link">Login</a>
             <a href="#" class="dropdown-link">Signup</a>
         </div>
     </div>
 </div>

 <!-- Overlay -->
 <div id="overlay" class="overlay" onclick="closeMenu()"></div>

 {{-- ------------------navbar------------------------- --}}
