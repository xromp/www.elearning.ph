@extends('layout.master')
@section('layout.templates')
<script type="text/ng-template" id="forum.view">
	@include('forum.view')
</script> 

@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/forum/forum.js?v=20171028')}}"></script>
@endsection
