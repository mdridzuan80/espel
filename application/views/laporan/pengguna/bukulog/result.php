  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan Buku log <?= $tahun ?></h2>
          <button id="cmdWord" data-cmd="3" class="btn btn-default btn-sm pull-right" title="Cetak Word"><i class="fa fa-file-word-o"></i></button>
          <button id="cmdXls" data-cmd="2" class="btn btn-default btn-sm pull-right" title="Cetak Excel"><i class="fa fa-file-excel-o"></i></button>
          <button id="cmdPdf" data-cmd="1" class="btn btn-default btn-sm pull-right" title="Cetak PDF"><i class="fa fa-file-pdf-o"></i></button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped table-bordered jambo_table">
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
    <br/>
    <table class="table table-striped table-bordered jambo_table">
        <tr>
            <td style="width: 100%; text-align:center;"><h3>LATIHAN DALAM NEGARA</h3></td>
        </tr>
    </table>
    <br/>
    <table class="table table-striped table-bordered jambo_table">
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
        <td colspan="3"><?= ($latihan->anjuran == 'D') ? $latihan->anjuran_dalam : $latihan->anjuran_luar ?></td>
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
    <br/>
    <table class="table table-striped table-bordered jambo_table">
        <tr>
            <td style="width: 100%; text-align:center;"><h3>LATIHAN LUAR NEGARA</h3></td>
        </tr>
    </table>
    <br/>
    <table class="table table-striped table-bordered jambo_table">
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
        <td colspan="3"><?= ($latihan->anjuran == 'D') ? $latihan->anjuran_dalam : $latihan->anjuran_luar ?></td>
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
    <br/>
    <table class="table table-striped table-bordered jambo_table">
        <tr>
            <td style="width: 100%; text-align:center;"><h3>SESI PEMBELAJARAN (BERSEMUKA)</h3></td>
        </tr>
    </table>
    <br/>
    <table class="table table-striped table-bordered jambo_table">
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
        <td colspan="3"><?= ($latihan->anjuran == 'D') ? $latihan->anjuran_dalam : $latihan->anjuran_luar ?></td>
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
    <br/>
    <table class="table table-striped table-bordered jambo_table">
        <tr>
            <td style="width: 100%; text-align:center;"><h3>SESI PEMBELAJARAN (TIDAK BERSEMUKA)</h3></td>
        </tr>
    </table>
    <br/>
    <table class="table table-striped table-bordered jambo_table">
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
        <td colspan="3"><?= ($latihan->anjuran == 'D') ? $latihan->anjuran_dalam : $latihan->anjuran_luar ?></td>
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
    <br/>
    <table class="table table-striped table-bordered jambo_table">
        <tr>
            <td style="width: 100%; text-align:center;"><h3>PEMBELAJARAN KENDIRI</h3></td>
        </tr>
    </table>
    <br/>
    <table class="table table-striped table-bordered jambo_table">
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
        <td colspan="3"><?= ($latihan->anjuran == 'D') ? $latihan->anjuran_dalam : $latihan->anjuran_luar ?></td>
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
        </div>
      </div>
    </div>
  </div>
