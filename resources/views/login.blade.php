@include('components.user-bar')

<form method="POST" action="/login">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

@if($errors->any())
    <p>{{ $errors->first() }}</p>
@endif
@error('email44')
    <span style="color: red;">{{ $message }}</span>
@enderror