<h1 class="code-line" data-line-start=0 data-line-end=1 ><a id="_Aplikasi_Laundry_MultiUser_0"></a>🛒 Aplikasi Laundry Multi-User</h1>
<p class="has-line-data" data-line-start="2" data-line-end="8"><img src="https://img.shields.io/badge/Laravel-10.x-red" alt="Laravel Version"><br>
<img src="https://img.shields.io/badge/PHP-%5E8.1-blue" alt="PHP Version"><br>
<img src="https://img.shields.io/badge/Style-TailwindCSS-38bdf8" alt="TailwindCSS"><br>
<img src="https://img.shields.io/badge/Database-MySQL-yellow?logo=mysql" alt="MySQL"><br>
<img src="https://img.shields.io/badge/Test%20Coverage-90%25-brightgreen" alt="Coverage"><br>
<img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="License: MIT"></p>
<p class="has-line-data" data-line-start="9" data-line-end="10">Aplikasi pengelolaan laundry berbasis Laravel. digunakan untuk membuat transaksi laundry, melacak status cucian, mengelola dan me manajemen outlet, mengelola laporan transaksi laundry</p>
<hr>
<h2 class="code-line" data-line-start=13 data-line-end=14 ><a id="_Fitur_Utama_13"></a>🛠️ Fitur Utama</h2>
<ul>
<li class="has-line-data" data-line-start="15" data-line-end="16">✅ Manajemen Outlet Laundry</li>
<li class="has-line-data" data-line-start="16" data-line-end="17">✅ Transaksi Laundry</li>
<li class="has-line-data" data-line-start="17" data-line-end="18">✅ Melacak Status setiap Cucian</li>
<li class="has-line-data" data-line-start="18" data-line-end="19">✅ Mengelola Laporan setiap Transaksi Laundry</li>
</ul>
<hr>
<h2 class="code-line" data-line-start=21 data-line-end=22 ><a id="_Prasyarat_21"></a>💡 Prasyarat</h2>
<p class="has-line-data" data-line-start="23" data-line-end="24">Sebelum memulai, pastikan kamu sudah menginstall:</p>
<ul>
<li class="has-line-data" data-line-start="25" data-line-end="26">🐘 PHP    &gt;= 8.1  Disarankan versi terbaru</li>
<li class="has-line-data" data-line-start="26" data-line-end="27">🎼 Composer   -   Untuk mengelola dependensi PHP</li>
<li class="has-line-data" data-line-start="27" data-line-end="28">🧰 Node.js    -   Digunakan bersama Tailwind + Vite</li>
<li class="has-line-data" data-line-start="28" data-line-end="29">📦 npm    -   Biasanya sudah include di Node.js</li>
<li class="has-line-data" data-line-start="29" data-line-end="31">🐬 MySQL / 🐳 MariaDB -   Untuk database aplikasi</li>
</ul>
<hr>
<h2 class="code-line" data-line-start=33 data-line-end=34 ><a id="_Instalasi_dan_Konfigurasi_33"></a>🚀 Instalasi dan Konfigurasi</h2>
<h3 class="code-line" data-line-start=35 data-line-end=36 ><a id="_1_Clone_Project_35"></a>🧱 1. Clone Project</h3>
<pre><code class="has-line-data" data-line-start="38" data-line-end="41" class="language-bash">git <span class="hljs-built_in">clone</span> https://github.com/username-kamu/nama-repo.git
<span class="hljs-built_in">cd</span> nama-repo
</code></pre>
<h3 class="code-line" data-line-start=42 data-line-end=43 ><a id="_2_Install_Depedency_42"></a>📦 2. Install Depedency</h3>
<pre><code class="has-line-data" data-line-start="44" data-line-end="47" class="language-bash">composer install
npm install
</code></pre>
<h3 class="code-line" data-line-start=48 data-line-end=49 ><a id="_3_Setup_File_env_48"></a>⚙️ 3. Setup File <code>.env</code></h3>
<pre><code class="has-line-data" data-line-start="50" data-line-end="52" class="language-bash">cp .env.example .env
</code></pre>
<h3 class="code-line" data-line-start=53 data-line-end=54 ><a id="_4_Konfigurasi_File_env_53"></a>🛠️ 4. Konfigurasi File <code>.env</code></h3>
<p class="has-line-data" data-line-start="55" data-line-end="56">Setelah menyalin file <code>.env</code>, pastikan kamu mengatur konfigurasi dasar seperti berikut:</p>
<pre><code class="has-line-data" data-line-start="58" data-line-end="68" class="language-env">APP_NAME=&quot;Laundry&quot;
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laundry
DB_USERNAME=root
DB_PASSWORD=
</code></pre>
<p class="has-line-data" data-line-start="68" data-line-end="69">⚠️ Pastikan nama database (DB_DATABASE) sudah dibuat di MySQL kamu sebelum menjalankan migrasi.</p>
<h3 class="code-line" data-line-start=70 data-line-end=71 ><a id="_5_Generate_Key_70"></a>🔐 5. Generate Key</h3>
<pre><code class="has-line-data" data-line-start="72" data-line-end="74" class="language-bash">php artisan key:generate
</code></pre>
<h3 class="code-line" data-line-start=75 data-line-end=76 ><a id="_6_Setup_Database_75"></a>🗄 6. Setup Database</h3>
<pre><code class="has-line-data" data-line-start="77" data-line-end="79" class="language-bash">php artisan migrate --seed
</code></pre>
<h3 class="code-line" data-line-start=80 data-line-end=81 ><a id="_7_Compile_Aset_Frontend_TailwindCSS__Vite_80"></a>🌐 7. Compile Aset Frontend (TailwindCSS &amp; Vite)</h3>
<pre><code class="has-line-data" data-line-start="82" data-line-end="84" class="language-bash">npm run dev
</code></pre>
<h3 class="code-line" data-line-start=85 data-line-end=86 ><a id="_8_Jalankan_Projek_85"></a>▶️ 8. Jalankan Projek</h3>
<pre><code class="has-line-data" data-line-start="87" data-line-end="89" class="language-bash">php artisan serve
</code></pre>
<hr>
<h2 class="code-line" data-line-start=92 data-line-end=93 ><a id="_Akun_Login_Default_92"></a>🔐 Akun Login Default</h2>
<p class="has-line-data" data-line-start="94" data-line-end="95">Setelah proses seeding selesai (<code>php artisan migrate --seed</code>), kamu dapat login ke aplikasi menggunakan akun berikut:</p>
<table class="table table-striped table-bordered">
<thead>
<tr>
<th>Role</th>
<th>Username</th>
<th>Password</th>
<th>Nama Outlet</th>
</tr>
</thead>
<tbody>
<tr>
<td>Super Admin</td>
<td>superadmin</td>
<td>superadmin</td>
<td>Laundry Jaya Pusat</td>
</tr>
<tr>
<td>Super Owner</td>
<td>owner</td>
<td>owner</td>
<td>Laundry Jaya Pusat</td>
</tr>
<tr>
<td>Admin</td>
<td>admin</td>
<td>admin</td>
<td>Kilat Laundry Service</td>
</tr>
<tr>
<td>Kasir</td>
<td>kasir</td>
<td>kasir</td>
<td>Kilat Laundry Service</td>
</tr>
<tr>
<td>Owner</td>
<td>owner</td>
<td>owner</td>
<td>Kilat Laundry Service</td>
</tr>
<tr>
<td>Admin</td>
<td>admin2</td>
<td>admin2</td>
<td>AquaFresh Laundry</td>
</tr>
<tr>
<td>Kasir</td>
<td>kasir2</td>
<td>kasir2</td>
<td>AquaFresh Laundry</td>
</tr>
<tr>
<td>Owner</td>
<td>owner2</td>
<td>owner2</td>
<td>AquaFresh Laundry</td>
</tr>
</tbody>
</table>
<p class="has-line-data" data-line-start="107" data-line-end="108">⚠️ <strong>Penting:</strong> Pastikan untuk segera mengganti password akun-akun default ini demi keamanan, terutama jika aplikasi diunggah ke server publik.</p>
<hr>
<h2 class="code-line" data-line-start=111 data-line-end=112 ><a id="Lisensi_111"></a>Lisensi</h2>
<p class="has-line-data" data-line-start="113" data-line-end="114">The Laravel framework is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT">MIT license</a>.</p>
<h2 class="code-line" data-line-start=115 data-line-end=116 ><a id="Kredit_115"></a>Kredit</h2>
<p class="has-line-data" data-line-start="116" data-line-end="117">Proyek ini dikembangkan oleh:</p>
<ul>
<li class="has-line-data" data-line-start="118" data-line-end="119">👤 Fadhil Rafi Fauzan</li>
<li class="has-line-data" data-line-start="119" data-line-end="120">📧 Email: [fadhilrafifauzan.17@gmail.com]</li>
<li class="has-line-data" data-line-start="120" data-line-end="122">🐙 GitHub: <a href="http://github.com/fdhlrf.1">github.com/fdhlrf.1</a></li>
</ul>
<p class="has-line-data" data-line-start="122" data-line-end="124">© 2024 Laundry Multi User — Hak Cipta Dilindungi Undang-Undang.<br>
Terima kasih telah menggunakan aplikasi ini! ⭐</p>
