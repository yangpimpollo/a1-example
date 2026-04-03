@include('components.user-bar')

<div style="padding: 20px; font-family: sans-serif;">
    <h1>Dashboard</h1>
    <p>You are inside the protected area.</p>
    
    <!-- This link leads to your new view -->
    <a href="{{ route('profile') }}" style="display: inline-block; padding: 10px; background: #333; color: white; text-decoration: none; border-radius: 5px;">
        Go to My Profile
    </a>
</div>