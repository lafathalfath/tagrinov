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
<div class="container">
    <h3>Kalender Kunjungan</h3>

    <div id="calendar" style="max-width: 900px; margin: 0 auto;"></div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="eventModalLabel">Detail Kunjungan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Lengkap:</strong> <span id="modalNama"></span></p>
                    <p><strong>Tanggal Kunjungan:</strong> <span id="modalTanggal"></span></p>
                    <p><strong>Asal Instansi:</strong> <span id="modalAsal"></span></p>
                    <p><strong>Jenis Pengunjung:</strong> <span id="modalJenis"></span></p>
                    <p id="modalJumlah" style="display:none;"><strong>Jumlah Orang:</strong> <span id="modalJumlahOrang"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'id',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title', 
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: @json($event_data),
            editable: false,
            eventStartEditable: false,
            droppable: false, // Nonaktifkan event dropping
            eventColor: '#C40C0C',
            eventTextColor: '#fff',
            views: {
                dayGridMonth: {
                    titleFormat: { year: 'numeric', month: 'long' }
                }
            },
            buttonText: {
                today: 'Hari Ini',
                month: 'Bulan',
                week: 'Minggu',
                day: 'Hari'
            },
            eventClick: function(info) {
                // Update modal content
                document.getElementById('modalNama').textContent = info.event.title;
                document.getElementById('modalAsal').textContent = info.event.extendedProps.asal_instansi;
                document.getElementById('modalJenis').textContent = info.event.extendedProps.jenis_pengunjung;
                
                if (info.event.extendedProps.jumlah_orang) {
                    document.getElementById('modalJumlah').style.display = 'block';
                    document.getElementById('modalJumlahOrang').textContent = info.event.extendedProps.jumlah_orang;
                } else {
                    document.getElementById('modalJumlah').style.display = 'none';
                }

                document.getElementById('modalTanggal').textContent = info.event.start.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                
                // Show the modal
                var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
                myModal.show();
            }
        });
        calendar.render();
    });
</script>


@endsection
