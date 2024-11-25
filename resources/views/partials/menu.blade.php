<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show" style="font-family: system-ui;  font-size: 15px; font-weight: bolder; @if (app()->getLocale() == 'ar') border-radius:0 0 0 60px @else border-radius:0 0 60px 0; @endif">

    <div class="c-sidebar-brand d-md-down-none" style="background: aliceblue">
        <img src="{{ asset('logo.png') }}" class="img-fluid" alt="">
    </div>

    <ul class="c-sidebar-nav" style="background: linear-gradient(130deg, rgb(37 74 119) 0%, rgb(11 19 24) 100%); @if (app()->getLocale() == 'ar') border-radius:0 0 0 60px @else border-radius:0 0 60px 0; @endif">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/user-alerts*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items"> 
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('client_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/clients*") ? "c-show" : "" }} {{ request()->is("admin/property-types*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.clientManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('client_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.clients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.client.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('property_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.property-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/property-types") || request()->is("admin/property-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.propertyType.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('contract_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.contracts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contracts") || request()->is("admin/contracts/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contract.title') }}
                </a>
            </li>
        @endcan
        @can('appointment_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.appointments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/appointments") || request()->is("admin/appointments/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-clock c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.appointment.title') }}
                </a>
            </li>
        @endcan 
        @can('technician_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/technicians*") ? "c-show" : "" }} {{ request()->is("admin/technician-types*") ? "c-show" : "" }} {{ request()->is("admin/covenants*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users-cog c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.technicianManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('technician_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.technicians.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/technicians") || request()->is("admin/technicians/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.technician.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('technician_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.technician-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/technician-types") || request()->is("admin/technician-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-center c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.technicianType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('covenant_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.covenants.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/covenants") || request()->is("admin/covenants/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-store-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.covenant.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('slider_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-image c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.slider.title') }}
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
            {{-- <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li> --}}
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>