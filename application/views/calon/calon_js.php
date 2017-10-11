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
            jabatanID: <?= $jabatan_id ?>,
            kumpulan: null,
            gred: null,
            hari: null
        };

        createCalon(curview, filter);

        $('#cmdShowTapis').click(function (e) {
            e.preventDefault();
            $('#filter').toggle('fast');
        });

        $('#cmdDoTapis').click(function(e){
            e.preventDefault();

            filter.jabatanID = $('#comJabatan').val();
            filter.kumpulan = $('#comKelas').val(),
            filter.gred = $('#comGred').val(),
            filter.hari = $('#comHari').val()

            createCalon(curview, filter);
        });

        $('#cmdSenarai').click(function (e) {
            e.preventDefault();

            if($('#filter').is(':visible')) {
                $('#filter').toggle();
            }

            curview.curtable = (curview.curtable == 1 ? 2 : 1);

            if(curview.curtable == 1)
            {
                curview.curtitle = 'Senarai Peserta';
                curview.curbutton = 'Senarai Pencalonan >>';
            }

            if(curview.curtable == 2)
            {
                curview.curtitle = 'Senarai Pilihan Pencalonan';
                curview.curbutton = '<< Senarai Peserta';
            }

            createCalon(curview, filter);
        });

        function createCalon(curview, filter) {
            switch (curview.curtable) {
                case 1:
                    $('#cur_title').text(curview.curtitle);
                    $('#cmdSenarai').text(curview.curbutton);

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
                    $('#cur_title').text(curview.curtitle);
                    $('#cmdSenarai').text(curview.curbutton);

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
                                            $(":checked").each(function() {
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
    })();
});
</script>
