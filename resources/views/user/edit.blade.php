@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
            <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Your account</h3>
            <div class="box-tools pull-right">
                <!--<a href="{{ url('/user/delete') }}" class="text-danger delthis">Delete account</a>-->
            </div>
        </div>
        <div class="box-body">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/user') }}">
                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label" for="name">Name</label>

                        <div class="col-md-2">
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="John Doe">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Email</label>

                        <div class="col-md-2">
                            <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="doe@example.com">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">New Password</label>

                        <div class="col-md-2">
                            <input type="password" class="form-control" name="newpassword" value="">
                            @if ($errors->has('newpassword'))
                                <span class="help-block">
                                <strong>{{ $errors->first('newpassword') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Current Password</label>

                        <div class="col-md-2">
                            <input type="password" class="form-control" name="password" value="">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update Userdata
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</section><!-- /.content -->
@endsection
