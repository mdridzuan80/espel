<script>
$(function(){
    var tahun = $('#txtTahun').val();
    var nama = $('#txtNama').val();
    var nokp = $('#txtNoKP').val();
    var jabatan = $('#comJabatan').val();
    var sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
    var kelas = $('#comKelas').val();
    var skim = $('#comSkim').val();
    var gred = $('#comGred').val();
    var hari = $('#comHari').val();
    var shari = '';
    var skelas = '';
    var pUrl = '';
    var filter = {};
    var xhr = {};

    var pnokp = 0;
    var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');

    $('.btn-papar').on('click', function(e)
    {
        e.preventDefault();
        var btnPapar = this;
        tahun = $('#txtTahun').val();
        nama = $('#txtNama').val();
        nokp = $('#txtNoKP').val();
        jabatan = $('#comJabatan').val();
        sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
        kelas = $('#comKelas').val();
        skim = $('#comSkim').val();
        gred = $('#comGred').val();
        hari = $('#comHari').val();
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


     $('#rptPapar').on('click','a.pdetail',function(e){
         e.preventDefault();
        tahun = $('#txtTahun').val();
        nama = $('#txtNama').val();
        nokp = $('#txtNoKP').val();
        jabatan = $('#comJabatan').val();
        sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);
        kelas = $('#comKelas').val();
        skim = $('#comSkim').val();
        gred = $('#comGred').val();
        hari = $('#comHari').val();
        shari = $(this).attr('data-hari');
        skelas = $(this).attr('data-kelas');
        pUrl = $(this).attr('href');
        filter = {tahun: tahun, nama: nama, nokp: nokp, jabatan: jabatan, sub_jabatan: sub_jabatan, 'kelas[]': kelas, 'skim[]': skim, 'gred[]': gred, 'hari[]': hari, shari: shari, skelas: skelas};
        $('#myLaporanModal').modal();
    });

    $('#myLaporanModal').on('shown.bs.modal',function(e){
        e.preventDefault();
        var vData = $(this).find(".modal-body");
        vData.html(loader);
        xhr = $.ajax({
            method: 'post',
            data: filter,
            url: base_url + 'laporan/' + pUrl ,
            success: function(data, textStatus, jqXHR){
                vData.html(data);
                $('.datatable').dataTable();
            }
        });
    })

    $('#myLaporanModal').on('hidden.bs.modal',function(e){
        e.preventDefault();
        var vData = $(this).find(".modal-body");
        vData.html(loader);
        
        if(xhr){ 
            xhr.abort();
        }
    })
});
</script>