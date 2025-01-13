document.getElementById('toggle-data').addEventListener('click', function (event) {
    event.preventDefault();
    const FADHIL_subLinks = document.getElementById('sub-links-data');
    const FADHIL_icon = document.getElementById('icon-data');

    FADHIL_subLinks.classList.toggle('hidden');
    FADHIL_icon.classList.toggle('rotate-90'); // Menambahkan rotasi 90 derajat
});

document.addEventListener('DOMContentLoaded', function () {
    // Pilih elemen input dan elemen pajak
    const namaPelangganInput = document.getElementById('nama_pelanggan');
    const FADHIL_pajakSpan = document.getElementById('pajakSpan');
    const FADHIL_diskonSpan = document.getElementById('diskonSpan');

    // Tambahkan event listener untuk mendeteksi perubahan pada input
    namaPelangganInput.addEventListener('input', function () {
        document.getElementById('radio-member').disabled = true;
        document.getElementById('radio-non-member').disabled = true;
        if (this.value.trim() !== "") {
            // Jika ada input, set nilai pajak
            FADHIL_pajakSpan.textContent = "8%";
            FADHIL_diskonSpan.textContent = "0%";
        } else {
            // Jika input kosong, kosongkan nilai pajak
            FADHIL_pajakSpan.textContent = "-";
        }
    });
})

document.addEventListener('DOMContentLoaded', function () {
    const FADHIL_kuantitasInput = document.getElementById('kuantitas');
    const FADHIL_kuantitasSpan = document.getElementById('kuantitasSpan');
    const FADHIL_jenisFormInput = document.getElementById('jenis');

    FADHIL_kuantitasInput.addEventListener('input', function () {
        const FADHIL_jenis = FADHIL_jenisFormInput.value;
        console.log(FADHIL_jenis);
        let FADHIL_satuan = "";
        if (FADHIL_jenis === "kiloan") {
            FADHIL_satuan = "Kg";
        } else {
            FADHIL_satuan = "Item";
        }
        console.log(FADHIL_satuan);

        // console.log(FADHIL_satuan);
        if (this.value.trim() !== "") {
            FADHIL_kuantitasSpan.textContent = `${this.value} ${FADHIL_satuan}`;
        } else {
            FADHIL_kuantitasSpan.textContent = "-";
        }

        console.log('Span After:', FADHIL_kuantitasSpan.textContent);
    });
});

// document.addEventListener('DOMContentLoaded', function () {
//     const FADHIL_biayatambahanInput = document.getElementById('biaya_tambahan');
//     const FADHIL_biayatambahanSpan = document.getElementById('biaya_tambahanSpan');

//     FADHIL_biayatambahanInput.addEventListener('input', function () {
//         if (this.value.trim() !== "") {
//             FADHIL_kuantitasSpan.textContent = `${this.value} ${FADHIL_satuan}`;
//         } else {
//             FADHIL_kuantitasSpan.textContent = "-";
//         }

//         console.log('Span After:', FADHIL_kuantitasSpan.textContent);
//     });
// });



