<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class=""> <a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
                <li class="list-divider"></li>
                <li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{ route('form/allbooking') }}"> All Booking </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Customers </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="active" href="{{ route('form/allcustomers/page') }}"> All customers </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Rooms </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{ route('form/allrooms/page') }}">All Rooms </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Room Type </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{ route('form/allroomstype/page') }}">All Rooms </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>