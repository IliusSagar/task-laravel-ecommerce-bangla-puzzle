<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ URL('/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

         
        <!-- Category Sidebar  -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
             
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('category.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Category</p>
                </a>
                <a href="{{ route('category.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
               
              </li>  
            </ul>
          </li>

           <!-- Subcategory Sidebar  -->
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Subcategory
                <i class="fas fa-angle-left right"></i>
           
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('subcategory.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Subcategory</p>
                </a>
                <a href="{{ route('subcategory.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Subcategory</p>
                </a>
               
              </li>  
            </ul>
          </li>

        <!-- Products Sidebar  -->
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Products 
                <i class="fas fa-angle-left right"></i>
           
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Products</p>
                </a>
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Products</p>
                </a>
               
              </li>  
            </ul>
          </li>

        
        
       
         
          
        

          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                            @csrf
            <a href="{{ route('logout')}}" class="nav-link"  onclick="event.preventDefault();
                                                this.closest('form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
             
              </p>
            </a>
            </form>
          </li>

       
         
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>