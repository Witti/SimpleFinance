@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Accounts</h3>
        </div>
        <div class="box-body">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/account/store') }}">
                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('startbalance') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Startbalance</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="startbalance" value="{{ old('startbalance') }}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('startbalance') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


    <div class="box">
        <div class="box-body">
            <div class="panel-body">
                <table id="accountstable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Accountname</th>
                            <th>Current balance</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($accounts as $a)
                        <tr>
                            <td><a href="{{ url('/account/edit',['id' => $a->id]) }}">{{ $a->title }}</a></td>
                            <td>{{ $a->currentBalance }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection
