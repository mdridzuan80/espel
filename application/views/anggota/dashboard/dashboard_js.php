<script>
$(function() {
    var tahun = <?= $this->uri->segment(3, date('Y')) ?>;
    var bulan = <?= $this->uri->segment(4, date('m')) ?>;
    var xhr = {};
    var kursusId = 0;
    var tajuk = '';
    var events = [];
    var openEdit = false;
    var postData = {};
    var operasi = '';
    var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');

    populateEvent();

    function populateEvent() {
        xhr = $.ajax({
            url: base_url + "api/get_sen_event_pengguna_3/" + tahun,
            success: function(sen_kursus, textStatus, jqXHR ){
                events = sen_kursus;
            }
        });
    }

     $('.btnPapar').on('click', function(e){
        e.preventDefault();
        kursusId = $(this).data('kursusid');
        tajuk = $(this).data('tajuk');
        $('#MyModalKursusInfo').modal();
    });

    $('#MyModalKursusInfo').on('show.bs.modal',function(e){
        var vHeader = $(this).find(".modal-header");
        var vTajuk = $(this).find(".modal-title");
        var vData = $(this).find(".modal-body");  
        var event = _.find(events, ['id', parseInt(kursusId)]);
        var modalUrl = base_url+"kursus/info_kursus_pengguna_2/"+kursusId;
        
        if(event.stat_jabatan == 'Y') {
            if(event.jenis && event.jenis == 'R') {
                vHeader.css( "background-color", "#c8b1f1" );
            }
            else if(event.jenis && event.jenis == 'S') {
                vHeader.css( "background-color", "#dcb5b5" );
            }
            else {
                vHeader.css( "background-color", "white" );
            }
        }

        if(event.stat_jabatan=='T') {
            vHeader.css( "background-color", "#19BC9D" );
        }

        vHeader.css( "color", "black" );
        vTajuk.html(tajuk.toUpperCase());
        vData.html(loader);
        load_content_modal(modalUrl, postData, vData);
    })

    $('#MyModalKursusInfo').on('click', '#btnEdit', function(e){
        e.preventDefault();
        var kursus_id = $(this).data('kursus_id');
        programId = $(this).data('program_id');
        openEdit = true;
        modalHeader = 'Kemaskini Daftar Kursus Anjuran Luar';
        modalUrl = base_url + 'kursus/edit_luar/' + kursus_id;
        $('#myLargeModalLabel').html(modalHeader);
        $('#MyModalKursusInfo').modal('hide');        
    });

    $('#MyModalKursusInfo').on('click', '#btnHapus', function(e){
        e.preventDefault();
        var el = $(this);
        var kursus_id = el.data('kursus_id');
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
                url: base_url + 'kursus/delete_luar/' + kursus_id,
                success: function() {
                    swal('Berjaya!','','success').then(function(){
                        $('#MyModalKursusInfo').modal('hide');
                        location.reload();
                    });
                } ,
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

    $('#MyModalKursusInfo').on('hidden.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);

        if(xhr) {
            xhr.abort();
        }

        if(openEdit) {
            $('#myModal').modal();
        }
    })

    $('#myModal').on('show.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);
        load_content_modal(modalUrl,postData,vData);
    })

    $('#myModal').on('shown.bs.modal',function(e){
        if(openEdit) {
            initform(programId);
            $(".easyui-combotree").css("width", $( '.col-md-6' ).actual( 'width' )-5);
            $('#comPenganjurLatihan').combotree();
            $('#comPenganjurPemb').combotree();
            $('#comPenganjurPemb2').combotree();
            $('#comPenganjurKend').combotree();
        }
        openEdit = false;
    })

    $('#myModal').on('hidden.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);
    })

    function load_content_modal(url, data, placeholder) {
        $.ajax({
            url: url,
            success: function(data, textStatus, jqXHR){
                placeholder.html(data);
                $(".easyui-combotree").css("width", $( '.col-md-6' ).actual( 'width' )-5);
                $('#comPenganjurLatihan').combotree();
                $('#comPenganjurPemb').combotree();
                $('#comPenganjurPemb2').combotree();
                $('#comPenganjurKend').combotree();

                if(operasi == 'edit') {
                    $('.espel_program').val();
                    initform($('.espel_program').val());
                }
            }
        });
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
                        }).then(function(){
                            populateEvent();
                            $('#myModal').modal('hide');
                            location.reload();
                        });
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
});
</script>