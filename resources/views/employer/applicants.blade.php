<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applicants</title>
</head>

<body>
    @foreach ($applicants as $applicant)
        <div class="">
            <h3>{{ $applicant->user->name }}</h3>
            <p>Match Score: {{ $applicant->match_score }}%</p>
        </div>
    @endforeach
</body>

</html>
