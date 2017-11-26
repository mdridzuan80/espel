<script>
$(function(){
    $('#btnMohon').on('click', function(e) {
        e.preventDefault();
        var kursus_id = $(this).attr('data-kursus_id');
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
                url: base_url + 'api/csrf',
                success: function(data, textStatus, jqXHR ) {
                    var frmData = {mohon:''};
                    frmData[data.csrfTokenName] = data.csrfHash;
                    $.ajax({
                        method: 'post',
                        data: frmData,
                        url: base_url + 'kursus/info_kursus_pengguna/' + kursus_id,
                        success: function() {
                            swal('Berjaya!','','success').then(function(){
                                window.location.href = base_url;
                            });
                            load_datagrid(options);
                        } ,
                        error: function(jqXHR, textStatus,errorThrown) {
                            swal(textStatus,errorThrown,'error');
                        }
                    })
                },
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
});
</script>