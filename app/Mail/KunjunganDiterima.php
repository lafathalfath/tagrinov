<?php

namespace App\Mail;

use App\Models\Kunjungan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KunjunganDiterima extends Mailable
{
    use Queueable, SerializesModels;

    public $kunjungan;
    // public $recipients;
    public $linkWeb;


    public function __construct(Kunjungan $kunjungan)
    {
        $this->kunjungan = $kunjungan;

        // Ambil semua admin dan tim_kerja dari database
        // $this->recipients = User::whereIn('role', ['admin', 'tim_kerja'])->pluck('name')->toArray();

        // Ambil URL aplikasi dari .env atau gunakan default
        $this->linkWeb = config('app.url') . '/login';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permohonan Kunjungan',
        );
    }

    public function build()
{
    return $this->subject('Konfirmasi Kunjungan Anda')
                ->view('emails.kunjungan_diterima')
                ->with([
                    'kunjungan' => $this->kunjungan,
                    'linkWeb' => $this->linkWeb,
                ]);
}

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.kunjungan_diterima', // Sesuaikan dengan lokasi view yang benar
            with: ['kunjungan' => $this->kunjungan] // Kirim data kunjungan ke view
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
