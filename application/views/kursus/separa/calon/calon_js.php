<script>
$(function() {
    var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    var modalUrl = '';
    var postData = {};
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
            url: url,
            success: function(data, textStatus, jqXHR){
                placeholder.html(data);
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
});
</script>
