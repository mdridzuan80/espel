(function(){
    var buttonCommon = {
        exportOptions: {
            format: {
                body: function (data, row, column, node) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                        data.replace(/[$,]/g, '') :
                        data;
                }
            }
        }
    };
    var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    var url = '';
    var modalHeader = '';
    var modalUrl = '';
    var postData = {};

    $('.datatable').dataTable();

    $("#comPeranan").change(function(){
        if($(this).val() == 3){
            $("#jabatan-penyelaras").show();
            $('#jabatan-tree').show();
        }
        else{
            $("#jabatan-penyelaras").hide();
            $('#jabatan-tree').hide();
        }
    });

    $('#linkProfil').on('click', function (e) {
        e.preventDefault();

        modalHeader = 'Profil'
        modalUrl = base_url + 'profil/papar/' + e.target.attributes[1].value
        $('#myLargeGlobalModalLabel').html(modalHeader);
        $('#myGlobalModal').modal();
    });

    $('#linkResetKatalaluan').on('click', function (e) {
        e.preventDefault();
        modalHeader = "Reset Katalaluan";
        modalUrl = base_url + 'profil/resetKatalaluan/' + e.target.attributes[1].value;

        $('#myLargeGlobalModalLabel').html(modalHeader);
        $('#myGlobalModal').modal();
    });

    // modal proses
    $('#myGlobalModal').on('show.bs.modal', function (e) {
        console.log(e);
        var vData = $(this).find(".modal-body");
        load_content_global_modal(modalUrl, postData, vData);
    })

    $('#myGlobalModal').on('hidden.bs.modal', function (e) {
        var vData = $(this).find(".modal-body");
        vData.html(loader);
    })

    function load_content_global_modal(url, data, placeholder) {
        $.ajax({
            url: url,
            success: function (data, textStatus, jqXHR) {
                placeholder.html(data);
            }
        });
    }
    // tamat modal proses
    $('#myGlobalModal').on('submit', '#frm-reset-katalaluan', function (e) {
        e.preventDefault();
        var data = $(this).serialize();

        if (e.target.txtKatalaluan.value === e.target.txtReKatalaluan.value) {
            $.ajax({
                method: 'post',
                data: $(e.target).serialize(),
                url: base_url + 'profil/ajax_do_resetkatalaluan',
                success: function () {
                    swal({
                        title: 'Berjaya!',
                        type: 'success'
                    });
                    $('#myGlobalModal').modal('hide');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal(textStatus, errorThrown, 'error');
                }
            });
        }
        else {
            swal('Oops...', 'Katalaluan tidak sama dengan Re-Katalaluan', 'warning');
        }
    });
})();
