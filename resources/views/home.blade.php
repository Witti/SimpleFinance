@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Welcome!</small>
    </h1>
</section>
<section class="content">
    @include('layouts.partials.alert')
    @if($accounts)
        <section class="content-header">
            <h4>
                Accounts
            </h4>
        </section>
        <div class="row">
            @foreach($accounts as $a)
                <div class="col-lg-3 col-xs-7">
                    <!-- small box -->
                    <div class="small-box @if($a->currentBalanceRaw < 0) bg-red @else bg-green @endif">
                        <div class="inner">
                            <h3>{{ $a->CurrentBalance }}</h3>
                            <p>{{ $a->title }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion @if($a->currentBalanceRaw < 0) ion-arrow-graph-down-right @else ion-arrow-graph-up-right @endif"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            show transactions <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if(isset($categoryusage) && $categoryusage && count($categoryusage) > 0)
        <div class="row">
            <div class="col-lg-3 col-xs-7">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Category Usage</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart-responsive">
                                    <canvas style="width: 474px; height: 300px;" width="474" id="categoryusageChart" height="300"></canvas>
                                </div><!-- ./chart-responsive -->
                            </div><!-- /.col -->
                            <div class="col-md-4">
                                <ul class="chart-legend clearfix">
                                    @foreach($categoryusage as $c)
                                        <li><i class="fa fa-circle-o" style="color:#{{  $c->color }};"></i> {{ $c->title }}</li>
                                    @endforeach
                                </ul>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    @endif

</section><!-- /.content -->
@endsection
