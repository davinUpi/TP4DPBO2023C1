# TP4DPBO2023C1

Saya Davin mengerjakan evaluasi TP4DPBO2023 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## penjelasan



### Models
#### kelas model
Semua kelas model adalah kelas yang merepresentasikan tabel di basis data. Adapuns setiap model merupakan keturunan dari abstract class SQLViewTable atau SQLTable.

#### kelas SQLViewTable
Sebuah abstract class yang merepresentasikan views pada basis data mysql. Tabel ini hanya dapat menjalankan query select, sehingga hanya memiliki metode untuk mengambil data. Merupakan keturunan dari abstract class Database

#### kelas SQLTable
sebuah abstract class yang merepresentasikan tabel sql pada biasanya. Diturunkan dari SQLViewTable sebab dapat melakukan semua yang dilakukan views beserta penambahan, modifikasi, dan penghapusan data.

#### kelas Database
sebuah abstract class untuk mengeksekusi query dan membangun koneksi dengan basis data. Adapun query menggunakan objek dari kelas QueryBuilder

#### kelas QueryBuilder
sebuah kelas untuk mempermudah pembangunan query. ewibxignewbg

### Views
#### semua kelas .view
merupakan kelas untuk menggambarkan sebuah page. Menerima input constructor berupa file .html yang akan menjadi dasar dari page. Merupakan kelas turunan ViewHandler

#### kelas ViewHandler
merupakan abstract kelas yang bertaggung jawab untuk memodifikasi file .html sehingga dapat menampilkan data pada page

### Controllers
#### semua kelas .controller
merupakan kelas2 yang menjadi back-end sebuah page. Penggunanaan model dan views sesuai kebutuhannya.

### Doksli
![2023-06-01 14-11-41](https://github.com/davinUpi/TP4DPBO2023C1/assets/100902319/88773302-7023-4799-9327-d2690b50edf1)
###### demo

![Screenshot (911)](https://github.com/davinUpi/TP4DPBO2023C1/assets/100902319/5d70c9b7-a05f-4603-b13f-4071328933bc)
###### index


![Screenshot (912)](https://github.com/davinUpi/TP4DPBO2023C1/assets/100902319/c2c46216-0051-4f3f-9298-4ea42b3750e5)
###### university


![Screenshot (913)](https://github.com/davinUpi/TP4DPBO2023C1/assets/100902319/cf652c6e-44ac-4768-b578-7532d765bcfc)
###### create

![Screenshot (914)](https://github.com/davinUpi/TP4DPBO2023C1/assets/100902319/d554a466-0b5c-4909-ad7d-29a11e922754)
###### setelah create

