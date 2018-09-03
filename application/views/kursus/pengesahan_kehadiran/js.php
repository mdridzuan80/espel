<script>
(function() {
    var options = {
        page: 0,
        filter: {
            nama: '',
            nokp: '',
            jabatan_id: <?= $jab_ptj ?>,
            sub_jabatan: 1,
            kump_id: 0,
            skim_id: 0,
            gred_id: 0,
            status: 'Y'
        },
        url: base_url+'kursus/data_grid_pengesahan'
   };

    $('#frmFilter').hide();

    $('#btnCarianPengesahan').click(function(e){
        e.preventDefault();
        $('#frmFilter').toggle('fast');
    });

    $("#comKelas").on('change', function(e) {
        $.ajax({
            url:"<?= base_url("api/get_laporan_skim/") ?>" + $(this).val().trim(),
            success: function(gred,textStatus,jqXHR)
            {
                $('#comSkim').html('<option value="0">Pilih Semua</option>');
                for (var i=0;i<gred.length;i++)
                {
                    var option=$('<option></option>').attr("value",gred[i]['id']).text(gred[i]['id'] + ' ' + gred[i]['kod']);
                    $('#comSkim').append(option);
                }
            }
        });

        $.ajax({
            url: "<?= base_url("api/get_laporan_gred/") ?>" + $(this).val().trim() + "/0",
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

    $("#comSkim").on('change', function(e) {
        $.ajax({
            url:"<?= base_url("api/get_laporan_gred/") ?>" + $("#comKelas").val().trim() + "/" + $(this).val(),
            success: function(gred,textStatus,jqXHR)
            {
                $('#comGred').html('<option value="0">Pilih Semua</option>');
                for (var i=0;i<gred.length;i++)
                {
                    var option=$('<option></option>').attr("value",gred[i]['id']).text(gred[i]['kod']);
                    $('#comGred').append(option);
                }
            }
        });
    });

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
        options.url = base_url+'kursus/data_grid_pengesahan';
        
        load_datagrid(options);
    });

    function load_datagrid(params){
        var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span>Loading...</span>');
        $.ajax({
            method: 'post',
            url: options.url,
            data: params.filter,
            beforeSend: function (jqXHR,settings) {
                $('#placePengesahan').html(loader);
            },
            success: function (data,textStatus,jqXHR) {
                $('#placePengesahan').html(data);
                $('.dtPengesahan').dataTable();
            }
        });
    }

    $('.dtPengesahan').dataTable();

    $('.btnHapus').on('click', function(e){
        e.preventDefault();
        var kursus_id = $(this).attr('data-kursusid');
        var data = new FormData(document.getElementById('frmKursus'));
        showSwal(kursus_id, base_url + 'kursus/delete_luar/' + kursus_id, data, base_url + 'kursus/pengesahan_kehadiran');
    });

    $('.btnKemaskini').on('click', function(e){
        e.preventDefault();
        var kursus_id = $(this).attr('data-kursusid');
        var data = new FormData(document.getElementById('frmKursus'));
        
        showSwal(kursus_id, base_url + 'kursus/do_sah_kemaskini/' + kursus_id, data, base_url + 'kursus/view_luar/' + kursus_id);
    });

    $('.btnPengesahan').on('click', function(e){
        e.preventDefault();
        var kursus_id = $(this).attr('data-kursusid');
        var data = new FormData(document.getElementById('frmKursus'));

        data.append('comKehadiran', $(this).data('hadir'));

        showSwal(kursus_id, base_url + 'kursus/do_sah/' + kursus_id, data, base_url + 'kursus/pengesahan_kehadiran');
    });

    function showSwal(kursus_id, url, data, redirect='') {
        swal({
            title: 'Anda Pasti?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {
            ajaxAction(kursus_id, data, url, redirect);
        }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                'Batal!',
                '',
                'error'
                )
            }
        });
    }

    function ajaxAction(kursus_id, data, url, redirect)
    {
        $.ajax({
            url: url,
            method: 'post',
            data: data,
            processData: false,
            contentType: false,
            success: function() {
                swal('Berjaya!','','success').then(function(){window.location = redirect;});
            } ,
            error: function(jqXHR, textStatus,errorThrown) {
                swal(textStatus,errorThrown,'error');
            }
        })
    };
})();
</script>