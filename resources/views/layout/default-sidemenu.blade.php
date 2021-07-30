
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MY-WEB</div>
    </a>
    @foreach(App\Models\FeatureGroup::orderBy('feature_group_order','asc')->get() as $menuItem)
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" id="{{  str_replace(' ', '-', $menuItem->feature_group_id)  }}" href="#collapse_{{  str_replace(' ', '-', $menuItem->feature_group_id)  }}" data-toggle="collapse" data-target="#collapse_{{  str_replace(' ', '-', $menuItem->feature_group_id)  }}"
            aria-expanded="false" aria-controls="collapse_{{  str_replace(' ', '-', $menuItem->feature_group_id)  }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{ $menuItem->feature_group_name }}</span>
        </a>
        <div id="collapse_{{ str_replace(' ', '-', $menuItem->feature_group_id)  }}" class="collapse" aria-labelledby="headingTwo" data-parent="#collapse_{{ str_replace(' ', '-', $menuItem->feature_group_id)  }}">
            <div class="bg-white py-2 collapse-inner rounded">
            @foreach(App\Models\feature::where('feature_group_id',$menuItem->feature_group_id)->get() as $subMenuItem)
                <a class="collapse-item" id="collapse_item_{{ $subMenuItem->feature_id }}" href="{{ url($subMenuItem->feature_url) }}">
                <i class="{{ $subMenuItem->feature_icon  }}"></i>
                  {{ $subMenuItem->feature_name }}
                </a>
            @endforeach
            </div>
        </div>
    </li>
   
@endforeach

 <!-- Divider -->
 <hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>