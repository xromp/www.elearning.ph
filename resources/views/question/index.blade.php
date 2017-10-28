@extends('layout.master')

@section('layout.templates')
<script type="text/ng-template" id="question.view">
	@include('question.view')
</script>

<script type="text/ng-template" id="question.ask-question">
	@include('question.ask-question')
</script>
@endsection

@section('scripts')
<script data-require="angularjs@1.4.4" data-semver="1.4.4" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.js"></script>
<script type="text/javascript" src="{{URL::to('js/question/question.js?v=20171028')}}"></script>
@endsection