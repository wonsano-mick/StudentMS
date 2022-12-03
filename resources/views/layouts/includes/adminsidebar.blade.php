<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
    style="background-color: black; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">

    {{-- Sidebar - Brand --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-smile"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WSFMS</div>
    </a>

    {{-- Divider --}}
    <hr class="sidebar-divider my-0">

    {{-- Nav Item - Admin Panel --}}
    <li class="nav-item border-bottom-info {{ Request::is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Admin Main Panel</span></a>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">

    {{-- Nav Item - Students --}}
    <li class="nav-item border-bottom-success {{ Request::is('students*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>Students</span>
        </a>
        <div id="collapseStudents" class="collapse" aria-labelledby="headingStudents" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('students.index') }}"><i class="fas fa-fw fa-cog"></i> Manage
                    Students</a>
                <a class="collapse-item" href="{{ route('graduates.index') }}"><i class="fas fa-fw fa-users"></i>
                    Past Students</a>
                <a class="collapse-item" href="{{ route('withdrawn-students') }}"><i class="fas fa-fw fa-users"
                        style="color: blue;"></i><span style="color:  blue;"> Students Withdrawn</span></a>
                <a class="collapse-item" href="{{ route('dismissed-students') }}"><i class="fas fa-fw fa-users"
                        style="color: red;"></i><span style="color: red;"> Students Dismissed</span></a>
            </div>
        </div>
    </li>
    {{-- Divider --}}
    <hr class="sidebar-divider">
    {{-- Nav Item - Class --}}
    <li class="nav-item  border-bottom-danger {{ Request::is('current-class*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#pageSubmenu" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-school"></i>
            <span>Class</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light text-white py-2 collapse-inner rounded">
                <a class="collapse-item border-bottom-success" href="{{ url('/current-class') }}"><i
                        class="fas fa-fw fa-cog"></i> Manage Class</a>
                <ul class="collapse-item list-unstyled" id="pageSubmenu">
                    @php
                        $CurrentClass = App\Models\SubCurrentClass::get();
                    @endphp
                    @foreach ($CurrentClass as $Class)
                        <a class="collapse-item"
                            href="{{ url('/current-class/class-members/' . $Class->current_class) }}">{{ $Class->current_class }}</a>
                    @endforeach
                </ul>
            </div>
        </div>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">
    {{-- Nav Item - Class --}}
    <li class="nav-item  border-bottom-primary {{ Request::is('houses*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#pageSubmenu" data-toggle="collapse" data-target="#collapseHouse"
            aria-expanded="true" aria-controls="collapseHouse">
            <i class="fas fa-fw fa-school"></i>
            <span>Houses</span>
        </a>
        <div id="collapseHouse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light text-white py-2 collapse-inner rounded">
                <a class="collapse-item border-bottom-success" href="{{ url('/houses') }}"><i
                        class="fas fa-fw fa-cog"></i> Manage House</a>
                <ul class="collapse-item list-unstyled" id="pageSubmenu">
                    @php
                        $Houses = App\Models\HouseOfAffiliation::get();
                    @endphp
                    @foreach ($Houses as $House)
                        <a class="collapse-item"
                            href="{{ url('/houses/house-members/' . $House->house_of_affiliation) }}">{{ $House->house_of_affiliation }}</a>
                    @endforeach
                </ul>
            </div>
        </div>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">
    {{-- Nav Item - Class --}}
    <li class="nav-item  border-bottom-warning {{ Request::is('scholarships*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#pageSubmenu" data-toggle="collapse" data-target="#collapseScholarship"
            aria-expanded="true" aria-controls="collapseHouse">
            <i class="fas fa-fw fa-school"></i>
            <span>Scholarships</span>
        </a>
        <div id="collapseScholarship" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light text-white py-2 collapse-inner rounded">
                <a class="collapse-item border-bottom-success" href="{{ url('/scholarships') }}"><i
                        class="fas fa-fw fa-cog"></i> Manage Scholarship</a>
                <ul class="collapse-item list-unstyled" id="pageSubmenu">
                    @php
                        $Scholarships = App\Models\Scholarship::get();
                    @endphp
                    @foreach ($Scholarships as $Scholarship)
                        <a class="collapse-item"
                            href="{{ url('/scholarships/beneficiaries/' . $Scholarship->scholarship) }}">{{ $Scholarship->scholarship }}</a>
                    @endforeach
                </ul>
            </div>
        </div>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">
    {{-- Nav Item - Class --}}
    <li class="nav-item  border-bottom-primary {{ Request::is('clubs*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#pageSubmenu" data-toggle="collapse" data-target="#collapseClub"
            aria-expanded="true" aria-controls="collapseHouse">
            <i class="fas fa-fw fa-school"></i>
            <span>Clubs</span>
        </a>
        <div id="collapseClub" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light text-white py-2 collapse-inner rounded">
                <a class="collapse-item border-bottom-success" href="{{ url('/clubs') }}"><i
                        class="fas fa-fw fa-cog"></i> Manage Clubs/Society</a>
                <ul class="collapse-item list-unstyled" id="pageSubmenu">
                    @php
                        $Clubs = App\Models\ClubSociety::get();
                    @endphp
                    @foreach ($Clubs as $Club)
                        <a class="collapse-item"
                            href="{{ url('/clubs/members/' . $Club->club) }}">{{ $Club->club }}</a>
                    @endforeach
                </ul>
            </div>
        </div>
    </li>
    {{-- Divider --}}
    <hr class="sidebar-divider">

    <!-- Nav Item - Users -->
    <li class="nav-item  border-bottom-info {{ Request::is('users') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/users') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">
    {{-- Divider --}}

    <!-- Nav Item - Users -->
    @php
        $SchoolInfoExist = App\Models\SchoolInfo::latest()->get();
    @endphp
    @if ($SchoolInfoExist->count() == 0)
        <li class="nav-item  border-bottom-info {{ Request::is('schoolInfo*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ url('/schoolInfo') }}">
                <i class="fas fa-fw fa-info"></i>
                <span>Add School Info </span>
            </a>
        </li>
        {{-- Divider --}}
        <hr class="sidebar-divider">
        {{-- Divider --}}
    @endif
</ul>
