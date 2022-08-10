<div class="main-menu">
    <header class="header">
        <a href="javascript:void(0);" class="logo"><i class="ico mdi mdi-cube-outline"></i>بخش ادمین</a>
        <button type="button" class="button-close fa fa-times js__menu_close"></button>

        <div class="user">
            <a href="#" class="avatar">
                <img src="http://localhost/archive/public/images/1598618454.png" alt="Logo"
                                            style="max-width: 140px; max-height: 85px; margin: -35px;margin-right: -6px; border: none "><span
                        class="status online"></span></a>
            <h5 class="name"><a href="javascript:void(0)">{{ucwords(Auth::user()->name)}}</a></h5>
            <h5 class="position">مدیر</h5>
            <!-- /.name -->
            <div class="control-wrap js__drop_down">
                <i class="fa fa-caret-down js__drop_down_button"></i>
                <div class="control-list">
                    <div class="control-item"><a href="javascript:void(0)"><i class="fa fa-user"></i> پروفایل</a></div>
                    <div class="control-item"><a href="javascript:void(0);"><i class="fa fa-gear"></i> تنظیمات</a></div>
                    <div class="control-item"><a href="{{url('/logout')}}"
                                                 onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                    class="fa fa-sign-out"></i> خروج</a></div>
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
            <h5 class="title">مینوی برنامه</h5>
            <!-- /.title -->
            <ul class="menu js__accordion nav" id="sidebar">
                <li class="current nav_home">
                    <a class="waves-effect " href="javascript:ajaxLoad('{{route('home.list')}}')"><i
                                class="menu-icon mdi mdi-view-dashboard"></i><span>صفحه اصلی</span></a>
                </li>
                {{--employee reports Menu--}}

                {{--halls Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span>بخش سالون ها</span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        <li ><a href="javascript:ajaxLoad('{{route('hall.create')}}')">ثبت ولیست سالون ها :</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('reserve_hall.create')}}')"> ریزرف سالون و مینوی غذا :</a></li>
                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('reserve_hall.list')}}')">لیست  سالون های ریزرف شده:</a></li>
                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('reserve_hall.reservedFoodList')}}')">لیست غذاهای ریزرف شده:</a></li>


                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>


                {{--decoration Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span>بخش دیکوریشن ها</span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">

                        <li ><a href="javascript:ajaxLoad('{{route('decoration.create')}}')"> لیست دیکوریشن :</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('decoration.createNew')}}')">ثبت دیکوریشن جدید:</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('decoration.register')}}')"> ثبت انواع دیکوریشن  :</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('decoration.typeList')}}')"> لیست انواع دیکوریشن  :</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('decoration.createCustomerReservation')}}')">ثبت دیکوریشن مشتری :</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('decoration.list')}}')">لیست دیکوریشن مشتری :</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                {{--Music Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-account-box"></i><span>بخش میوزیک ها</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">

                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('music.listMusic')}}')">لیست
                                میوزیک ها:</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('music.listReserve')}}')"> لیست میوزیک ریزرف شده:</a>
                        </li>
                        <li><a href="javascript:ajaxLoad('{{route('music.reserve')}}')">ریزرف میوزیک:</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('music.create')}}')">ثبت میوزیک :</a></li>
                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                {{--Film Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-account-box"></i><span>بخش فلم بردار ها</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">

                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('film.list')}}')">لیست فلمبرداران
                                :</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('film.listReserve')}}')">لیست فیلم های ریزرف شده :</a>
                        </li>
                        <li><a href="javascript:ajaxLoad('{{route('film.reserve')}}')">ریزرف فلم برداری:</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('film.create')}}')">ثبت گروه فلم برداری :</a></li>
                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>


                {{--food Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-account-box"></i><span>بخش غذا ها</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">

                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('food.list')}}')">لیست غذاها :</a>
                        </li>
                        <li><a href="javascript:ajaxLoad('{{route('food.create')}}')">ثبت غذا جدید:</a></li>

                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('reserve_hall.reservedFoodList')}}')">لیست غذاهای ریزرف شده:</a></li>
                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('reserve_hall.foodList')}}')">لیست منوی غذا:</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('food.createMenue')}}')"> ثبت مینوی غذایی:</a></li>
                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>



                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-account-circle"></i><span>بخش مشتریان</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--customer Menu--}}
                        <li class="nav_user"><a href="javascript:ajaxLoad('{{route('customer.list')}}')">لیست
                                مشتریان</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('customer.create')}}')">ثبت مشتری جدید</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('customer_show_payment')}}')"> بدهی مشتریان </a></li>
                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>
                {{--comapny Menu --}}
                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-factory"></i><span> بخش شرکت ها</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--User Menu--}}
                        <li class="nav_company"><a href="javascript:ajaxLoad('{{route('company.list')}}')">لیست شرکت
                                ها</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('company.create')}}')"> ثبت شرکت جدید</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-account-circle"></i><span>بخش محصولات</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--product Menu--}}
                        <li class="nav_user"><a href="javascript:ajaxLoad('{{route('product.list')}}')">لیست
                                محصولات </a></li>
                        <li><a href="javascript:ajaxLoad('{{route('product.create')}}')">ثبت محصول جدید </a></li>
                        <li class="nav_user"><a href="javascript:ajaxLoad('{{route('category.list')}}')">لیست کتکوری</a>
                        </li>
                        <li><a href="javascript:ajaxLoad('{{route('category.create')}}')">ثبت کتگوری جدید </a></li>
                        <li class="nav_user"><a href="javascript:ajaxLoad('{{route('unit.list')}}')"> لیست واحد ها</a>
                        </li>
                        <li><a href="javascript:ajaxLoad('{{route('unit.create')}}')">ثبت واحد جدید </a></li>
                        {{-- <li class="nav_factor"><a href="javascript:ajaxLoad('{{route('destroy_product.list')}}')">لیست محصولات خراب شده</a></li>
                         <li  ><a href="javascript:ajaxLoad('{{route('destroy_product.create')}}')">ثبت محصول خراب شده</a></li>--}}
                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                {{--BuyFactor Menu --}}
                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-cart"></i><span>بخش خریداری محصولات </span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--User Menu--}}
                        <li class="nav_factor"><a href="javascript:ajaxLoad('{{route('buy_factor.list')}}')">لیست
                                فاکتورهای خرید شده</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('buy_factor.create')}}')">ثبت فاکتور جدید</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('buy_product.create')}}')">ثبت فاکتورهای خرید شده</a>
                        </li>
                        <li><a href="javascript:ajaxLoad('{{route('buy_factor.report')}}')">گزارشات فاکتور های
                                خریدشده</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('buy_product.report')}}')">پرداخت باقیات فکتور شرکت
                                ها</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>


                {{--Stock--}}
                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-cart"></i><span>بخش گدام ها</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--User Menu--}}
                        <li class="nav_factor"><a href="javascript:ajaxLoad('{{route('store.list')}}')">لیست گدام</a>
                        </li>
                        <li><a href="javascript:ajaxLoad('{{route('store.create')}}')">ثبت کدام جدید</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('stock.report')}}')">گزارشات گدام</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>


                {{--expense Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-account-box"></i><span> بخش مصارف</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--expense Menu--}}
                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('expense.list')}}')">لیست مصرف
                                ها:</a></li>
                        <li><a href="javascript:ajaxLoad('expense/create')">ثبت مصرف جدید:</a></li>
                        <li class="nav_reason_pay"><a href="javascript:ajaxLoad('{{route('reason_pay.list')}}')">لیست
                                نوع مصرف ها:</a></li>
                        <li><a href="javascript:ajaxLoad('reason_pay/create')">ثبت نوع مصرف جدید:</a></li>
                        <li><a href="javascript:ajaxLoad('{{route('expense.report')}}')">گذارشات مصارف:</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>



                <li>
                    <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-cart"></i><span>بخش پرداخت وپرداشت پول</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--User Menu--}}
                        <li class="nav_factor"><a href="javascript:ajaxLoad('{{route('money_store.list')}}')">لیست
                                پرداخت وبرداشت </a></li>
                        <li><a href="javascript:ajaxLoad('{{route('money_store.create')}}')">ثبت پرداخت وبرداشت پول</a>
                        </li>
                        <li><a href="javascript:ajaxLoad('{{route('money_store.report')}}')">گزارشات پرداخت وبرداشت
                                پول</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>


            </ul>
            <!-- /.menu js__accordion -->
        </div>
        <!-- /.navigation -->
    </div>
    <!-- /.content -->
</div>
<!-- /.main-menu -->
