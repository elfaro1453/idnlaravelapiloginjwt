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

5. __Buka CMD/Terminal baru__, `cd` ke dalam folder project, jalankan perintah : `php artisan serve`

6. Buka <http://127.0.0.1/> di browser.

## Struktur Direktori Project

Kurang lebih struktur dalam project adalah seperti berikut ini :

```html
    > laravelapi
        > app
        > bootstrap
        > config
        > database
        > node_modules
        > public
        > resources
        > routes
        > storage
        > tests
        > vendor
        .editorconfig
        .env
        .env.example
        .artisan
        composer.json
        composer.lock
        package-lock.json
        package.json
        phpunit.xml
        server.php
        webpack.mix.js
```

## Modifikasi .env

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

## Users dan Roles

Kita akan membuat role untuk user berupa __admin__ dengan user role 1, dan __member__ dengan user role 2.

Buka file `> database > migrations > 2014_10_12_000_create_users_table.php`

Edit kode bagian berikut

```php
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
```

Menjadi :

```php
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->integer('role')->default(2);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
```

* _Penambahan `->nullable();` di sebelah `$table->string('name')` agar tidak terjadi error meski user tidak memberi nama._
* _Penambahan `$table->integer('role')->default(2);` agar saat pendaftaran user baru akan **otomatis** memiliki privilege member_

### Edit Database Seeder

Agar bisa login, kita akan membuat User Admin dan User Member dengan cara :

1. Buka file `> database > seeds > DatabaseSeeder.php`

2. Replace Kode di dalamnya dengan kode berikut ini :

    ```php
        <?php
        use App\User;
        use Illuminate\Database\Seeder;
        use Illuminate\Support\Facades\Hash;
        class DatabaseSeeder extends Seeder
        {
            public function run()
            {
                User::create([
                'name' => 'Admin Ganteng',
                'email' => 'admin@ganteng.com',
                'password' => Hash::make('admin1234'),
                'role' => 1
                ]);

                User::create([
                'name' => 'Member Biasa',
                'email' => 'member@biasa.com',
                'password' => Hash::make('member1234'),
                'role' => 2
                ]);
            }
        }
    ```

