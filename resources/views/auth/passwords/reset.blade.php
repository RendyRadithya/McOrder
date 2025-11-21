// ...existing code...
<form method="POST" action="{{ route('password.update') }}">
  @csrf
  <input type="hidden" name="token" value="{{ $token ?? old('token') }}">
  <input name="email" value="{{ $email ?? old('email') }}" required />
  <input name="password" type="password" required />
  <input name="password_confirmation" type="password" required />
  <button type="submit">Reset</button>
</form>
