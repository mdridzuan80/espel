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

<page style="font-size: 7px">
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
            <td style="width:1%;"><img src="<?= base_url('assets/images/coa-malaysia-govt.png') ?>" ></td>
            <td style="width: 75%;">
                <table>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="width: 100%; text-align:center; font-size: 12px">LAPORAN PRESTASI PERBELANJAAN <?= $tahun ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100%; text-align:center; font-size: 12px">JENIS PERUNTUKAN</td>
                                </tr>
                            </table>               
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width:1%;"><img src="<?= base_url('assets/images/kkm_logo_110h.png') ?>" ></td>
        </tr>
    </table>    
    <br/>
    <table class="biasa">
      <thead>
        <tr>
            <th style="width:1%;" rowspan="3">Bahagian /<br> Jabatan</th>
            <th style="width:1%;" rowspan="3">Jenis<br>Peruntukan</th>
            <th style="width:70%;" colspan="10">Prestasi</th>
        </tr>
        <tr>
            <th style="width:7%;" rowspan="2">Jumlah<br>Peruntukan</th>
            <th style="width:7%;" rowspan="2">Bil. Kursus<br>Dirancang</th>
            <th style="width:7%;" rowspan="2">Bil. Kursus<br>Dianjurkan</th>
            <th style="width:21%;" colspan="3">Bil. Pegawai<br>Hadir Kursus</th>
            <th style="width:7%;" rowspan="2">Perbelanjaan (RM)</th>
            <th style="width:7%;" rowspan="2">Perbelanjaan (%)</th>
            <th style="width:7%;" rowspan="2">Tanggungan</th>
            <th style="width:7%;" rowspan="2">Baki<br>Peruntukan</th>
        </tr>
        <tr>
            <th style="width:7%;">Sokongan</th>
            <th style="width:4%;">P & P</th>
            <th style="width:7%;">Jumlah<br>Keseluruhan</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($peruntukan_semasa as $semasa) : ?>
        <tr>
        <td style="width:1%;"><?= $semasa->title ?></td>
        <td style="width:1%;"><?= $semasa->nama ?></td>
        <td style="width:7%;">RM <?= $semasa->jumlah ?></td>
        <td style="width:7%;"><?= $objKursus->kursus->rancang(implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y'),$semasa->jns_peruntukan_id)->num_rows() ?></td>
        <td style="width:7%;"><?= $objKursus->kursus->laksana(implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y'),$semasa->jns_peruntukan_id)->num_rows() ?></td>
        <?php $sok = $objKursus->kursus->sen_peruntukan_kelas_profil(implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y'),$semasa->jns_peruntukan_id, 'SOK')->num_rows() ?>
        <td style="width:7%;"><?= $sok ?></td>
        <?php $pp = $objKursus->kursus->sen_peruntukan_kelas_profil(implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y'),$semasa->jns_peruntukan_id, 'PP')->num_rows() ?>
        <td style="width:4%;"><?= $pp ?></td>
        <td style="width:7%;"><?= $sok + $pp ?></td>
        <?php $belanja = $objPeruntukan->peruntukan->belanja($semasa->jns_peruntukan_id, implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y')) ?>
        <td style="width:7%;">RM <?= $belanja ?></td>
        <td style="width:7%;"><?= ($belanja/$semasa->jumlah)*100 ?></td>
        <?php $tanggungan = $objPeruntukan->peruntukan->tanggungan($semasa->jns_peruntukan_id, implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y')) ?>
        <td style="width:7%;">RM <?= $tanggungan ?></td>
        <td style="width:7%;">RM <?= $semasa->jumlah - $belanja ?></td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</page>
