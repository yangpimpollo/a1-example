@auth
    <div style="background: #3490dc; color: white; padding: 10px; text-align: center; font-family: sans-serif;">
        <strong>Current User:</strong> {{ Auth::user()->name }} ({{ Auth::user()->email }})
        
        <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 15px;">
            @csrf
            <button type="submit" style="cursor: pointer;">Logout</button>
        </form>
    </div>
@endauth

@guest
    <div style="background: #e3342f; color: white; padding: 10px; text-align: center; font-family: sans-serif;">
        <strong>Not Logged In</strong> - <a href="/login" style="color: white;">Go to Login</a>
    </div>
@endguest