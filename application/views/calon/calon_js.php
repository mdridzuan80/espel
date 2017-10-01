<script>
$(document).ready(function() {
    (function () {
        var curview = {
            curtable: 1,
            curtitle: 'Senarai Calon yang dipilih',
            curbutton: 'Senarai Pencalonan',
            kursus_id: $('#kursus_id').val()
        };
        var filter = {
            jabatanID: null,
            kumpulan: null,
            gred: null,
            hari: null
        };

        createCalon(curview, filter);

        $('#cmdTapis').click(function (e) {
            e.preventDefault();
            $('#filter').toggle();
        });

        $('#cmdSenarai').click(function (e) {
            e.preventDefault();

            if($('#filter').is(':visible')) {
                $('#filter').toggle();
            }

            filter = {
                jabatanID: null,
                kumpulan: null,
                gred: null,
                hari: null
            };
            curview.curtable = (curview.curtable == 1 ? 2 : 1);

            if(curview.curtable == 1)
            {
                curview.curtitle = 'Senarai Calon yang dipilih';
                curview.curbutton = 'Senarai Pencalonan';
            }

            if(curview.curtable == 2)
            {
                curview.curtitle = 'Senarai Nama Pencalonan';
                curview.curbutton = 'Senarai Calon';
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
                        url: base_url + 'kursus/ajax_get_calon_terpilih',
                        data: filter,
                        success: function (data, textStatus, jqXHR) {
                            $('#sen_calon').html(data);
                        }
                    });
                break;

                case 2:
                    $('#cur_title').text(curview.curtitle);
                    $('#cmdSenarai').text(curview.curbutton);

                    $.ajax({
                        method: 'post',
                        url: base_url + 'kursus/ajax_get_calon_terpilih',
                        data: filter,
                        success: function (data, textStatus, jqXHR) {
                            $('#sen_calon').html(data);
                        }
                    });
                break;
            }
        }
    })();
});
</script>
