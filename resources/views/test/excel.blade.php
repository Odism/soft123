<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Excel</title>
</head>
<body>
    
    <form action="{{ url('/import') }}" method= "post" enctype="multipart/form-data">

        {{ csrf_field() }}

        @if(session('errors'))
            @foreach($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif

        @if(session('success'))
            {{ session('success') }}
        @endif

        <br><br>

        Select excel file to upload
        <br><br>

        <input type="file" name="file" id="file">
        <br><br>

        <button type="submit">Upload File</button>

        <br><br><br>
        <a href="{{ url('/sample/StudentRegister.xlsx') }}"> Download Sample</a>
    
    </form>

</body>
</html>