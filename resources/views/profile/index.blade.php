@extends('layout.master')

@section('layout.templates')
<script type="text/ng-template" id="profile.view">
	@include('profile.view')
</script> 
<script type="text/ng-template" id="profile.view2">
	@include('profile.view2')
</script> 
@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/profile/profile.js?v=20171028')}}"></script>
@endsection

