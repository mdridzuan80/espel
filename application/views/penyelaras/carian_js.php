<script>
(function(){
    var options = {
        page: 0,
        filter: {
            nama: '',
            nokp: '',
            jabatan_id: <?= $jab_ptj->jabatan_id?>,
            sub_jabatan: 1,
            kump_id: 0,
            skim_id: 0,
            gred_id: 0,
            status: 'Y'
        },
        url: base_url+'pengguna/penyelaras_data_grid/0'
   };

    $('#frmFilter').hide();

    $('#cmdFilter').click(function(e){
        e.preventDefault();
        $('#frmFilter').toggle('fast');
    });

    $("#comKelas").change(function(){
        $.ajax({
            url:"<?=base_url("api/get_laporan_skim/")?>" + $(this).val(),
            success: function(gred,textStatus,jqXHR)
            {
                $('#comSkim').html('<option value="0">Pilih Semua</option>');
                for(var i=0;i<gred.length;i++)
                {
                    var option=$('<option></option>').attr("value",gred[i]['id']).text(gred[i]['kod']);
                    $('#comSkim').append(option);
                }
            }
        });

        $.ajax({
            url: base_url + "api/get_laporan_gred/" + $(this).val() + "/0",
            success: function(gred,textStatus,jqXHR)
            {
                $('#comGred').html('<option value="0">Pilih Semua</option>');
                for(var i=0;i<gred.length;i++)
                {
                    var option=$('<option></option>').attr("value",gred[i]['id']).text(gred[i]['kod']);
                    $('#comGred').append(option);
                }
            }
        });
    });

    $("#comSkim").change(function(){
        $.ajax({
            url:"<?=base_url("api/get_laporan_gred/")?>/" + $("#comKelas").val() + "/" + $(this).val(),
            success: function(gred,textStatus,jqXHR)
            {
                $('#comGred').html('<option value="0">Pilih Semua</option>');
                for(var i=0;i<gred.length;i++)
                {
                    var option=$('<option></option>').attr("value",gred[i]['id']).text(gred[i]['kod']);
                    $('#comGred').append(option);
                }
            }
        });
    });

    load_datagrid(options);

    function load_datagrid(params){
        var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span>Loading...</span>');
        $.ajax({
            method: 'post',
            url: options.url,
            data: params.filter,
            beforeSend: function(jqXHR,settings){
                $('#datagrid').html(loader);
            },
            success: function(data,textStatus,jqXHR){
                $('#datagrid').html(data);
                $('ul.pagination li a').click(function(e){
                    e.preventDefault();
                    params.url = $(this).attr('href');
                    load_datagrid(params);
                });
            }
        });
    }

    $('#cmdDoTapis').click(function(e){
        e.preventDefault();

        options.filter.nama = $('#txtNama').val();
        options.filter.nokp = $('#txtNoKP').val();
        options.filter.jabatan_id = $('#comJabatan').val();
        options.filter.sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
        options.filter.kump_id = $('#comKelas').val();
        options.filter.skim_id = $('#comSkim').val();
        options.filter.gred_id = $('#comGred').val();
        options.filter.status = $('#comStatus').val();
        options.url = base_url+'pengguna/penyelaras_data_grid/0';
        
        load_datagrid(options);
    });
})();
</script>
