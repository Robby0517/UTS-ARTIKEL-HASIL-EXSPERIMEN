# UTS-ARTIKEL-HASIL-EXSPERIMEN

 PDF ARTIKEL YANG SUDAH DIBUAT : [DOC-20250510-WA0003..pdf](https://github.com/user-attachments/files/20133394/DOC-20250510-WA0003.pdf) 

Eksperimen Deteksi serta Pencegahan Serangan SQL Injection di Aplikasi Web Memakai Pencocokan Pola


Jurusan Teknik Informaika, UPB, Cikarang
e-mail: robbyakuensi@gmail.com


Abstrak
Injeksi SQL menjadi salah satu ancaman keamanan paling lumrah yang menyerang aplikasi web di seluruh dunia, terkhususnya yang memakai basis data. Dalam eksperimen ini, saya coba membangun sistem simpel untuk mendeteksi serta mencegah serangan SQL Injection menggunakan metode pencocokan pola. Tujuannya yaitu untuk mengetahui seberapa efektif metode ini dalam menangkis serangan yang memanfaatkan celah masukan pengguna. Proses pengujian dilakukan dengan membuat halaman login sederhana menggunakan PHP dan MySQL, lalu disimulasikan dengan berbagai masukan berbahaya. Hasilnya menunjukkan bahwa pencocokan pola lumayan efektif mendeteksi serangan yang umum, tetapi masih memiliki kekurangan dalam mendeteksi variasi serangan yang lebih kompleks.

Kata kunci— SQL Injection, keamanan web, pencocokan pola, PHP, deteksi serangan.

Abstract
SQL injection is one of the most common security threats that attack web applications worldwide, especially those that use databases. In this experiment, I try to build a simple system to detect and prevent SQL Injection attacks using the pattern matching method. The goal is to find out how effective this method is in fending off attacks that exploit user input gaps. The testing process is carried out by creating a simple login page using PHP and MySQL, then simulating it with various malicious inputs. The results show that pattern matching is quite effective in detecting common attacks, but still has shortcomings in detecting more complex variations of attacks.

Keywords— SQL Injection, web security, pattern matching, PHP, attack detection.

1. PENDAHULUAN

Kemajuan aplikasi web yang semakin cepat rupanya diiringi oleh bertambahnya ancaman keamanan, salah satunya yaitu SQL Injection. Jenis serangan ini memungkinkan penyerang untuk menyisipkan perintah SQL ke dalam masukan pengguna, yang jika tidak disaring dengan benar, bisa membahayakan data di dalam basis data. Dari beberapa literatur yang saya baca, termasuk jurnal dari Theresiawati (2021) dan Septiyani (2022), SQL Injection bisa terjadi karena aplikasi web tidak melakukan validasi masukan dengan baik. Selain itu, Darmadi (2019) menjelaskan bahwa karakter-karakter seperti ', --, dan ; kerap dipakai dalam serangan ini. Oleh karena itu, pada eksperimen ini saya mencoba membuat sistem deteksi sederhana yang dapat mengenali pola-pola tersebut menggunakan pendekatan pattern matching.


2. METODE PENELITIAN
Penyelidikan ini memakai cara percobaan dengan pendekatan studi kasus untuk menguji kerentanan pada serangan SQL Injection pada aplikasi web yang dibuat secara sederhana. Penyelidikan dilaksanakan lewat tahapan sebagai berikut:
Perancangan Sistem Uji
    Aplikasi web sederhana dibuat menggunakan PHP dan MySQL sebagai backend, dengan formulir masuk sebagai target utama untuk pengujian. Aplikasi ini tidak menggunakan teknik pengamanan seperti parameterized query atau prepared statement, untuk mensimulasikan celah yang umum ditemui pada sistem yang belum diamankan.
Identifikasi dan Simulasi Serangan
    Serangan SQL Injection diuji memakai beragam teknik, seperti:
Tautan langsung dalam input formulir (' OR '1'='1), Union-based SQL Injection, danError-based SQL Injection. Pengujian dilakukan dengan memanfaatkan peramban serta tools seperti sqlmap untuk mengotomatisasi eksploitasi celah.
Perangkat yang Dipakai
•	PHP (versi 7.4)
•	MySQL
•	XAMPP
•	Browser (Chrome)
•	Text Editor (Visual Studio Code)
2.1 Tahapan Review 
1.	Bikin halaman masuk dengan masukan username dan kata sandi.
2.	Buat daftar pola karakter berbahaya, kayak ', ", --, UNION, dan semacamnya..
3.	Tiap masukan dari pengguna dicek dengan mencocokkan ke daftar pola itu..
4.	Kalau ada pola mencurigakan yang ditemukan, maka sistem bakal memblokir masukan serta menampilkan pesan peringatan.
5.	Dilakukan simulasi serangan SQL Injection dengan beragam contoh payload dari referensi yang dibaca.
2. 1.1Gambar dan tabel
Dari kira-kira 30 masukan uji yang saya coba (contohnya ' OR '1'='1, '--, dan UNION SELECT), sistem sukses mengenali sekitar 27 masukan berbahaya dan menolak proses login. Beberapa masukan yang lolos lazimnya memakai cara penyamaran seperti encoding atau memakai fungsi CHAR() dalam SQL.
Misalnya waktu saya mengetik:
' OR '1'='1

  ![image](https://github.com/user-attachments/assets/5ce89a84-5f4b-4cfb-9e10-3f36a3f568ff)

Gambar 1  UJI COBA
Sistem langsung memblokir dan memperlihatkan pesan: "Masukan tidak valid, terdeteksi karakter mencurigakan."
Akan tetapi, waktu mencoba:
CHAR(39)+OR+CHAR(49)=CHAR(49)

 ![image](https://github.com/user-attachments/assets/4db56812-edcf-4a55-844a-a38c024e5e6e)

Gambar 2  UJI COBA

Sistem tidak mendeteksinya sebab belum ada pola buat itu.

3. HASIL DAN PEMBAHASAN

Hasil Eksperimen - SQL Injection.
Eksperimen dilakukan dengan membuat halaman masuk sederhana memakai PHP serta MySQL tanpa memakai teknik keamanan seperti prepared statement maupun parameterized query. Tujuannya untuk menguji efektivitas metode pencocokan pola terhadap serangan SQL Injection klasik.
Sebanyak 30 input berbahaya diuji terhadap sistem, yang terdiri dari serangan tipe error-based, union-based, dan serangan logika simpel seperti `' OR '1'='1`. Sistem dirancang untuk memeriksa input terhadap daftar karakter atau kata kunci yang dianggap berbahaya seperti ', ", --, UNION, dan sebagainya.

Tabel Rekapitulasi Hasil Uji Coba SQL Injection
No	 Input Uji	                         Jenis Serangan	          Dikenali Sistem	  Keterangan
1	   ' OR '1'='1	                       Login Bypass (logic)	      Ya	            Diblokir, pesan ditampilkan
2	   admin' --	                         Comment Injection	        Ya	            Diblokir
3	   UNION SELECT username, password	   Union-based	              Ya	            Diblokir
4    1' AND 1=1 --	                     Logic Injection	          Ya	            Diblokir
5	   CHAR(39)+OR+CHAR(49)=CHAR(49)	     Obfuscated Payload	       Tidak	          Lolos deteksi
30	0' OR 1=1	                           Login Bypass	               Ya	            Diblokir

Deskripsi Ilustrasi Hasil Uji

  ![image](https://github.com/user-attachments/assets/8c286c32-c384-4b2c-8b0b-e3f87003332c)

Gambar 1 before – Deteksi Serangan Klasik
Input: ' OR '1'='1


  ![image](https://github.com/user-attachments/assets/a396b277-449f-4b5d-9d84-48130a7a55de)

Gambar 1 after – Deteksi Serangan Klasik
Input: ' OR '1'='1

Sistem langsung memblokir dan menampilkan pesan:
"Masukan tidak valid, terdeteksi karakter mencurigakan."


  ![image](https://github.com/user-attachments/assets/5d07bc64-562e-47dc-ae8b-f65df3a0dc57)

Gambar 2 – Serangan Obfuscated yang Tidak Terdeteksi
Input: CHAR(39)+OR+CHAR(49)=CHAR(49)
Sistem gagal mendeteksi karena karakter yang digunakan tidak termasuk dalam daftar pola yang sudah didefinisikan.

Hasil percobaan memperlihatkan bahwa pencocokan pola cukup efektif mendeteksi pola serangan SQL Injection klasik. Cara ini mudah diterapkan dan cepat dieksekusi karena cuma membandingkan masukan dengan daftar karakter yang dicurigai. Walau begitu, kekurangannya adalah sistem ini mesti terus diperbarui secara manual jika muncul pola-pola baru.
Saya pun menyadari bahwa pendekatan ini hanya sesuai untuk sistem yang sederhana. Untuk sistem berskala besar, perlu dikombinasikan dengan teknik lain seperti parameterized query, prepared statement, atau bahkan machine learning supaya dapat lebih adaptif.



4. KESIMPULAN

Dari eksperimen yang saya lakukan, dapat disimpulkan bahwa:
• SQL Injection bisa dicegah dengan cara menyaring input secara ketat.
• Pola pencocokan efektif untuk mengenali input berbahaya yang sering dipakai.
• Namun sistem ini belum cukup kuat untuk mengatasi serangan yang lebih rumit dan tersembunyi.
Sebagai pengembangan, saya menyarankan:
1.	Memakai pola yang lebih lengkap dan mendalam.
2.	Menggabungkan metode ini dengan prepared statement di PHP.
3.	Menambahkan log aktivitas untuk menganalisis percobaan serangan lebih lanjut.


5. SARAN

Riset ini masih mempunyai batasan pada tipe dan cakupan teknik SQL Injection yang diuji. Untuk riset selanjutnya, disarankan agar eksplorasi diperluas meliputi teknik SQL Injection lanjutan seperti Blind SQL Injection, Time-based SQLi, dan metode deteksi otomatis memakai machine learning. Selain itu, penerapan simulasi pada berbagai framework web yang lebih bervariasi bisa memberi hasil yang lebih representatif terhadap kondisi sebenarnya di lapangan. Pengujian keamanan juga bisa dikembangkan memakai pendekatan real-time monitoring agar respons sistem terhadap serangan bisa dianalisis lebih mendalam.


UCAPAN TERIMA KASIH

Penyusun mengucapkan terima kasih kepada seluruh pihak yang telah menunjang terlaksananya riset ini, teristimewa kepada Program Studi Teknik Informatika, Fakultas Teknologi Informasi, serta kepada Lembaga Penelitian dan Pengabdian Masyarakat (LPPM) yang sudah memberi dukungan finansial terhadap pelaksanaan riset ini.

DAFTAR PUSTAKA
[1] Theresiawati, T. (2021). Sistem Deteksi dan Pencegahan Serangan SQL Injection Menggunakan Metode Pattern Matching Berbasis Web. Jurnal Sisfotek Global, 3(4), 215–220.
[2] Septiyani, M. (2022). Analisis SQL Injection dalam Pengamanan Data pada Sistem Informasi Akademik. Jurnal Teknologi Informasi dan Ilmu Komputer, 9(2).
[3] Castleman, Kenneth R., 2004, Digital Image Processing, Vol. 1, Ed.2,  Prentice Hall, New Jersey.
[4] Gonzales, R., P. 2004, Digital Image Processing (Pemrosesan Citra Digital), Vol. 1, Ed.2,  diterjemahkan oleh Handayani, S., Andri Offset, Yogyakarta.
[5] Darmadi, A. (2019). Deteksi Dini SQL Injection Menggunakan Pola Karakter Berbahaya. Jurnal Teknologi Informasi dan Komunikasi, 7(2).
[6] Wyatt, J. C, danSpiegelhalter, D., 1991,  Field Trials of Medical Decision-Aids: PotentialProblems and Solutions,  Clayton, P. (ed.): Proc. 15th Symposium on ComputerApplications in Medical Care, Vol 1, Ed. 2, McGraw Hill Inc, New York.
[7] Situmorang, A. (2021). Studi Implementasi Sistem Pencegahan SQL Injection Berbasis Logika Fuzzy. Jurnal Teknologi Komputer dan Sistem Informasi, 8(3).
[8]Yusoff, M, Rahman, S.,A., Mutalib, S., and Mohammed, A. , 2006, Diagnosing Application Development for Skin Disease Using Backpropagation Neural Network Technique, Journal of Information Technology, vol 18, hal 152-159.

[9]	 Wyatt, J. C, Spiegelhalter, D, 2008, Field Trials of Medical Decision-Aids: PotentialProblems and Solutions, Proceeding of  15th Symposium on ComputerApplications in Medical Care, Washington, May 3.

[10] Prasetya, E., 2006, Case Based Reasoning untuk mengidentifikasi kerusakan bangunan, Tesis, Program Pasca Sarjana Ilmu Komputer, Univ. Gadjah Mada, Yogyakarta.
