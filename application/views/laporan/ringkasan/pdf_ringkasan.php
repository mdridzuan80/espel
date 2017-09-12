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
