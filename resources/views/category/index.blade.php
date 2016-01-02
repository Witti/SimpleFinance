@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories<a class="pull-right" href="{{ url('/category/create') }}" title="Add new account"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a></div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Color</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $c)
                                    <tr>
                                        <td>{{ $c->title }}</td>
                                        <td><div class="category-color-box" style="background-color: {{ $c->color }};"></div></td>
                                        <td align="right">
                                            <a href="{{ url('/category/edit', ['id' => $c->id]) }}" class="text-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a class="text-danger delthis" href="{{ url('/category/delete', ['id' => $c->id]) }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
