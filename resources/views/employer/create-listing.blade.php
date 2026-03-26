<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Listing</title>
</head>

<body>
    <h2>Create Job Listing</h2>
    <form action="{{ route('listing.create') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Job title">
        <br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <br>
        <input type="text" name="skills" placeholder="php,laravel, mysql">
        <br>
        <input type="number" name="experience" placeholder="Experience in years" min="0">
        <br>
        <button type="submit">Create Job</button>
    </form>
</body>

</html>
