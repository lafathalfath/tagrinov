@extends('layouts.main')

@section('content')
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/theme-bootstrap.min.css' rel='stylesheet' />

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/theme-bootstrap.min.js'></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }

        .banner {
            background-color: #00452C;
            color: #fff;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        #calendar {
            margin: 0 auto;
            max-width: 90%;
        }

        .fc-toolbar {
            background-color: #00452C;
            color: #fff;
            padding: 1rem;
        }

        button.fc-button {
            background-color: #00452C !important;
            color: #fff !important;
            border-radius: 5px;
            padding: 0.5rem 1rem;
            margin-right: 0.5rem;
        }

        .fc-toolbar-title {
            font-size: 1.5rem;
        }

        .fc-daygrid-day,
        .fc-timegrid-slot {
            border: 1px solid #ddd;
            padding: 5px;
        }

        .fc-event {
            background-color: #00452C;
            color: #fff;
            border-radius: 5px;
        }

        .fc-event:hover {
            background-color: #00342a;
        }

    </style>

    <!-- Banner Section -->
    <div class="banner">
        <h1>Event Calendar</h1>
    </div>

    <!-- Main Calendar -->
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            // Main Calendar
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',  // Tampilkan kalender bulanan
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                themeSystem: 'bootstrap',
                events: @json($event_data), // Data event dari backend
                editable: true,
                droppable: true,
                eventColor: '#00452C',
                eventTextColor: '#fff',
                views: {
                    dayGridMonth: {
                        titleFormat: { year: 'numeric', month: 'long' }
                    }
                },
                buttonText: {
                    today: 'Today',
                },
                eventClick: function(info) {
                    alert('Event: ' + info.event.title + '\nStart: ' + info.event.start.toLocaleString() + '\nEnd: ' + (info.event.end ? info.event.end.toLocaleString() : 'N/A'));
                }
            });
            calendar.render();
        });
    </script>
@endsection
