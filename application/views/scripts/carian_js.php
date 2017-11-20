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
        url: base_url+'pengguna/data_grid/0'
   };
   var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
   var modalHeader = "";
   var modalUrl="";
   var postData={};

    $('#frmFilter').hide();

    $('#cmdFilter').click(function(e){
        e.preventDefault();
        $('#frmFilter').toggle('fast');
    });

    $("#comKelas").change(function(e){
        $.ajax({
            url:"<?=base_url("api/get_laporan_skim/")?>" + $(this).val().trim(),
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
            url: "<?=base_url("api/get_laporan_gred/")?>" + $(this).val().trim() + "/0",
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
            url:"<?=base_url("api/get_laporan_gred/")?>/" + $("#comKelas").val().trim() + "/" + $(this).val(),
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
        options.url = base_url+'pengguna/data_grid/0';
        
        load_datagrid(options);
    });
            
    $('#datagrid').on('click','a.btn-papar-profil', function(e) {
        e.preventDefault();
        modalHeader = "Profil Pengguna";
        modalUrl = base_url + 'profil/papar/' + $(this).attr('data-username');
        
        $('#myLargeModalLabel').html(modalHeader);
        $('#myModal').modal();
    });

    $('#datagrid').on('click','a.btn-reset-password', function(e) {
        e.preventDefault();
        modalHeader = "Reset Katalaluan";
        modalUrl = base_url + 'profil/resetKatalaluan/' + $(this).attr('data-username');
        
        $('#myLargeModalLabel').html(modalHeader);
        $('#myModal').modal();
    });

    $('#datagrid').on('click','a.btn-nyahaktif', function(e) {
        e.preventDefault();
        var username = $(this).attr('data-username');
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
            $.ajax({
                url: base_url + 'profil/' + username + '/status',
                success: function() {
                    swal('Berjaya!','','success');
                    load_datagrid(options);
                } ,
                error: function(jqXHR, textStatus,errorThrown) {
                    swal(textStatus,errorThrown,'error');
                }
            });
            
        },
        function (dismiss) {
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
    });

    // modal proses
    $('#myModal').on('show.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);
        load_content_modal(modalUrl,postData,vData);
    })

    $('#myModal').on('hidden.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);
    })

    function load_content_modal(url,data,placeholder){
        $.ajax({
            url: url,
            success: function(data, textStatus, jqXHR){
                placeholder.html(data);
            }
        });
    }
    // tamat modal proses

    $('#myModal').on('submit','#frm-reset-katalaluan',function(e){
        e.preventDefault();
        var data = $(this).serialize();

        if(e.target.txtKatalaluan.value === e.target.txtReKatalaluan.value) {
            $.ajax({
                method: 'post',
                data: $(e.target).serialize(),
                url: base_url + 'profil/ajax_do_resetkatalaluan',
                success: function() {
                    swal({
                        title: 'Berjaya!',
                        type: 'success'
                    });
                    $('#myModal').modal('hide');
                },
                error: function(jqXHR, textStatus,errorThrown)
                {
                    swal(textStatus,errorThrown,'error');
                }
            });
        }
        else {
            swal('Oops...','Katalaluan tidak sama dengan Re-Katalaluan','warning');
        }
    });
})();
</script>
