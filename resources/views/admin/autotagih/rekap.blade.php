<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Nama Anggota</th>
            <th>Simpanan Pokok</th>
            <th>Simpanan Wajib</th>
            <th>Simpanan Sukarela</th>
            <th>Cicilan Barang</th>
            <th>Pinjaman Tunai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Rekap as $Simp)
            <tr>
                <td>
                    {{ $Simp->Anggota->nama_anggota }}
                </td>
                <td>
                    {{ number_format($Simp->simp_pokok) }}
                </td>
                <td>
                    {{ number_format($Simp->simp_wajib) }}
                </td>
                <td>
                    {{ number_format($Simp->simp_sukarela) }}
                </td>
                <td>
                    {{ number_format($Simp->cicilan_barang) }}
                </td>
                <td>
                    {{ number_format($Simp->pinjaman_tunai) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>