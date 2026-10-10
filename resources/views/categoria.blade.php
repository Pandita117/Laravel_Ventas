<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <form action="{{route('categoria.create')}}" method="POST"></form>
    @csrf
    <input type="text" name="categorua" placeholder="ingrese una categoria">
    @error('categoria')
            <small>{{$message}}</small>        
    @enderror
    <button class="btn btn.primary"="submit">guardar </button>


    
</body>
</html>