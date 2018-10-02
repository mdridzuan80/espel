<script>
    $(function(){
        $('#frmFilter').toggle();
        var current = new Date();
        var dateObj = {
            placeholder: $('#sen_permohonan_sah'),
            tajuk: $('#txtTajuk').val(),
            bulan:  $('#comBulan').val(),
            tahun: current.getFullYear(),
            status: 'R'
        };

        getPermohonanKursus(dateObj);

        $('#cmdCarian').click(function(e) {
            $('#frmFilter').toggle('fast');
        });

        $('#cmdDoTapis').click(function(e){
            e.preventDefault();
            dateObj.tajuk = $('#txtTajuk').val();
            dateObj.tahun = $('#comTahun').val();
            dateObj.bulan = $('#comBulan').val();
            dateObj.status = $('#comStatus').val();
            getPermohonanKursus(dateObj);
        });

        function getPermohonanKursus(obj) {
            $.ajax({
                url: base_url + 'kursus/ajax_senarai_separa_permohonan',
                data: { tajuk: obj.tajuk, tahun: obj.tahun, bulan: obj.bulan, status: obj.status },
                method: 'POST',
                success: function (data, textStatus, jqXHR) {
                    obj.placeholder.html(data);
                }
            });
        }
    });
</script>