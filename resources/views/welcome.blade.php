@extends('layout.layout')
@section('content')

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Simple Form</h3>
            </div>
            <div class="panel-body">
                <form role="form" class="ls_form">
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" placeholder="Enter email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="Password" name="password" class="form-control">
                    </div>
                    <div class="checkbox i-checks">
                        <label>
                            <input type="checkbox" name="check_out" checked="checked">
                            <i></i> Check me out
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-default" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
