@extends('layout.master')

@section('layout.templates')
<script type="text/ng-template" id="question.view">
	@include('question.view')
</script>
<script type="text/ng-template" id="question.ask-question">
	@include('question.ask-question')
</script>
<script type="text/ng-template" id="question.answer-question">
	@include('question.answer-question')
</script>
<script type="text/ng-template" id="question.question-rating-modal">
	@include('question.question-rating-modal')
</script>
<script type="text/ng-template" id="question.approval-remarks">
	@include('question.approval-remarks')
</script>
@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/question/question.js?v=20171028')}}"></script>
@endsection