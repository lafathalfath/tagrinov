@extends('layouts.main')

@section('content')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/theme-bootstrap.min.css' rel='stylesheet' />

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
            border-radius: 0px;
            text-align: center;
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        #calendar {
            max-width: 1200px;
            margin: 0 auto;
        }

        .fc-toolbar {
            background-color: #00452C;
            color: #fff;
            padding: 1rem;
        }

        .fc-daygrid-day {
            border: 1px solid #ddd;
        }

        .fc-daygrid-day:hover {
            background-color: #e0f7f1;
        }

        .fc-daygrid-day-top {
            font-weight: bold;
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

    <div class="banner">
        <h1>Event Calendar</h1>
    </div>

    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap', 
                events: @json($event_data), 
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
                    month: 'Month',
                    week: 'Week',
                    day: 'Day'
                },
                eventClick: function(info) {
                    alert('Event: ' + info.event.title + '\nStart: ' + info.event.start.toLocaleString() + '\nEnd: ' + info.event.end.toLocaleString());
                }
            });
            calendar.render();
        });
    </script>
@endsection
