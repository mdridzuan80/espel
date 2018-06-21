<script>
(function() {
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