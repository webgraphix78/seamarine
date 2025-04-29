@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<h3 class="mb-4">Login to Seamarine Portal</h3>
			<div class="card">
				<!-- <div class="card-header">{{ __('Login') }}</div> -->

				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf

						<div class="row justify-content-center mb-3">

							<div class="col-md-10">
								<label for="email" class="col-form-label text-md-end">{{ __('Login ID') }}</label>
								<input id="email" type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="row justify-content-center mb-3">

							<div class="col-md-10">
								<label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
								<input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<!-- <div class="row justify-content-center mb-4">
							<div class="col-md-10">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

									<label class="form-check-label" for="remember">
										{{ __('Remember Me') }}
									</label>
								</div>
							</div>
						</div> -->

						<div class="row justify-content-center mb-3">
							<div class="col-md-10">
								<button type="submit" class="btn btn-dark rounded-0">
									{{ __('Login') }}
								</button>

								@if (Route::has('password.request'))
									<!-- <a class="btn btn-link" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a> -->
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
