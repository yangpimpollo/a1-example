
    <style>
        .div1{
            background: #3490dc;
            color: white;
            padding: 3px;
            border-radius: 2px;
            /* max-width: 600px;
            margin: 30px auto; */
            font-family: sans-serif;
            font-size: 10px;
            text-align: left;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>


@auth
    <div class="div1">
        <strong>> Current User:</strong> {{ Auth::user()->name }} ({{ Auth::user()->email }})
    </div>
@endauth

@guest
    <div style="background: #e3342f; color: white; padding: 10px; text-align: center; font-family: sans-serif;">
        <strong>Not Logged In</strong> - <a href="/login" style="color: white;">Go to Login</a>
    </div>
@endguest