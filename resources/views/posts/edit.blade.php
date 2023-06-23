<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Post edit page</title>
</head>
<body>
    <h1>Edit</h1>
    <form action="/posts/{{$post->id}}" method="post">
       @csrf
       @method('put')
        <p>Post title</p>
        <input type="text" name="title" value="{{ $post->title}}">
        <br>
        <p>Post content</p>
        <textarea name="content">{{$post->content}}</textarea>
        <br>
        @foreach($tags as $tag)
        <input type="checkbox" value="{{$tag ->id}}" name="tags[]" {{ $post->tags->contains($tag)? "checked":""}}>{{$tag->name}}<br>
        @endforeach
        
        <br>
        <button type="submit">Update</button>
</form>





</body>
</html>
