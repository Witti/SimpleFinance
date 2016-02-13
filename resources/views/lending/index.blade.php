@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
            <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Lendings</h3>
        </div>
        <div class="box-body">
            <div class="panel-body">
                <table id="categoriestable" class="table table-striped table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Person</th>
                        <th>Due</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lendings as $l)
                        <tr>
                            <td>{{ $l->person->firstname }} {{ $l->person->lastname }}</td>
                            <td>
                                @if($l->paid)
                                    <span class="text-success">paid</span>
                                @else
                                    {{ $l->deadline }}
                                @endif
                            </td>
                            <td>{{ $l->transaction->amountFormatted }}</td>
                            <td align="right">
                                @if(!$l->paid)
                                    <a href="{{ url('/lending/close', ['id' => $l->id]) }}" class="text-success delthis"><i class="fa fa-check"></i></a>
                                @endif
                                    <a href="{{ url('/lending', ['id' => $l->id]) }}" class="text-primary"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
</section><!-- /.content -->
@endsection
