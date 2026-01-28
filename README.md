![SukaHati](https://github.com/josephines1/o-stock/blob/main/public/assets/img/readme/mockup_ostock.png "O-Stock")

# SukaHati
[![made-with-codeigniter4](https://img.shields.io/badge/Made%20with-CodeIgniter4-DD4814.svg)](https://www.codeigniter.com/) [![Open Source? Yes!](https://badgen.net/badge/Open%20Source%3F/Yes%21/blue?icon=github)](https://github.com/Nafars24/sukahatii)

## SukaHati: Solusi Terbaik untuk Pengelolaan Stok Perusahaan Anda
SukaHati adalah aplikasi pengelolaan stok yang dirancang untuk memudahkan Anda dalam mengelola data stok dan penjualan di seluruh cabang perusahaan Anda. Dengan fitur lengkap dan antarmuka yang intuitif, SukaHati membantu Anda mengoptimalkan pengelolaan inventaris dan memaksimalkan efisiensi bisnis Anda.

## Requirements

- [Visual Studio Code](https://code.visualstudio.com/)
- [Composer](https://getcomposer.org/)
- [XAMPP 8.2.4 or later](https://www.apachefriends.org/download.html)

## Versions & Features

SukaHati hadir dalam dua versi: Free dan Premium. Berikut adalah perbedaan utama antara kedua versi tersebut:

- **Pengelolaan Data Lengkap**: Kelola data konsumen, salesman, supplier, dan produk dengan mudah dan terintegrasi dalam satu platform.
- **Stok Penjualan & Alokasi**: Pantau stok produk dan kelola alokasi dengan efisien.
- **Cetak Invoice**: Buat dan cetak invoice penjualan dengan cepat dan akurat.
- **Kartu Stok**: Tinjau stok produk saat ini untuk memastikan ketersediaan barang.

## Getting Started

Anda perlu melakukan sedikit konfigurasi di bawah ini sebelum mulai menjalankan web O-Stock:
1. Unduh file ZIP source code o-stock atau jalankan perintah berikut di terminal Anda:
   ```console
   git clone https://github.com/Nafars24/sukahatii.git
   ```

2. Ekstrak file ZIP dan letakkan folder sukahatii di dalam folder htdocs (misalnya D:\xampp\htdocs).

3. Buka folder sukahatii di Visual Studio Code.

4. Di Visual Studio Code, buka terminal dengan memilih `Terminal > New Terminal` di menu bagian atas, atau tekan ctrl + `
   
5. Jalankan perintah berikut untuk menginstal package yang dibutuhkan:
   ```console
   composer install
   ```
   
6. Setelah instalasi selesai, salin file `env` dan beri nama menjadi `.env`
   - Atur nama aplikasi:
     ```
     APP_NAME = "Nama Aplikasi"
     ```
     
   - Ubah environment menjadi development:
     ```
     CI_ENVIRONMENT = development
     ```

   - Atur Base URL:
     ```
     app.baseURL = 'http://localhost:8080/'
     ```
     
   - Konfirgurasikan database. Sesuaikan dengan database milik Anda:
     ```
     database.default.hostname = localhost
     database.default.database = sukahatii
     database.default.username = root
     database.default.password = 
     database.default.DBDriver = MySQLi
     database.default.DBPrefix =
     database.default.port = 3306
     ```

   - Pastikan tidak ada tanda "#" pada baris yang telah dikonfigurasi.
     
7. Buka file `vendor\myth\auth\src\Filters\RoleFilter.php`. Modifikasi function `before` (baris 18 - 46) menjadi seperti berikut ini.
   ```
   public function before(RequestInterface $request, $arguments = null)
    {
        /* 
        * Jika tidak ada pengguna yang login, arahkan mereka ke formulir login.
        */
        if (!$this->authenticate->check()) {
            session()->set('redirect_url', current_url());
            return redirect($this->reservedRoutes['login']);
        }

        /* 
        * Jika tidak ada argumen yang diberikan, lanjutkan ke proses berikutnya.
        */
        if (empty($arguments)) {
            return;
        }

        /* 
        * Periksa setiap izin yang diminta
        */
        foreach ($arguments as $group) {
            /* 
            * Jika pengguna berada dalam grup yang memiliki izin, lanjutkan.
            */
            if ($this->authorize->inGroup($group, $this->authenticate->id())) {
                return;
            }
        }

        /* 
        * Jika pengguna tidak memiliki izin dan loginnya bersifat senyap (silent login)
        */
        if ($this->authenticate->silent()) {
            /* 
            * Arahkan ke URL yang tersimpan di sesi atau ke URL landing
            */
            $redirectURL = session('redirect_url') ?? route_to($this->landingRoute);
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirectURL)->with('error', lang('Auth.notEnoughPrivilege'));
        }

        /* 
        * Jika pengguna tidak memiliki izin dan login tidak bersifat senyap, arahkan ke halaman utama
        */
        return redirect()->to(base_url());
    }
   ```
     
8. Buka file `vendor\myth\auth\src\Config\Auth.php`.
    - Atur defaultUserGroup (baris 19)
      ```
      public $defaultUserGroup = 'cabang';
      ```
      
    - Atur tampilan auth (baris 76 - 83)
      ```
      public $views = [
        'login'           => 'App\Views\auth\login',
        'register'        => 'Myth\Auth\Views\register',
        'forgot'          => 'Myth\Auth\Views\forgot',
        'reset'           => 'Myth\Auth\Views\reset',
        'emailForgot'     => 'Myth\Auth\Views\emails\forgot',
        'emailActivation' => 'Myth\Auth\Views\emails\activation',
      ];
      ```
    - Atur activeResetter (baris 201)
      ```
      public $activeResetter = null;
      ```
    
9. Buka XAMPP Control Panel Anda dan start server Apache dan MySQL.
    
10. Buka `localhost/phpmyadmin` di browser, lalu buat database baru dengan nama `sukahatii` atau sesuaikan dengan nama database yang Anda inginkan.

11. Buka kembali terminal di Visual Studio Code, jalankan perintah migrate dan seed.
    - Migrate
      ```console
      php spark migrate -2024-07-27-125132_create_ostock_tables
      php spark migrate -2024-07-27-134447_create_auth_tables
      ```

    - Seed
      ```console
      php spark db:seed KantorSeeder
      php spark db:seed SalesmanSeeder
      php spark db:seed KonsumenSeeder
      php spark db:seed SupplierSeeder
      php spark db:seed KategoriProdukSeeder
      php spark db:seed ProdukSeeder
      php spark db:seed UserSeeder
      php spark db:seed AuthGroupsSeeder
      php spark db:seed AuthGroupsUsersSeeder
      ```

12. Mulai server dengan menjalankan perintah berikut ini di terminal.
    ```console
    php spark serve
    ```
      
13. Selesai! Akses web melalui `http://localhost:8080`.

## First Usage

### Login
Setelah melakukan instalasi dan konfigurasi sukahatii, Anda dapat melakukan login pada aplikasi dengan email dan password sebagai berikut.

```
Email: naufal@mpsi.com
Password: password
```

### Tambahkan Stok Awal
Setelah berhasil melakukan login, Anda dapat mencoba menambahkan stok awal produk, untuk selanjutnya melakukan pencatatan penjualan, alokasi, mutasi, dan retur.

## Services

Layanan di bawah ini tersedia pada aplikasi sukahatii.

### Layanan Utama

#### Pengelolaan Data
- Kelola data konsumen, salesman, supplier, kantor & cabang, kategori produk, dan produk dengan mudah dalam satu platform terintegrasi.

#### Pengelolaan Stok dalam Penjualan, Alokasi, Mutasi, dan Retur
- Atur stok produk untuk penjualan, alokasi, mutasi antar cabang, dan proses retur penjualan dengan efisien.

#### Cetak Invoice
- Fitur untuk mencetak invoice dari penjualan yang telah tercatat sehingga memudahkan pembuatan dan pengelolaan dokumen penjualan yang akurat.

#### Kartu Stok
- Tinjau dan pantau histori masuk dan keluarnya stok untuk memastikan transparansi dan akurasi dalam pengelolaan stok dengan riwayat yang lengkap.

#### Export Data Histori Stok ke Microsoft Excel
- Ekspor data histori stok ke format Excel untuk pelaporan dan analisis lebih lanjut.

#### Menambahkan User tanpa Batas
- Tambah akun pengguna tanpa batas, baik untuk pusat maupun cabang.

#### Kelola Profil
- Ubah foto profil, username, nama, dan informasi profil lainnya.

#### Lupa & Ubah Password
- Fitur untuk memulihkan password dan mengubah password melalui halaman profil sehingga dapat meningkatkan keamanan dan kemudahan akses akun pengguna.

#### Ubah Email
- Ubah alamat email dengan verifikasi melalui sistem email sehingga memastikan email pengguna selalu diperbarui dan akurat untuk komunikasi dan pemulihan akun.

### Versi Free
- Pengelolaan data
- Stok dalam penjualan dan alokasi
- Cetak invoice
- Kartu stok saat ini
- Menambahkan user tanpa limit
- Kelola profil
- Ubah password


## Multilevel Auth

Pengguna yang terdaftar terdiri dari 2 jenis, yaitu role Pusat dan Cabang.
- Pusat dapat melakukan:
    - Lihat, Tambah, Edit, dan Hapus Data Salesman, Konsumen, Pusat & Cabang, dan User.
    - Lihat, Tambah, Edit, dan Hapus Data Supplier, Kategori Produk, dan Produk.
    - Lihat Data Penjualan.
    - Lihat, Tambah, dan Edit Data Alokasi.
    - Lihat Data Mutasi.
    - Lihat Data Retur.
    - Lihat Kartu Stok dan Tambah & Edit Data Stok Awal Produk.
    - Kelola Profil.

- Cabang dapat melakukan:
    - Lihat dan Tambah Data Salesman.
    - Lihat, Tambah, dan Edit Data Konsumen.
    - Lihat Data Supplier, Kategori Produk, dan Produk.
    - Lihat dan Tambah Data Penjualan.
    - Lihat, Tambah, dan Update Status Data Mutasi.
    - Lihat dan Tambah Data Retur.
    - Lihat Kartu Stok.
    - Kelola Profil.

## Tech

Teknologi dalam aplikasi ini:
- [CodeIgniter 4](https://www.codeigniter.com/) - a flexible application development framework.
- [Myth/Auth](https://github.com/lonnieezell/myth-auth) - a flexible, Powerful, Secure auth package for CodeIgniter 4.
- [Tabler.io](https://tabler.io/) - a free and open source web application UI kit based on Bootstrap 5.
- [jQuery](https://jquery.com/) - a fast, small, and feature-rich JavaScript library.

## Support

[![PayPal](https://img.shields.io/badge/PayPal-00457C?style=for-the-badge&logo=paypal&logoColor=white)](https://paypal.me/zyfars)

## Credits

> Made by [Naufal](https://Nafars24.github.io/).
> Template by [tabler.io](tabler.io)
