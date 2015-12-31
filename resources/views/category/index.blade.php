@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>
                    <div class="panel-body">
                        <ul>
                            @foreach($categories as $c)
                                <li><a href="{{ url('/category/edit',['id' => $c->id]) }}">{{ $c->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer"><a href="{{ url('/category/create') }}" title="Add new account"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
