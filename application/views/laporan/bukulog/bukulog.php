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
                     <td style="text-align: left; width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
                     <td style="text-align: right;    width: 50%"></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Maklumat Kursus (eSPEL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;"><img src="<?=base_url("assets/images/malaysia-crest.png")?>" ></td>
        </tr>
        <tr>
            <td style="width: 100%; text-align:center;"><br></td>
        </tr>
        <tr>
            <td style="width: 100%; text-align:center;"><h1>KEMENTERIAN KESIHATAN MALAYSIA</h1></td>
        </tr>
        <tr>
            <td style="width: 100%; text-align:center;"><br></td>
        </tr>
        <tr>
            <td style="width: 100%; text-align:center;"><h2>BUKU LOG LATIHAN <?=date('Y')?></h2></td>
        </tr>
        <tr>
            <td style="width: 100%; text-align:center;"><br></td>
        </tr>
        <tr>
            <td style="width: 100%; align: center">
                <table align="center" style="width:80%" class="biasa" >
                    <tr>
                        <td style="width:30%;text-align: left;">NAMA</td>
                        <td style="width:50%;text-align: left;">: <?=$profil->nama?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;text-align: left;">NO. K/P</td>
                        <td style="width:50%;text-align: left;">: <?=$profil->nokp?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;text-align: left;">JAWATAN / GRED</td>
                        <td style="width:50%;text-align: left;">: <?=$profil->gred_id?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;text-align: left;">SKIM GRED</td>
                        <td style="width:50%;text-align: left;">: <?= $mskim->skim->get_by('kod',$profil->skim_id)->keterangan ?></td>
                    </tr>
                    <tr>
                        <td style="width:20%;text-align: left;">TEMPAT BERTUGAS</td>
                        <td style="width:50%;text-align: left;">: <?= $mjabatan->jabatan->get_by('buid',$profil->jabatan_id)->title ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</page>

<page>
    <page_footer style="font-size: 9px">
       <table style="width: 100%;">
             <tr>
                     <td style="text-align: left;    width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
                     <td style="text-align: right;    width: 50%"></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Maklumat Kursus (eSPEL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;"><h3>LATIHAN DALAM NEGARA</h3></td>
        </tr>
    </table>
    <br/>
    <table  class="biasa">
      <tr>
          <td style="width: 5%">Bil.</td>
          <td style="width: 20%">Maklumat Latihan</td>
          <td style="width: 50%" colspan="3">Keterangan</td>
          <td style="width: 25%">Tandatangan &amp; Cop Pengesahan</td>
      </tr>
      <?php if(count($sen_latihan_dalam_negara)):?>
      <?php $i=1; foreach($sen_latihan_dalam_negara as $latihan):?>
      <tr>
        <td style="width: 5%; vertical-align:top" rowspan="5"><?=$i++?></td>
        <td style="width: 20%" colspan="4">Tajuk : <?=$latihan->tajuk?></td>
        <td style="width: 25%"rowspan="5"></td>
      </tr>
      <tr>
        <td style="width: 20%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_mula))?></td>
        <td style="width: 10%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_tamat))?></td>
      </tr>
      <tr>
        <td style="width: 5%">Bilangan Hari:</td>
        <td colspan="3"><?=$latihan->hari?></td>
      </tr>
      <tr>
        <td style="width: 5%">Tempat:</td>
        <td colspan="3"><?=$latihan->tempat?></td>
      </tr>
      <tr>
        <td style="width: 5%">Anjuran:</td>
        <td colspan="3"><?=$latihan->jabatan?></td>
      </tr>
    <?php endforeach?>
<?php else:?>
    <tr>
      <td style="width: 5%; vertical-align:top" rowspan="5"></td>
      <td style="width: 20%" colspan="4">Tajuk : </td>
      <td style="width: 25%"rowspan="5"></td>
    </tr>
    <tr>
      <td style="width: 20%">Tarikh Mula:</td>
      <td style="width: 20%"></td>
      <td style="width: 10%">Tarikh Mula:</td>
      <td style="width: 20%"></td>
    </tr>
    <tr>
      <td style="width: 5%">Bilangan Hari:</td>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td style="width: 5%">Tempat:</td>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td style="width: 5%">Anjuran:</td>
      <td colspan="3"></td>
    </tr>
<?php endif?>

    </table>
</page>

<page>
    <page_footer style="font-size: 9px">
       <table style="width: 100%;">
             <tr>
                     <td style="text-align: left;    width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
                     <td style="text-align: right;    width: 50%"></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Maklumat Kursus (eSPEL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;"><h3>LATIHAN LUAR NEGARA</h3></td>
        </tr>
    </table>
    <br/>
    <table  class="biasa">
      <tr>
          <td style="width: 5%">Bil.</td>
          <td style="width: 20%">Maklumat Latihan</td>
          <td style="width: 50%" colspan="3">Keterangan</td>
          <td style="width: 25%">Tandatangan &amp; Cop Pengesahan</td>
      </tr>
      <?php if(count($sen_latihan_luar_negara)):?>
      <?php $i=1; foreach($sen_latihan_luar_negara as $latihan):?>
      <tr>
        <td style="width: 5%; vertical-align:top" rowspan="5"><?=$i++?></td>
        <td style="width: 20%" colspan="4">Tajuk : <?=$latihan->tajuk?></td>
        <td style="width: 25%"rowspan="5"></td>
      </tr>
      <tr>
        <td style="width: 20%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_mula))?></td>
        <td style="width: 10%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_tamat))?></td>
      </tr>
      <tr>
        <td style="width: 5%">Bilangan Hari:</td>
        <td colspan="3"><?=$latihan->hari?></td>
      </tr>
      <tr>
        <td style="width: 5%">Tempat:</td>
        <td colspan="3"><?=$latihan->tempat?></td>
      </tr>
      <tr>
        <td style="width: 5%">Anjuran:</td>
        <td colspan="3"><?=$latihan->jabatan?></td>
      </tr>
    <?php endforeach?>
    <?php else:?>
        <tr>
          <td style="width: 5%; vertical-align:top" rowspan="5"></td>
          <td style="width: 20%" colspan="4">Tajuk : </td>
          <td style="width: 25%"rowspan="5"></td>
        </tr>
        <tr>
          <td style="width: 20%">Tarikh Mula:</td>
          <td style="width: 20%"></td>
          <td style="width: 10%">Tarikh Mula:</td>
          <td style="width: 20%"></td>
        </tr>
        <tr>
          <td style="width: 5%">Bilangan Hari:</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="width: 5%">Tempat:</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="width: 5%">Anjuran:</td>
          <td colspan="3"></td>
        </tr>
    <?php endif?>
    </table>
</page>

<page>
    <page_footer style="font-size: 9px">
       <table style="width: 100%;">
             <tr>
                     <td style="text-align: left;    width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
                     <td style="text-align: right;    width: 50%"></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Maklumat Kursus (eSPEL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;"><h3>SESI PEMBELAJARAN (BERSEMUKA)</h3></td>
        </tr>
    </table>
    <br/>
    <table  class="biasa">
      <tr>
          <td style="width: 5%">Bil.</td>
          <td style="width: 20%">Maklumat Latihan</td>
          <td style="width: 50%" colspan="3">Keterangan</td>
          <td style="width: 25%">Tandatangan &amp; Cop Pengesahan</td>
      </tr>
      <?php if(count($sen_latihan_semuka)):?>
      <?php $i=1; foreach($sen_latihan_semuka as $latihan):?>
      <tr>
        <td style="width: 5%; vertical-align:top" rowspan="5"><?=$i++?></td>
        <td style="width: 20%" colspan="4">Tajuk : <?=$latihan->tajuk?></td>
        <td style="width: 25%"rowspan="5"></td>
      </tr>
      <tr>
        <td style="width: 20%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_mula))?></td>
        <td style="width: 10%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_tamat))?></td>
      </tr>
      <tr>
        <td style="width: 5%">Bilangan Hari:</td>
        <td colspan="3"><?=$latihan->hari?></td>
      </tr>
      <tr>
        <td style="width: 5%">Tempat:</td>
        <td colspan="3"><?=$latihan->tempat?></td>
      </tr>
      <tr>
        <td style="width: 5%">Anjuran:</td>
        <td colspan="3"><?=$latihan->jabatan?></td>
      </tr>
    <?php endforeach?>
    <?php else:?>
        <tr>
          <td style="width: 5%; vertical-align:top" rowspan="5"></td>
          <td style="width: 20%" colspan="4">Tajuk : </td>
          <td style="width: 25%"rowspan="5"></td>
        </tr>
        <tr>
          <td style="width: 20%">Tarikh Mula:</td>
          <td style="width: 20%"></td>
          <td style="width: 10%">Tarikh Mula:</td>
          <td style="width: 20%"></td>
        </tr>
        <tr>
          <td style="width: 5%">Bilangan Hari:</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="width: 5%">Tempat:</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="width: 5%">Anjuran:</td>
          <td colspan="3"></td>
        </tr>
    <?php endif?>
    </table>
</page>

<page>
    <page_footer style="font-size: 9px">
       <table style="width: 100%;">
             <tr>
                     <td style="text-align: left;    width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
                     <td style="text-align: right;    width: 50%"></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Maklumat Kursus (eSPEL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;"><h3>SESI PEMBELAJARAN (TIDAK BERSEMUKA)</h3></td>
        </tr>
    </table>
    <br/>
    <table  class="biasa">
      <tr>
          <td style="width: 5%">Bil.</td>
          <td style="width: 20%">Maklumat Latihan</td>
          <td style="width: 50%" colspan="3">Keterangan</td>
          <td style="width: 25%">Tandatangan &amp; Cop Pengesahan</td>
      </tr>
      <?php if(count($sen_latihan_tidak_semuka)):?>
      <?php $i=1; foreach($sen_latihan_tidak_semuka as $latihan):?>
      <tr>
        <td style="width: 5%; vertical-align:top" rowspan="5"><?=$i++?></td>
        <td style="width: 20%" colspan="4">Tajuk : <?=$latihan->tajuk?></td>
        <td style="width: 25%"rowspan="5"></td>
      </tr>
      <tr>
        <td style="width: 20%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_mula))?></td>
        <td style="width: 10%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_tamat))?></td>
      </tr>
      <tr>
        <td style="width: 5%">Bilangan Hari:</td>
        <td colspan="3"><?=$latihan->hari?></td>
      </tr>
      <tr>
        <td style="width: 5%">Tempat:</td>
        <td colspan="3"><?=$latihan->tempat?></td>
      </tr>
      <tr>
        <td style="width: 5%">Anjuran:</td>
        <td colspan="3"><?=$latihan->jabatan?></td>
      </tr>
    <?php endforeach?>
    <?php else:?>
        <tr>
          <td style="width: 5%; vertical-align:top" rowspan="5"></td>
          <td style="width: 20%" colspan="4">Tajuk : </td>
          <td style="width: 25%"rowspan="5"></td>
        </tr>
        <tr>
          <td style="width: 20%">Tarikh Mula:</td>
          <td style="width: 20%"></td>
          <td style="width: 10%">Tarikh Mula:</td>
          <td style="width: 20%"></td>
        </tr>
        <tr>
          <td style="width: 5%">Bilangan Hari:</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="width: 5%">Tempat:</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="width: 5%">Anjuran:</td>
          <td colspan="3"></td>
        </tr>
    <?php endif?>
    </table>
</page>

<page>
    <page_footer style="font-size: 9px">
       <table style="width: 100%;">
             <tr>
                     <td style="text-align: left;    width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
                     <td style="text-align: right;    width: 50%"></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Maklumat Kursus (eSPEL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;"><h3>PEMBELAJARAN KENDIRI</h3></td>
        </tr>
    </table>
    <br/>
    <table  class="biasa">
      <tr>
          <td style="width: 5%">Bil.</td>
          <td style="width: 20%">Maklumat Latihan</td>
          <td style="width: 50%" colspan="3">Keterangan</td>
          <td style="width: 25%">Tandatangan &amp; Cop Pengesahan</td>
      </tr>
      <?php if(count($sen_latihan_kendiri)):?>
      <?php $i=1; foreach($sen_latihan_kendiri as $latihan):?>
      <tr>
        <td style="width: 5%; vertical-align:top" rowspan="5"><?=$i++?></td>
        <td style="width: 20%" colspan="4">Tajuk : <?=$latihan->tajuk?></td>
        <td style="width: 25%"rowspan="5"></td>
      </tr>
      <tr>
        <td style="width: 20%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_mula))?></td>
        <td style="width: 10%">Tarikh Mula:</td>
        <td style="width: 20%"><?=date("d M Y h:i A",strtotime($latihan->tkh_tamat))?></td>
      </tr>
      <tr>
        <td style="width: 5%">Bilangan Hari:</td>
        <td colspan="3"><?=$latihan->hari?></td>
      </tr>
      <tr>
        <td style="width: 5%">Tempat:</td>
        <td colspan="3"><?=$latihan->tempat?></td>
      </tr>
      <tr>
        <td style="width: 5%">Anjuran:</td>
        <td colspan="3"><?=$latihan->jabatan?></td>
      </tr>
    <?php endforeach?>
    <?php else:?>
        <tr>
          <td style="width: 5%; vertical-align:top" rowspan="5"></td>
          <td style="width: 20%" colspan="4">Tajuk : </td>
          <td style="width: 25%"rowspan="5"></td>
        </tr>
        <tr>
          <td style="width: 20%">Tarikh Mula:</td>
          <td style="width: 20%"></td>
          <td style="width: 10%">Tarikh Mula:</td>
          <td style="width: 20%"></td>
        </tr>
        <tr>
          <td style="width: 5%">Bilangan Hari:</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="width: 5%">Tempat:</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="width: 5%">Anjuran:</td>
          <td colspan="3"></td>
        </tr>
    <?php endif?>
    </table>
</page>

<page>
    <page_footer style="font-size: 9px">
       <table style="width: 100%;">
             <tr>
                     <td style="text-align: left;    width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
                     <td style="text-align: right;    width: 50%"></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Maklumat Kursus (eSPEL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;"><h3>REKOD PENGESAHAN<br/>KEHADIRAN PROGRAM LATIHAN</h3></td>
        </tr>
    </table>
    <br/>
    <table class="biasa">
      <thead>
        <tr>
          <th style="width:5%;">Bil</th>
          <th style="width:75%;">Program latihan</th>
          <th style="width:20%;">Bilangan hari</th>
        </tr>
      </thead>
      <tbody>
          <?php $total = 0;?>
          <?php $x=1; foreach($program as $key => $prog):?>
              <?php $total += $prog["hari"]?>
        <tr>
            <td><?=$x++?></td>
            <td><?=$prog["nama"]?></td>
            <?php if($key != 'cpd'):?>
            <td><?=round($prog["hari"],2)?></td>
            <?php else:?>
            <td><?= "<b>MATA:</b> " . $prog["hari"] . ", <b>HARI:</b> " . round(($prog["hari"]/40)*7,2)?></td>
            <?php endif?>
        </tr>
        <?php endforeach?>
        <tr>
            <td colspan="2">Jumlah Keseluruhan</td>
            <td><?=$total?></td>
        </tr>
       </tbody>
   </table>
</page>
