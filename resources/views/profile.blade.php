@include('components.user-bar')

<div style="padding: 20px; font-family: sans-serif;">
    <h1>User Profile</h1>

    <!-- Avatar -->
    <div style="text-align: center; margin-bottom: 20px;">
        @if(Auth::user()->avatar)
            <img src="{{ Storage::url(Auth::user()->avatar) }}" 
                 alt="Avatar" 
                 style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #ddd;">
        @else
            <div style="width: 150px; height: 150px; background-color: #ddd; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; font-size: 50px;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
    </div>


    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Role:</strong> 
        <span style="text-transform: capitalize; font-weight: bold;">
            {{ Auth::user()->role }}
        </span>
    </p>
    <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
    
    <hr>
    <a href="/dashboard">Back to Dashboard</a>




</div>
