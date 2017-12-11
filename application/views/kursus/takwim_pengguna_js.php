<script>
$(function(){
    var tahun = <?=$this->uri->segment(3, date('Y'))?>;
    var bulan = <?=$this->uri->segment(4, date('m'))?>;
    var xhr = {};
    var kursusId = 0;
    var tajuk = '';
    var events = [];
    var openEdit = false;

    populateEvent();

    function populateEvent() {
        xhr = $.ajax({
            url: base_url + "api/get_sen_event_pengguna_2/" + tahun + "/" + bulan,
            success: function(sen_kursus, textStatus, jqXHR ){
                events = sen_kursus;
                generateEvents(filterJenis());
            }
        });
    }

    function generateEvents(events) {
        $('#senarai-event').dataTable({
            destroy: true,
            data: events,
            "order": [[ 1, 'asc' ]],
            columns: [
                {  
                    orderable: false,
                    data: function(row, type, set, meta){
                    var kodWarna = '';

                    if(row.stat_jabatan == 'Y') {
                        if(row.jenis && row.jenis == 'R') {
                            kodWarna = row.jenis.toLowerCase();
                        }
                        else if(row.jenis && row.jenis == 'S') {
                            kodWarna = row.jenis.toLowerCase();
                        }
                        else {
                            kodWarna = 'n';
                        }
                    }
                    else {
                        kodWarna = row.stat_jabatan.toLowerCase();
                    }

                    return "<i class=\"fa fa-square " + kodWarna + "\"></i> <b>"+row.tajuk.toUpperCase() + "</b><br><small>"+row.program.toUpperCase()+"</small>";
                }},
                { data: function(row, type, set, meta){
                    tkhMula = moment(row.tkh_mula, 'YYYY-MM-DD HH:mm:ss');
                    return tkhMula.format('D MMM YYYY h:mm A');
                }},
                { data: function(row, type, set, meta){
                    tkhTamat = moment(row.tkh_tamat, 'YYYY-MM-DD HH:mm:ss');
                    return tkhTamat.format('D MMM YYYY h:mm A');
                }},
                { 
                    orderable: false,
                    data: function(row, type, set, meta){
                    return "<button data-kursusid=\""+row.id+"\" data-tajuk=\""+row.tajuk+"\" class=\"btn btn-primary btn-xs cmdinfo\" role=\"button\"><i class=\"fa fa-info\"></i> Papar</button>";
                }},
            ]
        });
    }

    function filterJenis()
    {
        var filterEvents = [];

        $('input.jenis:checked').each(function () {
            filterEvents = _.union(filterEvents, _.filter(events,[$(this).data('medan'),$(this).val().toUpperCase()]));
        });
        return filterEvents;
    }

     $('#senarai-event').on('click','.cmdinfo', function(e){
        e.preventDefault();
        kursusId = $(this).data('kursusid');
        tajuk = $(this).data('tajuk');
        $('#MyModalKursusInfo').modal();
    });

    $('input.jenis').on('click', function(e) {
        var filterEvents = [];

        $('input.jenis:checked').each(function () {
            filterEvents = _.union(filterEvents, _.filter(events,[$(this).data('medan'),$(this).val().toUpperCase()]));
        });

        generateEvents(filterEvents);
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
        load_content_modal(modalUrl,postData,vData);
    })

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
                    swal('Berjaya!','','success');
                    resetPopulateEvent();
                    populateEvent();
                    $('#MyModalKursusInfo').modal('hide');
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

    // daftar kursus luar
    var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    var url = '';
    var modalHeader = '';
    var modalUrl = '';
    var postData = {};
    var operasi = '';
        
    // modal proses
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

    function load_content_modal(url,data,placeholder){
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
    // tamat modal proses

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

    $('#linkDaftarKursus').on('click', function(e){
        e.preventDefault();
        operasi = 'add';
        modalHeader = 'Daftar Kursus Anjuran Luar';
        modalUrl = base_url + 'kursus/daftar_luar';
        $('#myLargeModalLabel').html(modalHeader);
        $('#myModal').modal();
    });

    $('#senKursusLuar').on('click','.cmdEditKursusLuar',function(e){
        e.preventDefault();
        var kursus_id = $(this).attr('data-kursusid');
        operasi = 'edit';

        modalHeader = 'Kemaskini Daftar Kursus Anjuran Luar';
        modalUrl = base_url + 'kursus/edit_luar/' + kursus_id;
        $('#myLargeModalLabel').html(modalHeader);
        $('#myModal').modal();
    });

    $('#senKursusLuar').on('click','.cmdHapusKursusLuar',function(e){
        e.preventDefault();
        var kursus_id = $(this).attr('data-kursusid');
        var el = $(this);
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
                    swal('Berjaya!','','success');
                    el.parent().parent().remove();
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

    $('#myModal').on('change','.espel_program', function(e){
        e.preventDefault();
        var nilai = $(this).val();
        $('.hddProgram').val(nilai);

        initform(nilai);
    });

    $('#myModal').on('change','#comAnjuran', function(e){
        console.log($(this).val());
        if($(this).val() == 'L')
        {
            $("#input-txt-penganjur").show();
            $("#txtPenganjurLatihan").prop('required',true);
            $("#input-com-penganjur").hide();
            $("#comPenganjurLatihan").prop('required',false);
        }

        if($(this).val() == 'D')
        {
            $("#input-txt-penganjur").hide();
            $("#txtPenganjurLatihan").prop('required',false);
            $("#input-com-penganjur").show();
            $("#comPenganjurLatihan").prop('required',true);
        }
    });

    $('#myModal').on('change','#comAnjuranPemb', function(e){
        console.log($(this).val());
        if($(this).val() == 'L')
        {
            $("#input-txt-penganjur-pemb").show();
            $("#txtPenganjurPemb").prop('required',true);
            $("#input-com-penganjur-pemb").hide();
            $("#comPenganjurPemb").prop('required',false);
        }

        if($(this).val() == 'D')
        {
            $("#input-txt-penganjur-pemb").hide();
            $("#txtPenganjurPemb").prop('required',false);
            $("#input-com-penganjur-pemb").show();
            $("#comPenganjurPemb").prop('required',true);
        }
    });

    $('#myModal').on('change','#comAnjuranPemb2', function(e){
        console.log($(this).val());
        if($(this).val() == 'L')
        {
            $("#input-txt-penganjur-pemb2").show();
            $("#txtPenganjurPemb2").prop('required',true);
            $("#input-com-penganjur-pemb2").hide();
            $("#comPenganjurPemb2").prop('required',false);
        }

        if($(this).val() == 'D')
        {
            $("#input-txt-penganjur-pemb2").hide();
            $("#txtPenganjurPemb2").prop('required',false);
            $("#input-com-penganjur-pemb2").show();
            $("#comPenganjurPemb2").prop('required',true);
        }
    });

    $('#myModal').on('change','#comAnjuranKend', function(e){
        console.log($(this).val());
        if($(this).val() == 'L')
        {
            $("#input-txt-penganjur-kend").show();
            $("#txtPenganjurKend").prop('required',true);
            $("#input-com-penganjur-kend").hide();
            $("#comPenganjurKend").prop('required',false);
        }

        if($(this).val() == 'D')
        {
            $("#input-txt-penganjur-kend").hide();
            $("#txtPenganjurKend").prop('required',false);
            $("#input-com-penganjur-kend").show();
            $("#comPenganjurKend").prop('required',true);
        }
    });

    $('#myModal').on('submit','.frm-daftar-kursus',function(e){
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
                    url: base_url + 'kursus/ajax_do_daftar_luar',
                    success: function() {
                        swal({
                            title: 'Berjaya!',
                            text: 'Proses mendaftar kursus selesai.',
                            type: 'success'
                        }).then(function(){
                            populateEvent();
                            $('#myModal').modal('hide');
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
    // end daftar kursus luar
});
</script>