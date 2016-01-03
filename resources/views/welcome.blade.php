@extends('layouts.public')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Welcome to the alpha-version of SimpleFinance, the simple trackingtool for your financial transactions.<br>
                    <br><br>
                    <a href="{{ url('/login') }}" class="btn btn-success">Login</a> <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
