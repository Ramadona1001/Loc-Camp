@extends('layouts.master')

@section('title',transWord('Home'))

@section('stylesheet')

@endsection

@section('content')
<div class="row clearfix">
    {!! statisticsWidget($components) !!}
</div>

<hr>


@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endsection
