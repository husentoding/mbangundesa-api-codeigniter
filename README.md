# mbangun desa rest api

## Daftar Method yang dapat digunakan saat ini

#### 1. Ambil Semua Product CSR di Database
- Method : GET
- URL : http://mbangundesa.id/api/index.php/CSR //tanpa parameter bakal ngeluarin semua produk 
- URL : http://mbangundesa.id/api/index.php/CSR?id=1 //pake parameter id, bakal ngeluarin produk id=1
- Output : ![alt text](http://url/to/img.png)


### 2. Insert produk CSR ke Database
- Method : POST
- URL : http://mbangundesa.id/api/index.php/CSR 
- Parameter : id_village
name
goal
expire_date
description
- Output : Jika berhasil 200 ok dan Data yang di input akan di return lagi

### 3. Edit Profile User
- Method : POST
- URL : http://mbangundesa.id/api/index.php/EditProfile
- Parameter : judul
konten
mitra_id
desa_id
pic // foto profile baru
- Output : Jika berhasil 200 ok dan Data yang di input akan di return lagi(khusus gambar yang di return url nya)

### 4. Ambil Semua product Investasi di Database
- Method : GET
- URL : http://mbangundesa.id/api/index.php/invest
- Output : 

### 5. Upload foto Mitra // blm sempurna, id blm diganti, masih di hardcode ke id 6
- Method : POST
- URL : http://mbangundesa.id/api/index.php/mitra
- Parameter : pic //gambar
action //tipe gambar yg akan di upload, 
nb : action harus diantara 5 kode string ini : ktp, foto_profile, mitra_selfie, mitra_pengangkatan, atau pasfoto

### 6. Upload data Mitra
//belum di tes

### 7. Get data Produk dari database
// sudah ada, dokumentasi nanti krn blm penting

### 8. Insert data Produk ke database
// sudah ada, dokumentasi nanti krn blm penting

### 9. Ambil data profile user
- Method : POST
- URL : http://mbangundesa.id/api/index.php/Profile
- Parameter : username
- Output : 

### 10. Register akun baru
- Method : POST
- URL : http://api.mbangundesa.id/index.php/Register/
- Parameter : email
username
password
- Output : 

### 11. Login user
- Method : POST
- URL : http://api.mbangundesa.id/index.php/User/
- Parameter : username
password

### 12. Insert Data Laporan (Hanya Gambar Tanpa Data)
- Method : POST
- URL : http://api.mbangundesa.id/index.php/laporan
- Parameter : mitra_id
pic //gambar
aksi = gambar
laporan_id

**NOTE** : Gambar hanya bisa di insert kalau data laporan sudah ada(gunakan method 13 terlebih dahulu lalu gunakan method ini)

### 13. Insert Data Laporan (Hanya Data Tanpa Gambar)
- Method : POST
- URL : http://api.mbangundesa.id/index.php/laporan
- Parameter : judul
kontent
mitra_id
desa_id
aksi = data
