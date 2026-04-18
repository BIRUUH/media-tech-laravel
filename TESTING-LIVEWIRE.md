# Panduan Testing Livewire

## Persiapan
1. Pastikan server development berjalan:
   ```bash
   php artisan serve
   ```

2. Di terminal terpisah, jalankan:
   ```bash
   npm run dev
   ```

## Testing Fitur

### User Side:
1. **Pencarian Produk dengan Livewire**
   - Buka: http://localhost:8000/belanja
   - Ketik di search box
   - Hasil akan muncul otomatis (real-time)

2. **Detail Pesanan**
   - Login sebagai user
   - Buka: http://localhost:8000/pesanan
   - Klik tombol "Lihat Detail" pada pesanan
   - Akan muncul halaman detail dengan gambar produk

### Admin Side:
1. **Pencarian Produk Admin**
   - Login sebagai admin: http://localhost:8000/admin/login
   - Buka: http://localhost:8000/admin/products
   - Gunakan search box di kanan atas

2. **Pencarian Pesanan Admin**
   - Buka: http://localhost:8000/admin/lists
   - Gunakan search box untuk cari pesanan
   - Bisa search by: ID, nama, email, atau status

## Jika Masih Ada Error:
1. Clear semua cache:
   ```bash
   php artisan optimize:clear
   ```

2. Restart server (Ctrl+C lalu jalankan ulang)
