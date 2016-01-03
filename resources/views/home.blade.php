@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
            <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Dashboard</h3>
        </div>
        <div class="box-body">
            <div class="panel-body">
                    Welcome!
            </div><!-- /.box-body -->
        </div><!-- /.box -->
</section><!-- /.content -->
@endsection
