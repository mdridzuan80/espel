<style type="text/css">
table
{
    width:  100%;
}
td
{
    /*text-align: center;*/
}

table.biasa, table.listing {
    border-collapse: collapse;
    border-color: #000;
    border-width: 1px;
    color: #000;
}
table.biasa th, table.listing th {
    background: #333;
    border-color: #262628;
    border-style: solid;
    border-width: 1px;
    color: #FDFDFF;
    font-weight: bold;
    padding: 3px 8px;
    text-transform: uppercase;
}
table.biasa tr, table.listing tr {
    background-color: #FFFFFF;
}
table.biasa tr.even, table.listing tr.even {
    background-color: #F5F5F7;
}
table.biasa td, table.listing td {
    border-color: #000;
    border-style: solid;
    border-width: 1px;
    padding: 3px 8px;
}
</style>

<page>
    <page_footer style="font-size: 9px">
       <table style="width: 100%;">
             <tr>
                     <td style="text-align: left;    width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Pengurusan Latihan (eSPeL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;">LAPORAN PRESTASI PERBELANJAAN <?= $tahun ?></td>
        </tr>
        <tr>
            <td style="width: 100%; text-align:center;">JENIS PERUNTUKAN</td>
        </tr>
        <tr>
            <td style="width: 100%; text-align:center;"></td>
        </tr>
    </table>
    <br/>
    <table class="biasa">
      <thead>
        <tr>
          <th style="width:10%;" rowspan="3">Bahagian / Jabatan</th>
          <th style="width:90%;" colspan="10">Prestasi</th>
        </tr>
        <tr>
            <th style="width:9%;" rowspan="2">Jumlah Peruntukan</th>
            <th style="width:9%;" rowspan="2">Bil. Kursus Dirancang</th>
            <th style="width:9%;" rowspan="2">Bil. Kursus Dianjurkan</th>
            <th style="width:27%;" colspan="3">Bil. Pegawai Hadir Kursus</th>
            <th style="width:9%;" rowspan="2">Perbelanjaan (RM)</th>
            <th style="width:9%;" rowspan="2">Perbelanjaan (%)</th>
            <th style="width:9%;" rowspan="2">Tanggungan</th>
            <th style="width:9%;" rowspan="2">Baki Peruntukan</th>
        </tr>
        <tr>
            <th style="width:9%;">Sokongan</th>
            <th style="width:9%;">P & P</th>
            <th style="width:9%;">Jumlah Keseluruhan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        </tr>
       </tbody>
   </table>
</page>
