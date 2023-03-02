
## Cara Install
1. **Clone Repo**

```
$ git clone https://github.com/prayogimhd/elisoft-test.git
```
2. Jalankan perintah

```shell
# install composer-dependency
$ composer install

# lalu jalankan perintah
$ cp .env.example .env

# kemudian menjalankan perintah key:generate
$ php artisan key:generate
```
3. Buat database dengan nama `elisoft-test` & **Konfigurasi database `.env`**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elisoft-test
DB_USERNAME=root
DB_PASSWORD=
```    

4. **Migrasi Database**

```bash
$ php artisan migrate

# kemudian jalankan perintah
$ php artisan optimize:clear
```    
5. **Jalankan Server**
```bash
$ php artisan serve

```
