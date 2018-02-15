@extends('layout.master')
@section('layout.templates')
<script type="text/ng-template" id="leaderboard.view">
	@include('leaderboard.view')
</script> 

@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/leaderboard/leaderboard.js?v=20171028')}}"></script>
@endsection
