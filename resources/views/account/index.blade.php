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
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection
