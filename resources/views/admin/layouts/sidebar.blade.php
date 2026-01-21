 <!-- Sidebar -->
 <nav class="col-md-3 col-lg-2 d-md-block bg-white border-end p-0">

     <div class="offcanvas-md offcanvas-start" tabindex="-1" id="sidebarMenu">
         <div class="offcanvas-header">
             <h6 class="offcanvas-title text-uppercase text-muted">
                 Admin Panel
             </h6>
             <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
         </div>

         <div class="offcanvas-body d-md-flex flex-column p-3 overflow-y-auto">

             <ul class="nav nav-pills flex-column gap-1 mb-auto">
                 <li class="nav-item">
                     <a href="{{ route('admin.index') }}"
                         class="@if(request()->routeIs('admin.index')) nav-link active bg-dark @else nav-link text-dark @endif ">
                         Dashboard
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('admin.posts.index') }}" class=" @if(request()->routeIs('admin.posts.index')) nav-link active bg-dark @else nav-link text-dark @endif ">
                         Posts
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('admin.users.index') }}" class=" @if(request()->routeIs('admin.users.index')) nav-link active bg-dark @else nav-link text-dark @endif">
                         Users
                     </a>
                 </li>


             </ul>

             <hr class="my-3">

             <ul class="nav flex-column">
                 <li class="nav-item">
                     <a href="#" class="nav-link text-danger" onclick="document.getElementById('adminLogoutForm').submit()">
                         Logout
                     </a>
                     <form id="adminLogoutForm" action="{{ route('admin.logout') }}" method="post">
                         @csrf
                     </form>
                 </li>
             </ul>

         </div>
     </div>
 </nav>