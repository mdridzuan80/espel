<script>
$(function(){
    $('.btn-papar').on('click', function(e)
    {
        e.preventDefault();
        var btnPapar = this;
        var tahun = $('#txtTahun').val();
        var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');

        $('#rptPapar').html(loader);
        $.ajax({
            method: 'post',
            data: {tahun: tahun},
            url: base_url + 'laporan/ajax_penganjur_kursus',
            success: function(data, textStatus, jqXHR){
                $('#rptPapar').html(data);
            }
        });
    });

    $('#rptPapar').on('click','#cmdPdf',function(e){
        var tahun = $('#txtTahun').val();
        janaReport(tahun, $(this).attr('data-cmd'));
    });

    $('#rptPapar').on('click','#cmdXls',function(e){
        var tahun = $('#txtTahun').val();
        janaReport(tahun, $(this).attr('data-cmd'));
    });

    $('#rptPapar').on('click','#cmdWord',function(e){
        var tahun = $('#txtTahun').val();
        janaReport(tahun, $(this).attr('data-cmd'));
    });

    function janaReport(tahun, jenis){
        $.ajax({
            dataType: 'native',
            xhrFields: {
                responseType: 'blob'
            },
            method: 'post',
            data: {tahun: tahun, jenis: jenis},
            url: base_url + 'laporan/ajax_penganjur_kursus_export',
            success: function(blob){
                var ext = {1: '.pdf', 2: '.xls', 3: '.doc'};
                console.log(blob.size);
                var link=document.createElement('a');
                link.href=window.URL.createObjectURL(blob);
                link.download="senarai_penganjuran_kursus" + ext[jenis];
                link.click();
            }
        });
    }
});
</script>