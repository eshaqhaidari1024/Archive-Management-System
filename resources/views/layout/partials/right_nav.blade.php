<div class="main-menu">
    <header class="header">
        <a href="javascript:void(0);" class="logo"><i class="ico mdi mdi-cube-outline"></i>بخش ادمین</a>
        <button type="button" class="button-close fa fa-times js__menu_close"></button>
        <div class="user">
            <a href="javascript:void(0)" class="avatar">
                <img src="{{asset('storage/images/letter/user-profile.jpg')}}"
                     alt=""
                     style=" ;margin-right: 6px; border: none ;margin-right: 6px;
    border: none;
    object-position: left;
    height: 65px;
    width: 64px;
    object-fit: cover;">
                <span class="status online"></span>
            </a>
            <h5 class="name text-right">
                <a href="javascript:void(0)">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
            </h5>
            @if (Auth::user()->user_level == 1)
                <h5 class="position text-right">مدیر عمومی</h5>
            @elseif (Auth::user()->user_level == 2)
                <h5 class="position text-right">مدیر</h5>
            @else
                <h5 class="position text-right">کاربر عادی</h5>
        @endif
        <!-- /.name -->
            <div class="control-wrap js__drop_down">
                <i class="fa fa-caret-down js__drop_down_button"></i>
                <div class="control-list">
                    <div class="control-item">
                        <a href="javascript:ajaxLoad('{{route('user.userInfo',Auth::user()->id)}}')"><i
                                    class="fa fa-user"></i> حساب کاربری</a>
                    </div>
                    <div class="control-item">
                        <a href="{{url('/logout')}}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                    class="fa fa-sign-out"></i> خروج</a>
                    </div>
                    <form action="{{route('logout')}}" method="POST" id="logout-form" style="display: none;">
                        {{csrf_field()}}
                    </form>
                </div>
                <!-- /.control-list -->
            </div>
            <!-- /.control-wrap -->
        </div>
        <!-- /.user -->
    </header>
    <!-- /.header -->
    <div class="content">

        <div class="navigation">

            <!-- /.title -->
            <ul class="menu js__accordion nav" id="sidebar">
                <li class="current nav_home">
                    <a class="waves-effect " href="javascript:ajaxLoad('{{route('home.list')}}')"><i
                                class="menu-icon mdi mdi-view-dashboard"></i><span>صفحه اصلی</span></a>
                </li>

				<!--company and customer section -->
                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-file"></i><span>مکتوب های صادره و وارده</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">

                        <li class="nav_company"><a href="javascript:ajaxLoad('{{route('letter.list')}}')">لیست مکاتب وارده و صادره
						<li ><a href="javascript:ajaxLoad('{{route('letter.create')}}')">ثبت مکتوب جدید</a></li>



                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>
                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-file"></i><span>گزارش مکاتیب</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">


						<li ><a href="javascript:ajaxLoad('{{route('letter.report')}}')">گزارش</a></li>


                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-package-variant"></i><span>ایجاد بخش ها</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">

                        <li class="nav_company"><a href="javascript:ajaxLoad('{{route('dep.list')}}')">لیست بخش ها
						<li ><a href="javascript:ajaxLoad('{{route('dep.create')}}')">ایجاد بخش</a></li>







                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>
                <li>

                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-backup-restore"></i><span>ایجاد فایل پشتیبانی</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">

                        <li class="nav_company"><a href="javascript:ajaxLoad('{{route('backup.index')}}')">لیست فایل های پشتیبانی</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

				@if(\Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::MANAGER)
                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                            class="menu-icon mdi mdi-account"></i><span>لیست کاربران</span><span
                            class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        <li class="nav_company"><a href="javascript:ajaxLoad('{{route('user.list')}}')">لیست کاربران</a></li>
                        <li class="nav_company"><a href="javascript:ajaxLoad('{{route('user.create')}}')">ایجاد کاربر جدید</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                @endif

{{--                @if (Gate::check('isManager'))--}}
{{--                    --}}{{--User Menu--}}
{{--                    <li>--}}
{{--                        <a class="waves-effect parent-item js__control" href="#"><i--}}
{{--                                    class="menu-icon mdi mdi-account-multiple"></i><span>بخش تنظیات</span><span--}}
{{--                                    class="menu-arrow fa fa-angle-down"></span></a>--}}
{{--                        <ul class="sub-menu js__content nav" id="nav-sidebar">--}}
{{--                            --}}{{--User Menu--}}
{{--                            <li class="nav_setting_general"><a--}}
{{--                                        href="javascript:ajaxLoad('{{route('options.general')}}')">تنظیات عمومی</a></li>--}}


{{--                            <li class="nav_setting_person_information"><a--}}
{{--                                        href="javascript:ajaxLoad('{{route('options.personality')}}')">تنظیات اطلاعات--}}
{{--                                    شرکت</a></li>--}}

{{--                            @can('isManager')--}}
{{--                                <li class="nav_user"><a href="javascript:ajaxLoad('{{route('user.list')}}')">لیست--}}
{{--                                        کاربر</a></li>--}}
{{--                                <li><a href="javascript:ajaxLoad('{{route('user.create')}}')">ثبت کاربر جدید</a></li>--}}


{{--                                <li class="nav_user"><a href="javascript:ajaxLoad('{{route('backup.index')}}')">بکاب--}}
{{--                                        جدید</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                        </ul>--}}
{{--                        <!-- /.sub-menu js__content -->--}}
{{--                    </li>--}}
{{--                @endif--}}

            </ul>
            <!-- /.menu js __accordion -->
        </div>
        <!-- /.navigation -->
    </div>
    <!-- /.content -->
</div>
<!-- /.main-menu -->
