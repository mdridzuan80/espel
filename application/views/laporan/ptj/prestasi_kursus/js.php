<script>
$(function(){
    var tahun = $('#txtTahun').val();
    var pnokp = 0;
    var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');

    $('.btn-papar').on('click', function(e)
    {
        e.preventDefault();
        var btnPapar = this;
        var nama = $('#txtNama').val();
        var nokp = $('#txtNoKP').val();
        var jabatan = $('#comJabatan').val();
        var sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
        var kelas = $('#comKelas').val();
        var skim = $('#comSkim').val();
        var gred = $('#comGred').val();
        var hari = $('#comHari').val();
        var pnokp = 0;

        $('#rptPapar').html(loader);
        console.log('papar');
        $.ajax({
            method: 'post',
            data: {tahun: tahun, nama: nama, nokp: nokp, jabatan: jabatan, sub_jabatan: sub_jabatan, 'kelas[]': kelas, 'skim[]': skim, 'gred[]': gred, 'hari[]': hari},
            url: base_url + 'laporan/ajax_prestasi_kursus_keseluruhan',
            success: function(data, textStatus, jqXHR){
                $('#rptPapar').html(data);
            }
        });
    });

    $('#rptPapar').on('click','#cmdPdf',function(e){
        var nama = $('#txtNama').val();
        var nokp = $('#txtNoKP').val();
        var jabatan = $('#comJabatan').val();
        var sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
        var kelas = $('#comKelas').val();
        var skim = $('#comSkim').val();
        var gred = $('#comGred').val();
        var hari = $('#comHari').val();
        var filter = {tahun: tahun, nama: nama, nokp: nokp, jabatan: jabatan, sub_jabatan: sub_jabatan, 'kelas[]': kelas, 'skim[]': skim, 'gred[]': gred, 'hari[]': hari};

        janaReport(filter, $(this).attr('data-cmd'));
    });

    $('#rptPapar').on('click','#cmdXls',function(e){
        var nama = $('#txtNama').val();
        var nokp = $('#txtNoKP').val();
        var jabatan = $('#comJabatan').val();
        var sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
        var kelas = $('#comKelas').val();
        var skim = $('#comSkim').val();
        var gred = $('#comGred').val();
        var hari = $('#comHari').val();
        var filter = {tahun: tahun, nama: nama, nokp: nokp, jabatan: jabatan, sub_jabatan: sub_jabatan, 'kelas[]': kelas, 'skim[]': skim, 'gred[]': gred, 'hari[]': hari};

        janaReport(filter, $(this).attr('data-cmd'));
    });

    $('#rptPapar').on('click','#cmdWord',function(e){
        var nama = $('#txtNama').val();
        var nokp = $('#txtNoKP').val();
        var jabatan = $('#comJabatan').val();
        var sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
        var kelas = $('#comKelas').val();
        var skim = $('#comSkim').val();
        var gred = $('#comGred').val();
        var hari = $('#comHari').val();
        var filter = {tahun: tahun, nama: nama, nokp: nokp, jabatan: jabatan, sub_jabatan: sub_jabatan, 'kelas[]': kelas, 'skim[]': skim, 'gred[]': gred, 'hari[]': hari};
        
        janaReport(filter, $(this).attr('data-cmd'));
    });

    function janaReport(filter, jenis){
        filter.jenis = jenis;
        $.ajax({
            dataType: 'native',
            xhrFields: {
                responseType: 'blob'
            },
            method: 'post',
            data: filter,
            url: base_url + 'laporan/ajax_prestasi_kursus_keseluruhan_export',
            success: function(blob){
                var ext = {1: '.pdf', 2: '.xls', 3: '.doc'};
                console.log(blob.size);
                var link=document.createElement('a');
                link.href=window.URL.createObjectURL(blob);
                link.download="prestasi_kursus" + ext[jenis];
                link.click();
            }
        });
    }
});
</script>