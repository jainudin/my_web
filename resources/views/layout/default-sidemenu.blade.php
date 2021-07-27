<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="{{ URL::to('/') }}/images/photo.png" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name">Admin</p>
            <div>
              <small class="designation text-muted">Manager</small>
              <span class="status-indicator online"></span>
            </div>
          </div>
        </div>
        <button class="btn btn-success btn-block"> Transaksi
          <i class="mdi mdi-plus"></i>
        </button>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../../index.html">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic-access" aria-expanded="false" aria-controls="ui-basic-access">
        <i class="menu-icon mdi mdi-content-copy"></i>
        <span class="menu-title">Data Akses</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic-access">
        <ul class="nav flex-column sub-menu">
          
          <li class="nav-item">
            <a class="nav-link" href="{{{ URL::route('feature-group-list') }}}">Feature Group</a>
          </li>
          
        </ul>
      </div>
    </li>
    
      </ul>
</nav>