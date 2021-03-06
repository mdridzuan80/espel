<script>
$(function(){
    $('.btn-papar').on('click', function(e)
    {
        e.preventDefault();
        var btnPapar = this;
        var tahun = $('#txtTahun').val();
        var nama = $('#txtNama').val();
        var nokp = $('#txtNoKP').val();
        var jabatan = $('#comJabatan').val();
        var sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
        var kelas = $('#comKelas').val();
        var skim = $('#comSkim').val();
        var gred = $('#comGred').val();
        var hari = $('#comHari').val();
        var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');

        $('#rptPapar').html(loader);
        $.ajax({
            method: 'post',
            data: {tahun: tahun, nama: nama, nokp: nokp, jabatan: jabatan, sub_jabatan: sub_jabatan, kelas: kelas, skim: skim, gred: gred, hari: hari},
            url: base_url + 'laporan/ajax_prestasi_kursus_individu',
            success: function(data, textStatus, jqXHR){
                $('#rptPapar').html(data);
                $('.datatable').dataTable();
            }
        });
    });

    $('#rptPapar').on('click','#cmdPdf',function(e){
        var data = {
            tahun:  $('#txtTahun').val(),
            nama: $('#txtNama').val(),
            nokp: $('#txtNoKP').val(),
            jabatan: $('#comJabatan').val(),
            sub_jabatan: ($('#chk_subjabatan').is(":checked") ? 1 : 0),
            kelas: $('#comKelas').val(),
            skim: $('#comSkim').val(),
            gred: $('#comGred').val(),
            hari: $('#comHari').val(),
            jenis: $(this).attr('data-cmd')
        };
        janaReport(data, $(this).attr('data-cmd'));
    });

    $('#rptPapar').on('click','#cmdXls',function(e){
        var data = {
            tahun:  $('#txtTahun').val(),
            nama: $('#txtNama').val(),
            nokp: $('#txtNoKP').val(),
            jabatan: $('#comJabatan').val(),
            sub_jabatan: ($('#chk_subjabatan').is(":checked") ? 1 : 0),
            kelas: $('#comKelas').val(),
            skim: $('#comSkim').val(),
            gred: $('#comGred').val(),
            hari: $('#comHari').val(),
            jenis: $(this).attr('data-cmd')
        };
        janaReport(data, $(this).attr('data-cmd'));
    });

    $('#rptPapar').on('click','#cmdWord',function(e){
        var data = {
            tahun:  $('#txtTahun').val(),
            nama: $('#txtNama').val(),
            nokp: $('#txtNoKP').val(),
            jabatan: $('#comJabatan').val(),
            sub_jabatan: ($('#chk_subjabatan').is(":checked") ? 1 : 0),
            kelas: $('#comKelas').val(),
            skim: $('#comSkim').val(),
            gred: $('#comGred').val(),
            hari: $('#comHari').val(),
            jenis: $(this).attr('data-cmd')
        };
        janaReport(data, $(this).attr('data-cmd'));
    });

    function janaReport(data, jenis){
        $.ajax({
            dataType: 'native',
            xhrFields: {
                responseType: 'blob'
            },
            method: 'post',
            data: data,
            url: base_url + 'laporan/ajax_prestasi_kursus_individu_export',
            success: function(blob){
                var ext = {1: '.pdf', 2: '.xls', 3: '.doc'};
                console.log(blob.size);
                var link=document.createElement('a');
                link.href=window.URL.createObjectURL(blob);
                link.download="prestasi_individu" + ext[jenis];
                link.click();
            }
        });
    }
});
</script>