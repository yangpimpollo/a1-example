@include('components.user-bar')

<div style="padding: 20px; font-family: sans-serif;">
    <h1>User Profile</h1>
    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
    
    <hr>
    <a href="/dashboard">Back to Dashboard</a>
</div>
