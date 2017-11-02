<script>
$(function(){
    $( "#frmKumpulan" ).submit(function( event ) {
        var status = true;

        if($('#comPeranan').val() == 0)  {
            status = false;
        }
        else {
            if($('#comPeranan').val() == 3) {
                if(!$('#comJabatanPenyelaras').val()) {
                    status = false
                }
            }
        }

        if(!status)
        {
            alert( "Semua Tempat Perlu diisi" );
            event.preventDefault();
        }
    });
});
</script>
