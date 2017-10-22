<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Borang Soal Selidik KKM/P&P/2013(B)</h3>
    </div>

 </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>BAHAGIAN A : MAKLUMAT PEGAWAI YANG DINILAI</h2>
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
          <h2>BAHAGIAN A : KATEGORI KURSUS</h2>
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
                <option selected="selected" value="G">Generic</option>
                <option value="F">Functional</option>
              </select>
            </div>
            <div class="clearfix"></div>
            <br/>
                  <div class="x_title">

          <h2>BAHAGIAN B : REAKSI</h2>
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
                          <th class="col-md-4">1</th>
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
                        <td width="1%"></td>
                        <td width="90%"></td>
                        <td width="2%">1</td>
                        <td width="2%">2</td>
                        <td width="2%">3</td>
                        <td width="2%">4</td>
                    </tr>
                    <tr>
                        <td width="1%">1.</td>
                        <td width="90%">Tahap kemahiran menjalani tugas harian</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b1" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b1">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b1">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b1">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">2.</td>
                        <td width="90%">Komitmen terhadap tugas</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b2" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b2">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b2">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b2">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">3.</td>
                        <td width="90%">Memberi keutamaan kerjasama kepada kerja bepasukan</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b3" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b3">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b3">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b3">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">4.</td>
                        <td width="90%">Kepekaan terhadap persekitaran kerja</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b4" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b4">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b4">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b4">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">5.</td>
                        <td width="90%">Keupayaan mengaplikasikan kemahiran dalam tugas harian</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b5" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b5">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b5">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b5">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">6.</td>
                        <td width="90%">Keyakinan menyumbangkan pendapat/idea kepada organisasi</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="b6" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="b6">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="b6">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="b6">
                            </label>
                          </div> </td>
                    </tr>
                </table>
                <div class="clearfix"></div>
                <br/>
                <div class="x_title">
                  <h2>BAHAGIAN C : HASIL/OUTCOME KURSUS</h2>
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
                <table>
                    <tr>
                        <td width="1%"></td>
                        <td width="90%"></td>
                        <td width="2%">1</td>
                        <td width="2%">2</td>
                        <td width="2%">3</td>
                        <td width="2%">4</td>
                    </tr>
                    <tr>
                        <td width="1%">1.</td>
                        <td width="90%">Perkongsian ilmu telah dilaksanakan dalam organisasi</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c1" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c1">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c1">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c1">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">2.</td>
                        <td width="90%">Meningkatkan kecekapan kerja harian</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c2" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c2">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c2">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c2">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">3.</td>
                        <td width="90%">
                        Meningkatkan etika kerja</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c3" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c3">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c3">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c3">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">4.</td>
                        <td width="90%">Melakukan tugasan dengan lebih rapi dan terancang</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c4" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c4">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c4">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c4">
                            </label>
                          </div> </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td width="1%"></td>
                        <td width="90%"></td>
                        <td width="2%">&nbsp;</td>
                        <td width="2%">&nbsp;</td>
                        <td width="2%">&nbsp;</td>
                        <td width="2%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="1%">5.</td>
                        <td width="90%">Pegawai menyumbangkan kepada produktiviti organisasi</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c5" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c5">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c5">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c5">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">6.</td>
                        <td width="90%">Latihan sejajar dengan pembangunan kerjaya pegawai</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c6"required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c6">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c6">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c6">
                            </label>
                          </div> </td>
                    </tr>
                    <tr>
                        <td width="1%">7.</td>
                        <td width="90%">
                        Latihan yang dihadiri menguntungkan organisasi</td>
                        <td><div class="radio">
                            <label>
                              <input type="radio" value="1" name="c7" required>
                            </label>
                          </div></td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="2" name="c7">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="3" name="c7">
                            </label>
                          </div> </td>
                        <td width="2%"><div class="radio">
                            <label>
                              <input type="radio" value="4" name="c7">
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
            </p>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ulasan/cadangan jika ada
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="txtCadangan" required="required" class="form-control col-md-7 col-xs-12"></textarea>
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
