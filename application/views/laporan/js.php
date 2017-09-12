<script>
    (function(){
        $("#comKelas").change(function(){

            $.ajax({
                url:"<?=base_url("api/get_laporan_gred/")?>" + $(this).val(),
                success: function(gred,textStatus,jqXHR)
                {
                    $('#comGred').html('<option value="0">pilih semua</option>');
                    for(var i=0;i<gred.length;i++)
                    {
                        var option=$('<option></option>').attr("value",gred[i]['id']).text(gred[i]['kod']);
                        $('#comGred').append(option);
                    }
                }
            });
        });
    })()
</script>
