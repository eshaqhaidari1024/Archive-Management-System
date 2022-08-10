
@extends('layout.login.master')
@section('content')

    <div id="single-wrapper">
        <form action="{{route('login')}}" class="frm-single"   method="POST">
            {{csrf_field()}}
            <div class="inside">
                <div class="wrapper-image" style="display: flex;justify-content: center;align-content: center; margin-bottom: 20px">
                    <img src="{{asset('storage/images/letter/mun.png')}}" alt="">
                </div>
{{--                <h4 class="text-center">سیستم مدیریت آرشیف</h4>--}}

                <!-- /.frm-title -->
                <div class="frm-input {{$errors->has('username') ?'has-error':''}}"><input type="text" placeholder="نام کاربری" class="frm-inp" onfocus="this.removeAttribute('readonly');" readonly name="username"><i class="fa fa-user frm-ico" ></i>
                    {!! $errors->first('username','<span class="help-block">:message</span>') !!}
                </div>
                <!-- /.frm-input -->
                <div class="frm-input {{$errors->has('password') ?'has-error':''}}"><input type="password" placeholder="رمز عبور" autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly class="frm-inp" name="password"><i class="fa fa-lock frm-ico"></i>
                    {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                </div>
                <!-- /.frm-input -->
                <div class="clearfix margin-bottom-20">
                    <div class="pull-left">
                        <div class="checkbox primary"><input type="checkbox" id="remember" name="remember"><label for="remember">مرا بخاطر بسپار</label></div>
                        <!-- /.checkbox -->
                    </div>
                    <!-- /.pull-left -->
                    <div class="pull-right"><a href="page-recoverpw.html" class="a-link"><i class="fa fa-unlock-alt"></i>فراموشی رمز عبور</a></div>
                    <!-- /.pull-right -->
                </div>
                <!-- /.clearfix -->
                <button type="submit" class="frm-submit">وارد شدن<i class="fa fa-arrow-circle-right"></i></button>




                <!-- /.footer -->
            </div>
            <!-- .inside -->
        </form>
        <!-- /.frm-single -->
    </div><!--/#single-wrapper -->


    @endsection
