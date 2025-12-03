# Email Setup untuk McOrder

## Konfigurasi Email Notification

Aplikasi McOrder sekarang mendukung email notification untuk:
- ✅ Pemberitahuan akun disetujui (approved)
- ✅ Pemberitahuan akun ditolak (rejected)

## Setup Email di .env

Tambahkan konfigurasi berikut di file `.env`:

### Untuk Testing dengan Mailtrap (Recommended untuk Development):
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@mcorder.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Untuk Gmail (Production):
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@mcorder.com"
MAIL_FROM_NAME="McOrder System"
```

**Note untuk Gmail:** 
- Aktifkan 2-Step Verification di akun Google
- Generate App Password di: https://myaccount.google.com/apppasswords
- Gunakan App Password sebagai MAIL_PASSWORD

### Untuk Production dengan Domain Sendiri:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.yourdomain.com
MAIL_PORT=587
MAIL_USERNAME=noreply@mcorder.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@mcorder.com"
MAIL_FROM_NAME="McOrder System"
```

## Testing Email

Setelah konfigurasi, test email dengan:

1. Registrasi user baru
2. Login sebagai admin
3. Approve atau Reject user
4. Cek email di inbox user yang baru registrasi

## Email Templates

### Email Approved:
- Subject: 🎉 Akun Anda Telah Disetujui - McOrder
- Berisi: greeting, informasi approval, detail akun, tombol login
- Action button: Login Sekarang

### Email Rejected:
- Subject: Pemberitahuan Pendaftaran Akun - McOrder
- Berisi: greeting, informasi rejection, kontak support
- Tone: Professional dan sopan

## Troubleshooting

Jika email tidak terkirim:
1. Pastikan semua konfigurasi MAIL_* di `.env` benar
2. Jalankan `php artisan config:clear`
3. Jalankan `php artisan cache:clear`
4. Cek log di `storage/logs/laravel.log`
5. Pastikan firewall tidak memblok port SMTP

## Queue Setup (Optional - untuk performa lebih baik)

Untuk mengirim email secara async (tidak blocking):

1. Set `QUEUE_CONNECTION=database` di `.env`
2. Jalankan migration: `php artisan queue:table`
3. Jalankan: `php artisan migrate`
4. Start queue worker: `php artisan queue:work`

Kemudian update notification class dengan `implements ShouldQueue`
