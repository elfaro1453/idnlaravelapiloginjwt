# Membuat API Menggunakan Laravel

Kenapa Laravel ? Menurut [StackOverFlow's Developer Survey](https://insights.stackoverflow.com/survey/2019#technology-_-most-loved-dreaded-and-wanted-web-frameworks) , laravel cukup dicintai developer dengan persentase survey 60.1 %, Laravel juga menyediakan frontend framework berupa bootstrap, react dan vue yang bisa digunakan nanti.

## Syarat Penggunaan Laravel

Syarat menggunakan laravel adalah anda bisa menjalankan php, composer dan node/npm pada cmd/terminal, selain itu juga perlu adanya koneksi ke database semisal phpMyAdmin, silahkan install MAMP atau XAMPP.

* Jalankan Perintah berikut di terminal : `php -v`

hasilnya :

```html
> php -v
PHP 7.2.10 (cli) (built: Oct  3 2018 11:43:40) ( ZTS MSVC15 (Visual C++ 2017) x86 )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.2.0, Copyright (c) 1998-2018 Zend Technologies
```

Versi Minimum PHP adalah __7.2.xx__

* Jalankan Perintah berikut di terminal : `composer --version`

hasilnya :

```html
> composer --version
Composer version 1.8.6 2019-06-11 15:03:05
```

Versi Minimum Composer adalah __1.8.xx__

* Node dan NPM Version

```html
> node --version
v10.16.3
> npm --version
6.9.0
```

Versi Node dan NPM di atas adalah versi minimum.

## Setting Up Database

1. Start Server XAMPP/MAMP

2. Buka phpMyAdmin di browser

    XAMPP   : <http://localhost/phpmyadmin>
    MAMP    : <http://localhost/phpMyAdmin>

3. Buka tab basis data, buat basis data seperti berikut :

    ```html
    nama : laravel6api
    penyortiran : utf8mb4_unicode_ci
    ```

## Install Laravel

Jika anda baru pertama kali menginstall Laravel, maka anda perlu menginstall laravel via composer.

1. Buka CMD/Terminal

2. Jalankan perintah : `composer global require laravel/installer`

3. Jalankan perintah : `laravel --version`

    ```html
    > laravel --version
    Laravel Installer 2.1.0
    ```

    Versi terbaru saat tutorial ini dibuat adalah 2.1.0

    Jika anda menemukan error : `bash: laravel: command not found` , solusinya :

    Untuk pengguna __MacOS__ / UNIX Based OS

    a. jalankan perintah berikut di terminal

    ```html
    > vim ~/.bash_profile 
    ```

    b. Tekan tombol `[i]` untuk insert.

    c. Ketik kode berikut ini di dalam `bash_profile` :

    ```html
    export PATH=~/.composer/vendor/bin:$PATH
    ```

    d. Tekan tombol `[esc]` , ketik `:wq` , tekan tombol [Enter] untuk menyimpan

    e. Jalankan perintah `source ~/.bash_profile`

    f. Cek kembali versi laravel installer : `laravel --version`

4. Buat project laravel baru : `laravel new laravelapi`

5. Masuk ke folder project : `cd laravelapi`

## FrontEnd Scaffolding

Setelah sukses membuat project laravel baru, kita perlu men-set-up frontend, caranya :

[<https://laravel.com/docs/6.x/frontend]>

1. Download laravel ui ke dalam project, dengan menjalankan perintah : `composer require laravel/ui --dev`

2. Pilih Bootstrap Scaffolding dengan menjalankan perintah : `php artisan ui bootstrap --auth`

3. Jalankan perintah : `npm install`

4. Jalankan perintah : `npm run watch`

5. __Buka CMD/Terminal baru__, `cd` ke dalam folder project, jalankan perintah : `php artisan run serve`

6. Buka <http://127.0.0.1/> di browser.

## User Management

Kali ini kita akan menghubungkan Laravel dengan database yang telah kita buat sebelumnya.

Buka file `.env` di dalam folder project menggunakan text-editor, cari kode berikut :

```html
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Modifikasi `DB_DATABASE=laravel` , `DB_USERNAME=root`, `DB_PASSWORD=` sesuai dengan database, username dan password phpmyadmin.