document.addEventListener('DOMContentLoaded', function () {
    const FADHIL_selectButtonsMember = document.querySelectorAll('.select-member');

    FADHIL_selectButtonsMember.forEach(function (FADHIL_button) {
        FADHIL_button.addEventListener('click', function () {
            const FADHIL_id = FADHIL_button.getAttribute('data-id');
            const FADHIL_nama = FADHIL_button.getAttribute('data-nama');
            const FADHIL_alamat = FADHIL_button.getAttribute('data-alamat');
            const FADHIL_jenisKelamin = FADHIL_button.getAttribute('data-jenis_kelamin');
            const FADHIL_tlp = FADHIL_button.getAttribute('data-tlp');
            const FADHIL_diskon = FADHIL_button.getAttribute('data-diskon');
            const FADHIL_pajak = FADHIL_button.getAttribute('data-pajak');

            const FADHIL_idInput = document.getElementById('id_member');
            const FADHIL_namaSpan = document.getElementById('nama');
            const FADHIL_alamatSpan = document.getElementById('alamat');
            const FADHIL_jenisKelaminSpan = document.getElementById('jenis_kelamin');
            const FADHIL_tlpSpan = document.getElementById('tlp');
            const FADHIL_diskonSpan = document.getElementById('diskonSpan');
            const FADHIL_pajakSpan = document.getElementById('pajakSpan');

            document.getElementById('radio-member').disabled = true;
            document.getElementById('radio-non-member').disabled = true;

            if (FADHIL_idInput) FADHIL_idInput.value = FADHIL_id;
            if (FADHIL_namaSpan) FADHIL_namaSpan.innerText = FADHIL_nama;
            if (FADHIL_alamatSpan) FADHIL_alamatSpan.innerText = FADHIL_alamat;
            if (FADHIL_jenisKelaminSpan) {
                FADHIL_jenisKelaminSpan.innerText =
                    FADHIL_jenisKelamin === 'L' ? 'Laki-Laki' :
                        FADHIL_jenisKelamin === 'P' ? 'Perempuan' : '-';
            }
            if (FADHIL_tlpSpan) FADHIL_tlpSpan.innerText = FADHIL_tlp;
            if (FADHIL_diskonSpan) FADHIL_diskonSpan.innerText = FADHIL_diskon;
            if (FADHIL_pajakSpan) FADHIL_pajakSpan.innerText = FADHIL_pajak;
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const FADHIL_selectButtonsPaket = document.querySelectorAll('.select-paket');

    FADHIL_selectButtonsPaket.forEach(function (FADHIL_button) {
        FADHIL_button.addEventListener('click', function () {
            const FADHIL_id_paket = FADHIL_button.getAttribute('data-id_paket');
            const FADHIL_jenis = FADHIL_button.getAttribute('data-jenis');
            const FADHIL_namaPaket = FADHIL_button.getAttribute('data-nama_paket');
            const FADHIL_harga = FADHIL_button.getAttribute('data-harga');
            const FADHIL_lamaProses = FADHIL_button.getAttribute('data-lama_proses');

            const FADHIL_idPaketForm = document.getElementById('id_paket');
            const FADHIL_jenisForm = document.getElementById('jenis');
            const FADHIL_namaPaketSpan = document.getElementById('nama_paketSpan');
            const FADHIL_namaPaketForm = document.getElementById('nama_paket');
            const FADHIL_hargaSpan = document.getElementById('hargaSpan');
            const FADHIL_hargaForm = document.getElementById('harga');

            const FADHIL_batasWaktuSpan = document.getElementById('batas_waktuSpan');
            const FADHIL_batasWaktuForm = document.getElementById('batas_waktu');

            // FADHIL_diskon =
            if (FADHIL_idPaketForm) FADHIL_idPaketForm.value = FADHIL_id_paket;
            if (FADHIL_jenisForm) FADHIL_jenisForm.value = FADHIL_jenis;
            if (FADHIL_namaPaketSpan) FADHIL_namaPaketSpan.innerText = FADHIL_namaPaket;
            if (FADHIL_namaPaketForm) FADHIL_namaPaketForm.value = FADHIL_namaPaket;
            if (FADHIL_hargaSpan) FADHIL_hargaSpan.innerText = FADHIL_harga;
            if (FADHIL_hargaForm) FADHIL_hargaForm.value = FADHIL_harga;

            if (FADHIL_lamaProses) {
                const FADHIL_today = new Date();
                FADHIL_today.setDate(FADHIL_today.getDate() + parseInt(FADHIL_lamaProses));
                const FADHIL_formattedDateTime = `${FADHIL_today.getFullYear()}-${String(FADHIL_today.getMonth() + 1).padStart(2, '0')}-${String(FADHIL_today.getDate()).padStart(2, '0')} ${String(FADHIL_today.getHours()).padStart(2, '0')}:${String(FADHIL_today.getMinutes()).padStart(2, '0')}:${String(FADHIL_today.getSeconds()).padStart(2, '0')}`;
                // const FADHIL_formattedDateTime = FADHIL_today.toISOString().slice(0, 19).replace('T', ' ');

                // const FADHIL_formattedDateTime = new Intl.DateTimeFormat('sv-SE', {
                //     year: 'numeric',
                //     month: '2-digit',
                //     day: '2-digit',
                //     hour: '2-digit',
                //     minute: '2-digit',
                //     second: '2-digit',
                //     hour12: false,
                // }).format(FADHIL_today).replace(' ', 'T');

                // const FADHIL_formattedDate = FADHIL_today.toISOString().split('T')[0];
                if (FADHIL_batasWaktuSpan) FADHIL_batasWaktuSpan.innerText = FADHIL_formattedDateTime;
                if (FADHIL_batasWaktuForm) FADHIL_batasWaktuForm.value = FADHIL_formattedDateTime;
            } else {
                if (FADHIL_batasWaktuSpan) FADHIL_batasWaktuSpan.innerText = "-";
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {

    function hitungTotalDiskonPajak() {

        const FADHIL_harga = parseFloat(document.getElementById('harga').value) || 0;
        const FADHIL_kuantitas = parseInt(document.getElementById('kuantitas').value) || 0;
        const FADHIL_biaya_tambahan = parseFloat(document.getElementById('biaya_tambahan').value) || 0;

        // Perhitungan total awal
        const FADHIL_total = FADHIL_harga * FADHIL_kuantitas;

        const FADHIL_cekMember = document.getElementById('radio-member').checked;
        console.log(FADHIL_cekMember);

        var FADHIL_diskon = 0;

        if (FADHIL_cekMember) {
            FADHIL_diskon = FADHIL_total * 0.05;
        } else {
            0;
        }

        const FADHIL_pajak = FADHIL_total * 0.08;

        // Total Akhir
        const FADHIL_total_akhir = FADHIL_total - FADHIL_diskon + FADHIL_pajak + FADHIL_biaya_tambahan;

        document.getElementById('hargaSpan').innerText = `Rp ${FADHIL_harga.toLocaleString()}`;
        // document.getElementById('kuantitasSpan').innerText = FADHIL_kuantitas;
        document.getElementById('diskon').value = FADHIL_diskon;
        document.getElementById('pajak').value = FADHIL_pajak;
        document.getElementById('total').value = FADHIL_total_akhir;
        document.getElementById('totalSpan').innerText = `Rp ${FADHIL_total_akhir.toLocaleString()} `;
        document.getElementById('biaya_tambahanSpan').innerText = `Rp ${FADHIL_biaya_tambahan.toLocaleString()}`;
    }

    // Tambahkan event listener untuk kuantitas
    document.getElementById('kuantitas').addEventListener('input', hitungTotalDiskonPajak);
    document.getElementById('biaya_tambahan').addEventListener('input', hitungTotalDiskonPajak);
});


// document.addEventListener('DOMContentLoaded', function () {
//     function hitungKembalian(FADHIL_id_transaksi) {
//         // Ambil elemen terkait
//         const FADHIL_totalText = document.getElementById(`total${FADHIL_id_transaksi} `);
//         const FADHIL_bayarInput = document.getElementById(`bayar${FADHIL_id_transaksi} `);
//         const FADHIL_kembalianInput = document.getElementById(`kembalian${FADHIL_id_transaksi} `);

//         // Ambil nilai total dari elemen teks
//         const FADHIL_total = parseInt(FADHIL_totalText.textContent.replace(/[^\d]/g, '')) || 0;

//         // Ambil nilai bayar dari input, hapus format
//         const FADHIL_bayar = parseInt(FADHIL_bayarInput.value.replace(/[^\d]/g, '')) || 0;

//         // Hitung kembalian
//         const FADHIL_kembalian = FADHIL_bayar - FADHIL_total;
//         const FADHIL_kembalianText = FADHIL_kembalian > 0 ? `Rp.${FADHIL_kembalian.toLocaleString('id-ID')} ` : 'Rp. 0';

//         // Tampilkan kembalian
//         FADHIL_kembalianInput.value = FADHIL_kembalianText;

//         // Debugging log
//         console.log('Total:', FADHIL_total);
//         console.log('Bayar:', FADHIL_bayar);
//         console.log('Kembalian:', FADHIL_kembalianText);
//     }
// });
