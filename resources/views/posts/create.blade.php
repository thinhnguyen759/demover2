<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create post page</title>
</head>

<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1>create new post</h1>
<form action="/posts" method="post">
    @csrf
    <p>Post title</p>
    <input required maxlength="255" type="text" name="title" value="{{old ('title')}}">
    <br>
    <p>Post content</p>
    <textarea id="post-editor" name="content"> {{ old ('content')}}</textarea>
    <br>
    <button type="submit">Create</button>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#post-editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>


</body>

</html>
