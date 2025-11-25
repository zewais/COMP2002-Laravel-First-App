<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@auth
<p>Congrats you're logged in!</p>
<form action="/logout" method="post">
    @csrf
    <button>Logout</button>
</form>

<div>
    <h2>Create a new post</h2>
    <form action="/create-post" method="post">
        @csrf
        <input type="text" name="title" id="" placeholder="Post title"><br>
        <textarea name="body" id="" cols="30" rows="10" placeholder="Post body"></textarea><br>
        <button>Submit Post</button >
    </form>
</div>

<div style="margin-top: 20px; border: 3px solid #222; border-radius: 5px; padding: 10px;">
    <h2>Your Posts</h2>
    @foreach ($posts as $post)
        <div style="border: 1px solid #555; border-radius: 3px; margin-bottom: 10px; padding: 5px; background-color: #999;">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->body }}</p>
            <!-- The date format is Month day, Year, hour:minute am/pm -->
            <p>Posted on: {{ $post->created_at->format('F j, Y, g:i a') }}</p>
            <form action="/delete-post/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete Post</button>
            </form>
        </div>
    @endforeach
</div>

@else
<h1>Fake Blog Posts</h1>
    <div style="border: 3px solid #222; border-radius: 5px;">
        <h2>Registration</h2>
        <form action="/register" method="post">
            <!-- important to add @csrf to bypass 419 error for posting data on a blade template -->
            <!-- It avoids cross-site request forgery attacks -->
            <!-- Cross-Site Request Forgery (CSRF) is a type of malicious exploit of a website where unauthorized commands are transmitted from a user that the web application trusts. -->
            @csrf 
            <input type="text" name="name" id="" placeholder="name"><br>
            <input type="email" name="email" id="" placeholder="email"><br>
            <input type="password" name="password" id="" placeholder="password"><br>
            <button>Submit</button>
        </form>
    </div>
    <div style="border: 3px solid #222; border-radius: 5px;">
        <h2>Login</h2>
        <form action="/login" method="post">
            <!-- important to add @csrf to bypass 419 error for posting data on a blade template -->
            <!-- It avoids cross-site request forgery attacks -->
            <!-- Cross-Site Request Forgery (CSRF) is a type of malicious exploit of a website where unauthorized commands are transmitted from a user that the web application trusts. -->
            @csrf 
            <input type="text" name="loginName" id="" placeholder="name"><br>
            <input type="password" name="loginPassword" id="" placeholder="password"><br>
            <button>Login</button>
        </form>
    </div>
@endauth


</body>
</html>