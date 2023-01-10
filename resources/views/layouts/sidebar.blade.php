@php
    $product_packaging_detail = Request::is('product-packaging-detail*');
@endphp
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- User detail -->
            <div class="user-details">
                <div class="overlay"></div>
                <div class="text-center">
                    <img src="assets/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <div>
                        <a href="#setting-dropdown" class="dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">Daniel Syme <span class="mdi mdi-menu-down"></span></a>
                    </div>
                </div>
            </div>
            <!-- end user detail -->

            <div class="dropdown" id="setting-dropdown">
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)"><i class="mdi mdi-face-profile m-r-5"></i> Profile</a></li>
                    <li><a href="javascript:void(0)"><i class="mdi mdi-account-settings-variant m-r-5"></i> Settings</a>
                    </li>
                    <li><a href="javascript:void(0)"><i class="mdi mdi-lock m-r-5"></i> Lock screen</a></li>
                    <li><a href="javascript:void(0)"><i class="mdi mdi-logout m-r-5"></i> Logout</a></li>
                </ul>
            </div>

            <ul>
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{  route('dashboard')  }}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span> Dashboard
                        </span></a>
                </li>
                <li>
                    <a href="{{  route('product-packaging-detail.index')  }}" class="waves-effect {{ $product_packaging_detail ? 'active' : '' }}"><i class="mdi mdi-invert-colors"></i><span> Product Packaging Detail
                        </span></a>
                </li>
                <li>
                    <a href="{{  route('product-price-conversion.index')  }}" class="waves-effect"><i class="mdi mdi-layers"></i><span> Product Price
                        </span></a>
                </li>

                {{-- <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-invert-colors"></i> <span> Product </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="ui-buttons.html">Product Packaging Detail</a></li>
                    </ul>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

        <div class="help-box">
            <h5 class="text-muted m-t-0">For Help ?</h5>
            <p class=""><span class="text-dark"><b>Email:</b></span> <br /> support@support.com</p>
            <p class="m-b-0"><span class="text-dark"><b>Call:</b></span> <br /> (+123) 123 456 789</p>
        </div>

    </div>
    <!-- Sidebar -left -->

</div>
