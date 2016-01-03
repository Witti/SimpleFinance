@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
            <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Accounts</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-box-tool" href="{{ url('/account/create') }}" title="Add new account"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
            </div>
        </div>
        <div class="box-body">
            <ul>
                @foreach($accounts as $a)
                    <li><a href="{{ url('/account/edit',['id' => $a->id]) }}">{{ $a->title }}</a></li>
                @endforeach
            </ul>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection
