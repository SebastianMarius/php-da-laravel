<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
</head>
<body>
    <div class="container">
        <h1>Create Event</h1>
        <form action="/test/CreateEvent" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" id="start_time" name="start_time" class="form-control">
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" id="end_time" name="end_time" class="form-control">
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="tichet_price">Ticket Price:</label>
                <input type="number" id="tichet_price" name="tichet_price" class="form-control">
            </div>
            <div class="form-group">
                <label for="photo">Photo URL:</label>
                <input type="file" id="photo" name="photo" accept="image/*">
            </div>

            <div class="form-group">
                <label>Select Speakers:</label><br>
                @foreach($speakers as $speaker)
                    <input type="checkbox" name="speaker_ids[]" value="{{ $speaker->id }}">
                    <label>{{ $speaker->name }}</label><br>
                @endforeach
            </div>

            <div class="form-group">
                <label>Select Sponsors:</label><br>
                @foreach($sponsors as $sponsor)
                    <input type="checkbox" name="sponsor_ids[]" value="{{ $sponsor->id }}">
                    <label>{{ $sponsor->name }}</label><br>
                @endforeach
            </div>

            <div class="form-group">
                <label>Select Partners:</label><br>
                @foreach($partners as $partner)
                    <input type="checkbox" name="partner_ids[]" value="{{ $partner->id }}">
                    <label>{{ $partner->name }}</label><br>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Create Event</button>
        </form>
    </div>
</body>
</html>
