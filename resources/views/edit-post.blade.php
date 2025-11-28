<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Edit Form</h3>
    <form action="/edit-post/{{$post->id}}" method="post">
        @csrf
        @method("PATCH")
        <input type="text" name="title" value="{{$post->title}}">
        <textarea name="body" cols="30" rows="10">{{$post->body}}</textarea>
        <button>Save Changes</button>
    </form>
</body>
</html>