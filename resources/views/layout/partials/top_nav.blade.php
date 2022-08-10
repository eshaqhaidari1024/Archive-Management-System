<div class="fixed-navbar">
    <div class="pull-left">
        <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
        <h3 class="page-title"> شاروالی هرات ( مدیریت ثبت و تنظیم اسناد) </h3>
        <!-- /.page-title -->
    </div>


    <!-- /.pull-left -->
    <div class="pull-right">
<!--        <a href="" class="ico-item  ">روزنامچه
        <i class="fa fa-archive"></i>
        </a>-->

        <div class="ico-item">
            <a href="javascript:void(0);" class="ico-item mdi mdi-magnify js__toggle_open" data-target="#searchform-header"></a>
            <form action="javascript:void(0);" id="searchform-header" class="searchform js__toggle"><input type="search" placeholder="Search..." class="input-search"><button class="mdi mdi-magnify button-search" type="button"></button></form>
            <!-- /.searchform -->
        </div>
        <!-- /.ico-item -->

        <a href="javascript:void(0);" class="ico-item mdi mdi-email notice-alarm js__toggle_open" data-target="#message-popup"></a>
        <a href="javascript:void(0);" class="ico-item pulse"><span class="ico-item mdi mdi-bell notice-alarm js__toggle_open" data-target="#notification-popup"></span></a>
        <a href="javascript:void(0);" class="ico-item mdi mdi-logout js__logout"></a>


        {{-- Agencies --}}
        {{--@can('isManager')--}}
            {{--<div class="ico-item">--}}
                {{--<select name="agency_id" id="agency_id" style="color: #ffffff; background-color: #1d84df; border: none; margin-top: 15px;" class="form-control">--}}
                    {{--@foreach ($agencies as $agency)--}}
                        {{--<option value="0">عمومی</option>--}}
                        {{--<option value="{{ $agency->agency_id }}" @if ($agency->agency_id == Auth::user()->agency_id)--}}
                        {{--selected--}}
                                {{--@endif >{{ $agency->agency_name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--@endcan--}}
    </div>
    <!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->
