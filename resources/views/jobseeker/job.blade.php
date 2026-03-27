<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jobs</title>
</head>

<body>
    <h1>Jobs</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @foreach ($jobs as $job)
        <div class="">
            <h3>{{ $job->title }}</h3>
            <p>{{ $job->skills }}</p>
            <a href="{{ route('job.apply', $job->id) }}">Apply</a>
        </div>
    @endforeach
</body>

</html>
