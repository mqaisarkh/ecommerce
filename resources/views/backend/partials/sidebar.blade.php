      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
          <div class="sidebar-logo">
              <!-- Logo Header -->
              <div class="logo-header" data-background-color="dark">
                  <a href="{{ route('dashboard') }}" class="logo">
                      <img src="{{ asset('storage/' . setting('logo_white')) }}" alt="navbar brand" class="navbar-brand"
                          height="40" />

                  </a>
                  <div class="nav-toggle">
                      <button class="btn btn-toggle toggle-sidebar">
                          <i class="gg-menu-right"></i>
                      </button>
                      <button class="btn btn-toggle sidenav-toggler">
                          <i class="gg-menu-left"></i>
                      </button>
                  </div>
                  <button class="topbar-toggler more">
                      <i class="gg-more-vertical-alt"></i>
                  </button>
              </div>
              <!-- End Logo Header -->
          </div>
          <div class="sidebar-wrapper scrollbar scrollbar-inner">
              <div class="sidebar-content">
                  <ul class="nav nav-secondary">
                      <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                          <a href="{{ route('dashboard') }}">
                              <i class="fas fa-home"></i>
                              <p>Dashboard</p>
                          </a>
                      </li>
                      <li class="nav-section">
                          <span class="sidebar-mini-icon">
                              <i class="fa fa-ellipsis-h"></i>
                          </span>
                          <h4 class="text-section">Components</h4>
                      </li>

                      <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                          <a href="{{ route('users.index') }}">
                              <i class="fas fa-users"></i>
                              <p>Users</p>
                          </a>
                      </li>

                      <li class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                          <a data-bs-toggle="collapse" href="#categories"
                              class="{{ request()->routeIs('categories.*') ? '' : 'collapsed' }}"
                              aria-expanded="{{ request()->routeIs('categories.*') ? 'true' : 'false' }}">
                              <i class="fas fa-th-list"></i>
                              <p>Categories</p>
                              <span class="caret"></span>
                          </a>
                          <div class="collapse {{ request()->routeIs('categories.*') ? 'show' : '' }}" id="categories">
                              <ul class="nav nav-collapse">
                                  <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                                      <a href="{{ route('categories.index') }}">
                                          <span class="sub-item">List</span>
                                      </a>
                                  </li>
                                  <li class="{{ request()->routeIs('categories.create') ? 'active' : '' }}">
                                      <a href="{{ route('categories.create') }}">
                                          <span class="sub-item">Create</span>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </li>

                      <li class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                          <a data-bs-toggle="collapse" href="#products"
                              class="{{ request()->routeIs('products.*') ? '' : 'collapsed' }}"
                              aria-expanded="{{ request()->routeIs('products.*') ? 'true' : 'false' }}">
                              <i class="fas fa-box"></i>
                              <p>Products</p>
                              <span class="caret"></span>
                          </a>
                          <div class="collapse {{ request()->routeIs('products.*') ? 'show' : '' }}" id="products">
                              <ul class="nav nav-collapse">
                                  <li class="{{ request()->routeIs('products.list') ? 'active' : '' }}">
                                      <a href="{{ route('products.list') }}">
                                          <span class="sub-item">List</span>
                                      </a>
                                  </li>
                                  <li class="{{ request()->routeIs('products.create') ? 'active' : '' }}">
                                      <a href="{{ route('products.create') }}">
                                          <span class="sub-item">Create</span>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="nav-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                          <a data-bs-toggle="collapse" href="#blogs"
                              class="{{ request()->routeIs('blogs.*') ? '' : 'collapsed' }}"
                              aria-expanded="{{ request()->routeIs('blogs.*') ? 'true' : 'false' }}">
                              <i class="fas fa-blog"></i>
                              <p>Blogs</p>
                              <span class="caret"></span>
                          </a>
                          <div class="collapse {{ request()->routeIs('blogs.*') ? 'show' : '' }}" id="blogs">
                              <ul class="nav nav-collapse">
                                  <li class="{{ request()->routeIs('blogs.list') ? 'active' : '' }}">
                                      <a href="{{ route('blogs.list') }}">
                                          <span class="sub-item">List</span>
                                      </a>
                                  </li>
                                  <li class="{{ request()->routeIs('blogs.create') ? 'active' : '' }}">
                                      <a href="{{ route('blogs.create') }}">
                                          <span class="sub-item">Create</span>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </li>

                      <li class="nav-item {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                          <a data-bs-toggle="collapse" href="#orders"
                              class="{{ request()->routeIs('orders.*') ? '' : 'collapsed' }}"
                              aria-expanded="{{ request()->routeIs('orders.*') ? 'true' : 'false' }}">
                              <i class="fas fa-blog"></i>
                              <p>Orders</p>
                              <span class="caret"></span>
                          </a>
                          <div class="collapse {{ request()->routeIs('orders.*') ? 'show' : '' }}" id="orders">
                              <ul class="nav nav-collapse">
                                  <li class="{{ request()->routeIs('orders.list') ? 'active' : '' }}">
                                      <a href="{{ route('orders.list') }}">
                                          <span class="sub-item">List</span>
                                      </a>
                                  </li>
                                  <li class="{{ request()->routeIs('blogs.create') ? 'active' : '' }}">
                                      <a href="{{ route('blogs.create') }}">
                                          <span class="sub-item">Order details</span>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </li>



                      <li class="nav-item {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                          <a href="{{ route('settings.index') }}">
                              <i class="fas fa-cogs"></i>
                              <p>Settings</p>
                          </a>
                      </li>


                  </ul>
              </div>
          </div>
      </div>
      <!-- End Sidebar -->
