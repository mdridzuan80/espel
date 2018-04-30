<script>
$(function(){
    // daftar kursus luar
    var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    var url = '';
    var modalHeader = '';
    var modalUrl = '';
    var postData = {};
    var operasi = '';
    var programId = '';

    $('a.btnEdit').on('click', function(e){
        e.preventDefault();
        var kursus_id = $(this).data('kursus_id');
        programId = $(this).data('program_id');
        openEdit = true;
        modalHeader = 'Kemaskini Daftar Kursus Anjuran Luar';
        modalUrl = base_url + 'kursus/edit_luar/' + kursus_id;
        $('#myLargeModalLabel').html(modalHeader);
        $('#myModal').modal();;
    });

    // modal proses
    $('#myModal').on('show.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);
        load_content_modal(modalUrl,postData,vData);
    })

    $('#myModal').on('shown.bs.modal',function(e){
        initform(programId);
        $(".easyui-combotree").css("width", $( '.col-md-6' ).actual( 'width' )-5);
        $('#comPenganjurLatihan').combotree();
        $('#comPenganjurPemb').combotree();
        $('#comPenganjurPemb2').combotree();
        $('#comPenganjurKend').combotree();
    })

    $('#myModal').on('hidden.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);
    })

    function load_content_modal(url,data,placeholder){
        xhr = $.ajax({
            url: url,
            success: function(data, textStatus, jqXHR){
                placeholder.html(data);
            }
        });
    }

    $('#myModal').on('submit','.frm-edit-daftar-kursus',function(e){
        e.preventDefault();
        var button_submit = $(this).find("button[type=submit]");
        var formData = new FormData(this);
        var formCsrf = {};

        button_submit.attr("disabled", true);

        $.ajax({
            url: base_url + 'api/csrf',
            success: function(data, textStatus, jqXHR ) {
                formCsrf = data;
                formData.append(data.csrfTokenName, data.csrfHash);
                $.ajax({
                    method: 'post',
                    data: formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    url: base_url + 'kursus/ajax_do_edit_luar',
                    success: function() {
                        swal({
                            title: 'Berjaya!',
                            text: 'Proses mendaftar kursus selesai.',
                            type: 'success'
                        });
                        //resetPopulateEvent();
                        //populateEvent();
                        $('#myModal').modal('hide');
                    },
                    error: function(jqXHR, textStatus,errorThrown)
                    {
                        swal('Ralat!',errorThrown,'error');
                        button_submit.attr("disabled", false);
                    }
                });
            }
        });
    });

    function initform(program_id) {
        if(program_id == 1 || program_id == 2){
            viewPanelKursus(true,false,false,false);
            $("#txtTkhMula").datetimepicker({
                format: "DD-MM-YYYY"
            });
            $("#txtTkhTamat").datetimepicker({
                format: "DD-MM-YYYY"
            });
            $("#txtTkhMula").on("dp.hide", function (e) {
                $('#txtTkhTamat').data("DateTimePicker").minDate(e.date);
            });
            $("#txtTkhTamat").on("dp.hide", function (e) {
                $('#txtTkhMula').data("DateTimePicker").maxDate(e.date);
            });

            var masaMula = $('#txtMasaMula').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });

            var masaTamat = $('#txtMasaTamat').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });
        }
        if(program_id == 3){
            viewPanelKursus(false,true,false,false);
            $("#txtTkhMulaPemb").datetimepicker({
                format: "DD-MM-YYYY"
            });
            $("#txtTkhTamatPemb").datetimepicker({
                format: "DD-MM-YYYY"
            });
            $("#txtTkhMulaPemb").on("dp.hide", function (e) {
                $('#txtTkhTamatPemb').data("DateTimePicker").minDate(e.date);
            });
            $("#txtTkhTamatPemb").on("dp.hide", function (e) {
                $('#txtTkhMulaPemb').data("DateTimePicker").maxDate(e.date);
            });

            var masaMula = $('#txtMasaMulaPemb').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });

            var masaTamat = $('#txtMasaTamatPemb').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });
        }

        if(program_id == 4){
            viewPanelKursus(false,false,true,false);
            $("#txtTkhMulaPemb2").datetimepicker({
                format: "DD-MM-YYYY"
            });
            $("#txtTkhTamatPemb2").datetimepicker({
                format: "DD-MM-YYYY"
            });
            $("#txtTkhMulaPemb2").on("dp.hide", function (e) {
                $('#txtTkhTamatPemb2').data("DateTimePicker").minDate(e.date);
            });
            $("#txtTkhTamatPemb2").on("dp.hide", function (e) {
                $('#txtTkhMulaPemb2').data("DateTimePicker").maxDate(e.date);
            });

            var masaMula = $('#txtMasaMulaPemb2').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });

            var masaTamat = $('#txtMasaTamatPemb2').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });
        }
        if(program_id == 5){
            viewPanelKursus(false,false,false,true);
            $("#txtTkhMulaKend").datetimepicker({
                format: "DD-MM-YYYY"
            });
            $("#txtTkhTamatKend").datetimepicker({
                format: "DD-MM-YYYY"
            });
            $("#txtTkhMulaKend").on("dp.hide", function (e) {
                $('#txtTkhTamatKend').data("DateTimePicker").minDate(e.date);
            });
            $("#txtTkhTamatKend").on("dp.hide", function (e) {
                $('#txtTkhMulaKend').data("DateTimePicker").maxDate(e.date);
            });

            var masaMula = $('#txtMasaMulaKend').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });

            var masaTamat = $('#txtMasaTamatKend').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });
        }
        if (program_id == 0) {
            viewPanelKursus(false,false,false,false);
        }
    }

    function viewPanelKursus(latihan,pembelajaran1,pembelajaran2,kendiri)
    {
        $('.espel_latihan').hide();
        $('.espel_pembelajaran1').hide();
        $('.espel_pembelajaran2').hide();
        $('.espel_kendiri').hide();

        if(latihan)
            $('.espel_latihan').show();

        if(pembelajaran1)
            $('.espel_pembelajaran1').show();

        if(pembelajaran2)
            $('.espel_pembelajaran2').show();

        if(kendiri)
            $('.espel_kendiri').show();
    }
});
</script>