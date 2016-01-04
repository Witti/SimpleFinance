@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
            <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Categories</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-box-tool" href="{{ url('/category/create') }}" title="Add new account"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
            </div>
        </div>
        <div class="box-body">
            <div class="panel-body">
                <table id="categoriestable" class="table table-striped table-hover table-responsive">
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
            </div><!-- /.box-body -->
        </div><!-- /.box -->
</section><!-- /.content -->
@endsection
