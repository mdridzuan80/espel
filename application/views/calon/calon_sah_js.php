<script>
$(document).ready(function() {
    $('#chkAll').click(function () {
        $('input:checkbox').prop('checked', this.checked);
    });

    $("#cmdHadir").click(function(e){
        e.preventDefault();
        var data = { 'chkKehadiran[]' : [], 'stat_hadir': 'Y', 'submit':''};
        $(":checked").each(function() {
          data['chkKehadiran[]'].push($(this).val());
        });

        $.ajax({
            data:data,
            method:'post',
            url: base_url + 'kursus/kehadiran_peserta',
            success: function(){
                location.reload(true);
            },
            error: function(jqXHR,textStatus,errorThrown){
                alert(errorThrown);
            }
        });
    });

    $("#cmdTidahHadir").click(function(e){
        e.preventDefault();
        var data = { 'chkKehadiran[]' : [], 'stat_hadir': 'T', 'submit':''};
        $(":checked").each(function() {
          data['chkKehadiran[]'].push($(this).val());
        });

        $.ajax({
            data:data,
            method:'post',
            url: base_url + 'kursus/kehadiran_peserta',
            success: function(){
                location.reload(true);
            },
            error: function(jqXHR,textStatus,errorThrown){
                alert(errorThrown);
            }
        });
    });
});
</script>