3. [Migrate](https://laravel.com/docs/6.x/migrations) Database dan [Seeding](https://laravel.com/docs/6.x/seeding)

```html
php artisan migrate --seed
```

Setelah sukses migrate database, anda bisa log in di <http://127.0.0.1/login> menggunakan akun yang telah dibuat tadi.

## Login Menggunakan API JWT (Json Web Token)

JSON Web Token adalah sebuah metode otentifikasi yang biasa dipakai pada API sederhana, lanjut saja kita akan menggunakan [JWT Auth for Laravel](https://github.com/tymondesigns/jwt-auth).

<https://jwt-auth.readthedocs.io/en/develop/quick-start/>

1. Tambahkan vendor tymon/jwt-auth pada proyek dengan menjalankan perintah :

    ```html
    composer require tymon/jwt-auth:dev-develop
    ```

2. Publish vendor pada laravel :

    ```html
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    ```

    _Langkah ini akan membuat file `> config > jwt.php`_

3. Buat JWT Secret Key pada file `.env` secara otomatis dengan perintah :

    ```html
    php artisan jwt:secret
    ```

4. Buka file `> config > auth.php`, modifikasi baris berikut :

    ```html
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],
    ```

    Menjadi :

    ```html
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],
    ```

5. Modifikasi User Model file `> app > user.php` menjadi seperti berikut ini :

    ```html
    <?php

    namespace App;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Tymon\JWTAuth\Contracts\JWTSubject;

    class User extends Authenticatable
    {
        use Notifiable;

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = [
            'name', 'email', 'role', 'password',
        ];

        /**
        * The attributes that should be hidden for arrays.
        *
        * @var array
        */
        protected $hidden = [
            'password', 'remember_token',
        ];

        /**
        * The attributes that should be cast to native types.
        *
        * @var array
        */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
        public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        public function getJWTCustomClaims()
        {
            return [];
        }
    }
    ```

    Simpan file.

6. Modifikasi file `> app > Http > Middleware > Authenticate.php` menjadi seperti berikut ini :

    ```html
    <?php
    namespace App\Http\Middleware;
    use Closure;
    use Illuminate\Auth\Middleware\Authenticate as Middleware;
    class Authenticate extends Middleware
    {
        public function handle($request, Closure $next, ...$guards)
        {
            if ($this->authenticate($request, $guards) === 'authentication_error') {
                return response()->json(['error'=>'Unauthorized']);
            }
            return $next($request);
        }
        protected function authenticate($request, array $guards)
        {
            if (empty($guards)) {
                $guards = [null];
            }
            foreach ($guards as $guard) {
                if ($this->auth->guard($guard)->check()) {
                    return $this->auth->shouldUse($guard);
                }
            }
            return 'authentication_error';
        }
    }

    ```

7. Simpan file

    Jalankan server laravel dengan perintah `php artisan serve`

    Buka Aplikasi PostMan, lakukan request Get ke alamat `http://127.0.0.1:8000/api/user` , maka response-nya adalah :

    ```html
    {
        "error": "Unauthorized"
    }
    ```

8. Buka file `> routes > api.php`, tambahkan baris berikut :

    ```html
    Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
        });
    });
    ```

9. Buatlah controller `AuthController` seperti yang dibutuhkan oleh routes api di atas :

    Jalankan perintah : `php artisan make:controller AuthController`

    Perintah ini akan menghasikan file `/app/Http/Controllers/AuthController.php`

10. Buka file tersebut, masukkan kode berikut ini :

    ```php
    <?php
        namespace App\Http\Controllers;
        use App\User;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Validator;
        use Illuminate\Support\Facades\Hash;

        class AuthController extends Controller
        {
            public function register(Request $request)
            {
                $v = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'password'  => 'required|min:6|confirmed',
                ]);

                if ($v->fails())
                {
                return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
                ], 422);
                }
                $user = new User;
                $user->email = $request->email;
                $user->password =  Hash::make($request->password);
                $user->save();
                return response()->json(['status' => 'success'], 200);
            }

            public function login(Request $request)
            {
                $credentials = $request->only('email', 'password');
                if ($token = $this->guard()->attempt($credentials)) {
                return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
                }
                return response()->json(['error' => 'login_error'], 401);
            }

            public function logout()
            {
                $this->guard()->logout();
                return response()->json([
                'status' => 'success',
                'msg' => 'Logged out Successfully.'
                ], 200);
            }

            public function user(Request $request)
            {
            $user = User::find(Auth::user()->id);
            return response()->json([
            'status' => 'success',
            'data' => $user
            ]);
            }

            public function refresh()
            {
                if ($token = $this->guard()->refresh()) {
                return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
                }
                return response()->json(['error' => 'refresh_token_error'], 401);
            }

            private function guard()
            {
            return Auth::guard();
            }
        }
    ```

## RALAT

Buka file `> app > User.php` , ganti kode berikut :

```html
    class User extends Authenticatable
```

dengan kode berikut :

```html
class User extends Authenticatable implements JWTSubject
```

Simpan `User.php`.


## PostMan

Jalankan `php artisan serve`.

1. Gunakan Postman, lakukan request POST ke alamat : <http://127.0.0.1:8000/api/auth/login>

2. Pada body request pilih `x-www-form-urlencoded`.

3. Masukkan Key : `email` Value : `member biasa` , dan Key : `password` Value : `member1234` , klik [SEND]

4. Jika sukses maka pada Response Body berisi json :

    ```html
    {
        "status": "success"
    }
    ```

    dan pada header akan berisi Custom header : `Authorization`, beserta value berupa token.
