<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
  
  @foreach(App\Models\FeatureGroup::orderBy('feature_group_order','asc')->get() as $menuItem)
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic-{{ $menuItem->feature_group_name }}" aria-expanded="false" aria-controls="ui-basic-access">
          <i class="menu-icon mdi mdi-television"></i>
          <span class="menu-title">{{ $menuItem->feature_group_name }}</span>
        </a>
        <div class="collapse" id="ui-basic-{{ $menuItem->feature_group_name }}">
        <ul class="nav flex-column sub-menu">
        @foreach(App\Models\feature::where('feature_group_id',$menuItem->feature_group_id)->get() as $subMenuItem)
          <li class="nav-item">
            <a class="nav-link" href="{{ url($subMenuItem->feature_url) }}">
            <i class="{{ $subMenuItem->feature_icon }}"></i>
              {{ $subMenuItem->feature_name }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>
     </li>
  @endforeach
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