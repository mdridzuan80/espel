<script>
$(function(){
    var tahun = $('#txtTahun').val();
    var pnokp = 0;
    var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');

    $('.btn-papar').on('click', function(e)
    {
        e.preventDefault();
        var btnPapar = this;
        tahun = $('#txtTahun').val();
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
        $.ajax({
            method: 'post',
            data: {tahun: tahun, nama: nama, nokp: nokp, jabatan: jabatan, sub_jabatan: sub_jabatan, kelas: kelas, skim: skim, gred: gred, hari: hari},
            url: base_url + 'laporan/ajax_papar_pengguna_hadir_ptj_kursus',
            success: function(data, textStatus, jqXHR){
                $('#rptPapar').html(data);
                $('.datatable').dataTable();
            }
        });
    });
    ///
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
        janaReport_1(data, $(this).attr('data-cmd'));
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
        janaReport_1(data, $(this).attr('data-cmd'));
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
        janaReport_1(data, $(this).attr('data-cmd'));
    });

    function janaReport_1(data, jenis){
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
    ///
    $('#myLaporanModal').on('click','#cmdPdf',function(e){
        janaReport(tahun, $(this).attr('data-cmd'));
    });

    $('#myLaporanModal').on('click','#cmdXls',function(e){
        janaReport(tahun, $(this).attr('data-cmd'));
    });

    $('#myLaporanModal').on('click','#cmdWord',function(e){
        janaReport(tahun, $(this).attr('data-cmd'));
    });

    function janaReport(tahun, jenis){
        $.ajax({
            dataType: 'native',
            xhrFields: {
                responseType: 'blob'
            },
            method: 'post',
            data: {tahun: tahun, nokp: pnokp, jenis: jenis},
            url: base_url + 'laporan/ajax_papar_pengguna_hadir_export',
            success: function(blob){
                var ext = {1: '.pdf', 2: '.xls', 3: '.doc'};
                console.log(blob.size);
                var link=document.createElement('a');
                link.href=window.URL.createObjectURL(blob);
                link.download="senarai_hadir" + ext[jenis];
                link.click();
            }
        });
    }

    $('#rptPapar').on('click','.btn-papar-senarai', function(e) {
        e.preventDefault();
        pnokp = $(this).attr('data-nokp');
        $('#myLaporanModal').modal();
    });

    $('#myLaporanModal').on('shown.bs.modal',function(e){
        e.preventDefault();
        var vData = $(this).find(".modal-body");
        vData.html(loader);
        $.ajax({
            method: 'post',
            data: {tahun: tahun, nokp: pnokp},
            url: base_url + 'laporan/ajax_papar_pengguna_hadir_kursus',
            success: function(data, textStatus, jqXHR){
                vData.html(data);
            }
        });
    })

    $('#myLaporanModal').on('hidden.bs.modal',function(e){
        e.preventDefault();
        var vData = $(this).find(".modal-body");
        vData.html(loader);
    })
});
</script>