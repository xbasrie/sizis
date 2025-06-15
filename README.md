# SIZIS - Sistem Informasi Zakat, Infaq, Sedekah

SIZIS adalah sebuah aplikasi web yang dibangun dengan Laravel dan FilamentPHP untuk membantu pengelolaan dan pencatatan transaksi Zakat, Infaq, dan Sedekah (ZIS) secara komprehensif. Aplikasi ini dirancang untuk memudahkan manajemen data donatur, penerima manfaat, amil, rekening, serta pencatatan pemasukan dan penyaluran ZIS. Dilengkapi dengan dashboard interaktif dan fitur pelaporan, SIZIS bertujuan untuk menyediakan transparansi dan efisiensi dalam pengelolaan dana umat.

## Fitur Utama

* **Manajemen Data Master:**
    * Pengelolaan data **Donatur** (Pribadi & Instansi).
    * Pengelolaan data **Penerima Manfaat** beserta kategori penerima (Fakir, Miskin, Yatim, dll.).
    * Pengelolaan data **Amil** (Petugas ZIS).
    * Manajemen **Rekening** tujuan (bank, atas nama, nomor rekening).
    * Pengaturan **Kategori ZIS** (Zakat, Infaq, Sedekah) dan jenis-jenisnya.
* **Pencatatan Transaksi ZIS:**
    * Pencatatan detail pemasukan ZIS, termasuk donatur, kategori & jenis ZIS, jumlah uang/beras/jiwa, rekening tujuan, dan amil yang bertugas.
* **Pencatatan Penyaluran:**
    * Pencatatan detail penyaluran dana kepada penerima manfaat, termasuk kategori & jenis penyaluran, jumlah uang/beras, dan amil yang menyalurkan.
* **Dashboard Interaktif:**
    * Menampilkan ringkasan statistik seperti Total Donasi Terkumpul, Total Dana Tersalurkan, Jumlah Donatur, dan Jumlah Penerima Manfaat.
    * Grafik visualisasi data pemasukan bulanan dan komposisi kategori ZIS.
* **Sistem Pelaporan:**
    * Laporan periodik (bulanan) untuk internal dan donatur.
    * Laporan tahunan untuk internal.
    * Fungsi cetak invoice untuk setiap transaksi ZIS.
* **Admin Panel (FilamentPHP):**
    * Antarmuka administrasi yang powerful dan mudah digunakan untuk mengelola seluruh data dan fitur di atas.

## Teknologi yang Digunakan

* [Laravel](https://laravel.com/) - Framework PHP untuk aplikasi web.
* [FilamentPHP](https://filamentphp.com/) - Toolkit untuk membangun aplikasi TALL stack (Tailwind CSS, Alpine.js, Livewire, Laravel).
* PHP 8.1+
* MySQL (atau database relasional lainnya)
* Composer (Manajer dependensi PHP)
* NPM / Yarn (Manajer paket JavaScript)
* Vite (Bundler frontend)

## Instalasi dan Pengaturan

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek SIZIS secara lokal di komputer Anda:

1.  **Clone Repositori:**
    ```bash
    git clone [https://github.com/xbasrie/sizis.git](https://github.com/xbasrie/sizis.git)
    cd sizis
    ```

2.  **Instal Dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Instal Dependensi NPM dan Kompilasi Aset Frontend:**
    ```bash
    npm install
    npm run dev
    # Atau untuk produksi: npm run build
    ```

4.  **Konfigurasi File `.env`:**
    * Salin file `.env.example` menjadi `.env`.
        ```bash
        cp .env.example .env
        ```
    * Edit file `.env` dan atur konfigurasi database Anda (DB\_CONNECTION, DB\_HOST, DB\_PORT, DB\_DATABASE, DB\_USERNAME, DB\_PASSWORD).
    * Pastikan `APP_URL` diatur dengan benar (misalnya `http://localhost:8000`).
    * Tambahkan konfigurasi Filament Anda di `.env` (jika berbeda dari default):
        ```env
        FILAMENT_PATH=admin # path untuk admin panel, default 'admin'
        FILAMENT_DOMAIN= # Biarkan kosong jika tidak menggunakan subdomain khusus
        ```

5.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Jalankan Migrasi Database:**
    ```bash
    php artisan migrate
    ```
    Ini akan membuat tabel-tabel database yang diperlukan.

7.  **Buat Pengguna Admin Pertama:**
    Anda bisa membuat user pertama melalui Tinker atau dengan membuat seeder. Untuk contoh cepat, Anda bisa menggunakan `php artisan tinker`:
    ```php
    php artisan tinker
    App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);
    exit;
    ```
    (Ganti `admin@example.com` dan `password` dengan kredensial yang Anda inginkan).

8.  **Jalankan Server Lokal:**
    ```bash
    php artisan serve
    ```

## Penggunaan

Setelah server berjalan, buka browser Anda dan akses:

* **Aplikasi Utama:** `http://localhost:8000` (atau port lain yang digunakan Artisan).
* **Admin Panel Filament:** `http://localhost:8000/admin` (sesuai dengan `FILAMENT_PATH` di `.env` Anda).

Anda dapat login ke admin panel menggunakan kredensial yang Anda buat di langkah instalasi.

## Kontribusi

Kontribusi dipersilakan! Jika Anda menemukan bug, memiliki saran fitur, atau ingin berkontribusi pada kode, silakan buka *issue* atau *pull request* di repositori GitHub ini. Pastikan Anda membaca [Panduan Kontribusi Laravel](https://laravel.com/docs/contributions) dan mematuhi [Kode Etik](https://laravel.com/docs/contributions#code-of-conduct).

## Lisensi

Proyek SIZIS adalah perangkat lunak *open-source* yang dilisensikan di bawah [Lisensi MIT](https://opensource.org/licenses/MIT).