@extends('layouts.errors')
@section('content')
<div class="text-center">
	<img src="/images/404.jpg">
	@auth
		Authenticated
	@else
		<div class="text-center p-4">
			<a name="" id="" class="btn btn-dark" href="/login" role="button">Back to Login</a>
		</div>
	@endguest
</div>
@endsection