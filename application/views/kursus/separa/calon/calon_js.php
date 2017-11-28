<script>
$(function() {
    var filter = {
        nama: '',
        nokp: '',
        jabatan_id: <?= $jabatan_id ?>,
        sub_jabatan: 1,
        kelas_id: '',
        skim_id: '',
        gred_id: '',
        hari: ''
    };
    var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    var modalUrl = '';
    var postData = {};
    var kursus_id= <?= $kursus_id ?>;
    
    load_peserta();
    // modal proses
    $('#myModalPencalonan').on('show.bs.modal',function(e){
        var vData = $(this).find("#datagrid-calon");
        vData.html(loader);
        load_content_modal(modalUrl,postData,vData);
    })

    $('#myModalPencalonan').on('hidden.bs.modal',function(e){
        var vData = $(this).find("#datagrid-calon");
        vData.html(loader);
    })

    function load_content_modal(url,data,placeholder){
        $.ajax({
            method: 'post',
            url: url,
            data: filter,
            success: function(data, textStatus, jqXHR){
                placeholder.html(data);
                $('#pencalonan').dataTable({
                    dom: "Bfrtip",
                    buttons: [
                        {
                            text: 'Tambah Sebagai Peserta',
                            action: function ( e, dt, node, config ) {
                                e.preventDefault();
                                var data = { 'chkKehadiran[]' : [], 'hadir': 'L', 'submit':'', 'kursus_id': curview.kursus_id};
                                $(".chkCalon:checked").each(function() {
                                    data['chkKehadiran[]'].push($(this).val());
                                });

                                $.ajax({
                                    data:data,
                                    method:'post',
                                    url: base_url + 'kursus/ajax_set_pencalonan/' + curview.kursus_id,
                                    success: function(){
                                        location.reload(true);
                                    },
                                    error: function(jqXHR,textStatus,errorThrown){
                                        alert(errorThrown);
                                    }
                                });
                            },
                            className: "btn-sm btn-success"
                        }
                    ]
                });

                $('#chkAll').click(function () {
                    $('input:checkbox').prop('checked', this.checked);
                });
            }
        });
    }
    // tamat modal proses

    $('#cmdPencalonan').on('click', function(e){
        e.preventDefault();
        var kursus_id = $(this).attr('data-kursus_id');
        modalUrl = base_url + 'kursus/ajax_get_pencalonan/' + kursus_id;
        $('#myModalPencalonan').modal();
    })

    $('#myModalPencalonan').on('click','#cmdCarianCalon', function(e){
        e.preventDefault();
        $('#myModalPencalonan').find('#carian-param').toggle('fast');
    });

    $('#myModalPencalonan').on('click','.btn-papar', function(e){
        e.preventDefault();
        //$('#myModalPencalonan').find('#carian-param').toggle('fast');
        var vData = $('#myModalPencalonan').find("#datagrid-calon");

        filter.nama = $('#myModalPencalonan').find('#txtNama').val();
        filter.nokp = $('#myModalPencalonan').find('#txtNoKP').val();
        filter.jabatan_id = $('#myModalPencalonan').find('#comJabatan').val();
        filter.sub_jabatan = ($('#myModalPencalonan').find('#chk_subjabatan').is(":checked") ? 1 : 0);
        filter.kelas_id = $('#myModalPencalonan').find('#comKelas').val();
        filter.skim_id = $('#myModalPencalonan').find('#comSkim').val();
        filter.gred_id = $('#myModalPencalonan').find('#comGred').val();
        filter.hari = $('#myModalPencalonan').find('#comHari').val();
        vData.html(loader);
        load_content_modal(modalUrl,filter,vData);
    });

    function load_peserta()
    {
        $.ajax({
            method: 'post',
            url: base_url + 'kursus/ajax_get_calon_terpilih/' + kursus_id,
            data: filter,
            success: function (data, textStatus, jqXHR) {
                $('#sen_calon').html(data);
                $('#peserta').dataTable();
            }
        });
    }

});
</script>
