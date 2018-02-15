@extends('layout.master')

@section('layout.templates')
<script type="text/ng-template" id="profile.view">
	@include('profile.view')
</script> 
@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/profile/profile.js?v=20171028')}}"></script>
@endsection

