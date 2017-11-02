@extends('layout.master')

@section('layout.templates')
<script type="text/ng-template" id="stock-market.view">
	@include('stock-market.view')
</script>
<script type="text/ng-template" id="stock-market.view-category">
	@include('stock-market.view-category')
</script>
@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/stock-market/stockMarket.js')}}"></script>
@endsection