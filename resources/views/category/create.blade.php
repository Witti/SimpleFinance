@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
            <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">New category</h3>
        </div>
        <div class="box-body">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/category/store') }}">
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

                    <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Color</label>

                        <div class="col-md-6">
                            <div class="input-group categorycolor">
                                <input type="text" value="#{{ old('color',substr(md5(rand()), 0, 6)) }}" name="color" class="form-control" />
                                <span class="input-group-addon"><i></i></span>
                            </div>

                            @if ($errors->has('color'))
                                <span class="help-block">
                                <strong>{{ $errors->first('color') }}</strong>
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
            </div><!-- /.box-body -->
        </div><!-- /.box -->
</section><!-- /.content -->
@endsection
