<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resume Upload</title>
</head>

<body>
    <h2>Upload Resume</h2>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('resume.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="resume">
        <button type="submit">Upload Resume</button>
    </form>
</body>

</html>
