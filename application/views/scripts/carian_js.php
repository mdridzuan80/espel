<script>
(function(){
    var options = {
        page: 0,
        filter: {
            nama: '',
            jabatan_id: 6792,
            sub_jabatan: 1,
            kump_id: 0,
            skim_id: 0,
            gred_id: 0
        },
        url:base_url+'pengguna/data_grid/0'
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
    });

    $("#comSkim").change(function(){
        $.ajax({
            url:"<?=base_url("api/get_laporan_gred/")?>" + $(this).val(),
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
        $.ajax({
            method: 'post',
            url: options.url,
            data: params.filter,
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

    $('#cmdFilter').click(function(e){
        alert('Filtered');
    });
})();
</script>
