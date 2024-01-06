<!DOCTYPE html>
<html lang="en">

@vite(['resources/css/navbar.css'])

<head>
    <!-- <script src="{{ asset("/eventData.js") }}"> -->

    <!-- </script> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Event</title>
 
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const eventData = localStorage.getItem('event');
            if (eventData) {
                const parsedEventData = JSON.parse(eventData);
                const eventId = parsedEventData.id;

                const eventLink = document.getElementById('eventLink');
                eventLink.href = `/event/${eventId}/about`;

                const aboutLink = document.getElementById('aboutLink');
                aboutLink.href = `/event/${eventId}/speakers`; // Replace this with your 'About' link

                const servicesLink = document.getElementById('servicesLink');
                servicesLink.href = `/event/${eventId}/partners-and-sponsors`; // Replace this with your 'Services' link

                const contactLink = document.getElementById('contactLink');
                contactLink.href = `/event/${eventId}/bilete-inregistrare`; // Replace this with your 'Contact' link
            }
        });
    </script>

</head>

<body>

<nav class="navbar">
        <div class="navbar-container">
            <div class="toggle"></div>
            <ul class="menu">
                <li><a href="/event/" id="eventLink">Home</a></li>
                <li><a href="/about" id="aboutLink">About</a></li>
                <li><a href="/services" id="servicesLink">Services</a></li>
                <li><a href="/contact" id="contactLink">Contact</a></li>
            </ul>
        </div>
    </nav>


    <h2 class="event_title">La vanatoare de ursi</h2>
    <div class="container">
        <div class="content">
            <h1 class="event_title" style="">La vanatoare de ursi</h1>
            <p id="descriere" style="">paragraful </p>

        </div>
        <div class="div1" id="despre-second-div-img">
            <div class="details">
                <div style="font-size: 24px;">Data inceperii: </div>
                <p style="" id="event_date">12.12.2012</p>

            </div>
            <div class="details" >
                <div style="font-size: 24px;">Ora inceperii: </div>
                <p style="" id="event_hour">12.12</p>

            </div>
        </div>
    </div>

</body>

</html>