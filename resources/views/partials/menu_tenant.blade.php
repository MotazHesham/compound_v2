<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show" style="font-family: system-ui;  font-size: 15px; font-weight: bolder; @if (app()->getLocale() == 'ar') border-radius:0 0 0 60px @else border-radius:0 0 60px 0; @endif">

    <div class="c-sidebar-brand d-md-down-none" style="background: aliceblue">
        <img src="{{ asset('logo.png') }}" class="img-fluid" alt="">
    </div>

    <ul class="c-sidebar-nav" style="background: linear-gradient(130deg, rgb(37 74 119) 0%, rgb(11 19 24) 100%); @if (app()->getLocale() == 'ar') border-radius:0 0 0 60px @else border-radius:0 0 60px 0; @endif">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("tenant.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li> 
        <li class="c-sidebar-nav-item">
            <a href="{{ route("tenant.contracts.index") }}" class="c-sidebar-nav-link {{ request()->is("tenant/contracts") || request()->is("tenant/contracts/*") ? "c-active" : "" }}">
                <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.contract.title') }}
            </a>
        </li> 
        <li class="c-sidebar-nav-item">
            <a href="{{ route("tenant.appointments.index") }}" class="c-sidebar-nav-link {{ request()->is("tenant/appointments") || request()->is("tenant/appointments/*") ? "c-active" : "" }}">
                <i class="fa-fw far fa-clock c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.appointment.title') }}
            </a>
        </li> 
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('tenant/profile/password') || request()->is('tenant/profile/password/*') ? 'c-active' : '' }}" href="{{ route('tenant.profile.password.edit') }}">
                <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                </i>
                {{ trans('global.change_password') }}
            </a>
        </li> 
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>