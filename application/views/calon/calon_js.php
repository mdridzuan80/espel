<script>
$(document).ready(function() {
    (function () {
        var curview = {
            curtable: 1,
            curtitle: 'Senarai Peserta',
            curbutton: 'Senarai Pencalonan >>',
            kursus_id: $('#kursus_id').val()
        };
        var filter = {
            nama: null,
            nokp: null,
            jabatanID: <?= $jabatan_id ?>,
            kumpulan: null,
            skim: null,
            gred: null,
            hari: null,
            sub_jabatan: 1,
        };
        var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        var modalHeader = "";
        var modalUrl="";
        var postData={};

        createCalon(curview, filter);

        $('#cmdShowTapis').click(function (e) {
            e.preventDefault();
            $('#filter').toggle('fast');
        });

        $('#cmdDoTapis').click(function(e){
            e.preventDefault();

            filter.nama = $('#txtNama').val();
            filter.nokp = $('#txtNoKP').val();
            filter.jabatanID = $('#comJabatan').val();
            filter.kumpulan = $('#comKelas').val(),
            filter.skim = $('#comSkim').val(),
            filter.gred = $('#comGred').val(),
            filter.hari = $('#comHari').val(),
            filter.sub_jabatan = ($('#chk_subjabatan').is(":checked") ? 1 : 0);

            createCalon(curview, filter);
        });

        $('#cmdSenarai').click(function (e) {
            e.preventDefault();

            if($('#filter').is(':visible')) {
                $('#filter').toggle();
            }

            modalHeader = "Senarai Pencalonan Peserta";
            modalUrl = base_url + 'kursus/ajax_get_pencalonan/' + curview.kursus_id;
            
            $('#myLargeModalLabel').html(modalHeader);

            $('#myCalonModal').modal();
        });

        function createCalon(curview, filter) {
            switch (curview.curtable) {
                case 1:
                    $('#cur_title').text(curview.curtitle);
                    $('#cmdSenarai').text(curview.curbutton);
                    $('#sen_calon').html(loader);
                    $.ajax({
                        method: 'post',
                        url: base_url + 'kursus/ajax_get_calon_terpilih/' + curview.kursus_id,
                        data: filter,
                        success: function (data, textStatus, jqXHR) {
                            $('#sen_calon').html(data);
                            $('#peserta').dataTable();
                        }
                    });
                break;

                case 2:
                    var loader =$('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span>Loading...</span>');

                    $('#cur_title').text(curview.curtitle);
                    $('#cmdSenarai').text(curview.curbutton);
                    $('#sen_calon').html(loader);
                    $.ajax({
                        method: 'post',
                        url: base_url + 'kursus/ajax_get_pencalonan/' + curview.kursus_id,
                        data: filter,
                        success: function (data, textStatus, jqXHR) {
                            $('#sen_calon').html(data);

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
                break;
            }
        }

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
                url:"<?=base_url("api/get_laporan_gred/")?>" + $("#comKelas").val().trim() + "/" + $(this).val(),
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

        // modal proses
        $('#myCalonModal').on('show.bs.modal',function(e){
            var vData = $(this).find(".modal-body");
            vData.html(loader);
            load_content_modal(modalUrl,postData,vData);
        })

        $('#myCalonModal').on('hidden.bs.modal',function(e){
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
    })();
});
</script>
