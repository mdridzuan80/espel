<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel tile">
        <div class="x_title">
            <h2>Status Integrasi HRMIS</h2>
            <button class="btn btn-info pull-right">Mula Migrasi Data</button>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Tarikh</th>
                    <th>Mesej</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($hrmis as $row) { ?>
                <tr>
                    <th scope="row"> <?= $row->date ?></th>
                    <td><?= $row->event ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
  </div>
</div>
