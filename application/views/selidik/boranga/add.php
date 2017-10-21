<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Borang Soal Selidik KKM/P&P/2013(A)</h3>
    </div>

 </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Bahagian A : Maklumat Diri</h2>
          <ul class="nav navbar-right panel_toolbox" style="min-width: 0px">
            <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $profil->nama ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Kad Pengenalan
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $profil->nokp ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jawatan
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $objSkim->hrmis_skim->get_by('kod',$profil->skim_id)->keterangan ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gred
                </label>
                <?php
                $str = $profil->gred_id;
                preg_match_all('!\d+!', $str, $matches);
                print_r($matches);
                ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $profil->gred_id ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jabatan / Bahagian
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $objCarta->hrmis_carta->get_by('buid',$profil->jabatan_id)->title ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-Mail
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $profil->email ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Kursus / Bengkel yang dihadiri
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $kursus->tajuk ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Penganjur
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= ($kursus->anjuran == 'D') ? $objCarta->hrmis_carta->get_by('buid',$kursus->penganjur_id)->title : $kursus->penganjur ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tempoh Kursus Dari
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $kursus->tkh_mula ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tempoh Kursus Hingga
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $kursus->tkh_tamat ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tempat Kursus
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?= $kursus->tempat ?>" disabled>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
      <div class="x_title">
          <h2>Bahagian A : Kategori Kursus</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form id="frmBorangA" method="post" data-parsley-validate class="form-horizontal form-label-left">
          <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Kursus</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="comKategoriKursus">
                <option selected="selected">Generic</option>
                <option>Functional</option>
              </select>
            </div>
            <div class="clearfix"></div>
            <br/>
                  <div class="x_title">

          <h2>Bahagian B : Reaksi</h2>
          <ul class="nav navbar-right panel_toolbox" style="min-width: 0px">
          </ul>
          <div class="clearfix"></div>
        </div>

                        <p>
                Sila nyatakan sejauh mana anda setuju dengan setiap pertanyaan dengan membulatkan SATU NOMBOR daripada skala 1 hingga 4 seperti di bawah :-
            </p>
            <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="col-md-4" >1</th>
                          <th class="col-md-4">2</th>
                          <th class="col-md-4">3</th>
                          <th class="col-md-4">4</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Tidak Memuaskan</td>
                          <td>Memuaskan</td>
                          <td>Baik</td>
                          <td>Cemerlang</td>
                        </tr>
                      </tbody>
                    </table>

                <table>
                    <tr>
                        <td width="1%">1.</td>
                        <td width="90%">Pencapaian Objectif Kursus</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b1" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b1"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b1"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b1"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">2.</td>
                        <td width="90%">Kesesuaian tempoh masa</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b2" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b2"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b2"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b2"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">3.</td>
                        <td width="90%">Bilik kuliah / Dewan</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b3" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b3"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b3"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b3"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">4.</td>
                        <td width="90%">Nota/Handout</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b4" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b4"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b4"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b4"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">5.</td>
                        <td width="90%">Teknik penyampaian penceramah</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b5" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b5"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b5"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b5"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">6.</td>
                        <td width="90%">Kaedah kursus</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b6" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b6"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b6"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b6"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">7.</td>
                        <td width="90%">Pencapaian Objectif Kursus</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b7" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b7"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b7"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b7"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">8.</td>
                        <td width="90%">Kesesuaian tempoh masa</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b8" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b8"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b8"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b8"> 4
                            </label>
                          </div> </td>
                    </tr>
                </table>
                <div class="clearfix"></div>
                <br/>
                <div class="x_title">
                  <h2>Bahagian C : Pembelajaran</h2>
                  <ul class="nav navbar-right panel_toolbox" style="min-width: 0px">
                  </ul>
                  <div class="clearfix"></div>
                </div>
            <p>
                Sila nyatakan sejauh mana anda setuju dengan kenyataan dan bulatkan SATU NOMBOR daripada skala 1 hingga 4 seperti di bawah :-
            </p>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="col-md-3" >1</th>
                  <th class="col-md-3">2</th>
                  <th class="col-md-3">3</th>
                  <th class="col-md-3">4</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Sangat tidak setuju</td>
                  <td>Tidak setuju</td>
                  <td>Setuju</td>
                  <td>Sangat setuju</td>
                </tr>
              </tbody>
            </table>

                <h2>Pengetahuan</h2>
                <table>
                    <tr>
                        <td width="1%">9.</td>
                        <td width="90%">Kursus ini memberi pengetahuan baru</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c1" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c1"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c1"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c1"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">10.</td>
                        <td width="90%">Kursus ini meningkatkan pengetahuan berkaitan dengan tugas</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c2" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c2"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c2"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c2"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">11.</td>
                        <td width="90%">
                        Kursus ini memberi faedah dan membantu dalam melaksanakan tugas</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c3" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c3"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c3"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c3"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">12.</td>
                        <td width="90%">Pengetahuan di dalam kursus ini meningkatkan kualiti kerja</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c4" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c4"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c4"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c4"> 4
                            </label>
                          </div> </td>
                    </tr>
                </table>
                <h2>Kemahiran</h2>
                <table>
                    <tr>
                        <td width="1%">13.</td>
                        <td width="90%">Kursus ini memberi kemahiran yang relevan dengan tugas</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c5" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c5"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c5"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c5"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">14.</td>
                        <td width="90%">Kemahiran yang diperolehi dapat meningkatkan keupayaan diri dalam melaksanakan tugas</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c6"required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c6"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c6"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c6"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">15.</td>
                        <td width="90%">
                        Kemahiran yang diperolehi di dalam kursus ini boleh meningkatkan kualiti tugas</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c7" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c7"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c7"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c7"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">16.</td>
                        <td width="90%">Kemahiran yang diperolehi di dalam kursus ini boleh menyumbangkan kepada pencapaian organisasi</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c8" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c8"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c8"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c8"> 4
                            </label>
                          </div> </td>
                    </tr>
                </table>
                <h2>Sikap</h2>
                <table>
                    <tr>
                        <td width="1%">17.</td>
                        <td width="90%">Pembelajaran di dalam kursus membuka minda positif</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c9" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c9"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c9"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c9"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">18.</td>
                        <td width="90%">Kursus ini membantu diri menjadi lebih peka dan produktif</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c10" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c10"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c10"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c10"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">19.</td>
                        <td width="90%">
                        Kursus ini mendorong untuk bekerja dengan lebih cekap</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c11" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c11"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c11"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c11"> 4
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">20.</td>
                        <td width="90%">Kursus ini meningkatkan komitmen kepada organisasi</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c12" required> 1
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c12"> 2
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c12"> 3
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c12"> 4
                            </label>
                          </div> </td>
                    </tr>
                </table>
          <br/>
        <div class="x_title">
          <h2>Bahagian D : Ulasan</h2>
          <div class="clearfix"></div>
        </div>
        <p>
                Sila beri ulasan terhadap kursus yang dihadiri
            </p>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kekuatan
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="txtKekuatan" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kelemahan
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="txtKelemahan" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cadangan sekiranya ada
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="txtCadangan" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
              <div class="col-md-12 col-sm-6 col-xs-12">
                <button type="submit" name="submit" class="btn btn-success">Hantar</a>
              </div>
            </div>

          </form>
        </div>
      </div>
  </div>
  </div>

  <br/>
  <br/>
  <br/>
</div>
