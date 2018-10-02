<script>
(function(){
    var xhr = {};
    var tahun = <?=$this->uri->segment(3, date('Y'))?>;
    var bulan = <?=$this->uri->segment(4, date('m'))?>;
    var kursusId = 0;
    var tajuk = '';
    var loader = $('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span>Loading...</span>');
    var jenisDaftar = '';
    var openEdit = false;
    var events = [];

    populateEvent();

    function resetPopulateEvent() {
        $('.event').remove();
    }

    function populateEvent() {
        xhr = $.ajax({
            url: base_url + "api/get_event_all/" + tahun + "/" + bulan,
            success: function(sen_kursus, textStatus, jqXHR ){
                events = sen_kursus;
                generateEvents(filterJenis());
            }
        });
    }

    function generateEvents(sen_kursus)
    {
        var events_s = [];
        var events_r = [];
        var events_e = [];

        if(sen_kursus.length != 0){
            for(i = 1; i<=31; i++){
                var tkh_cal = moment(tahun + '-' + bulan + '-' + i.toString().padStart(2,'0'), "YYYY-MM-DD");
                var concat_e = [];

                events_s = sen_kursus.filter(function(kursus){
                    return tkh_cal.isSame(kursus.mula)
                });

                events_r = sen_kursus.filter(function(kursus){
                    return tkh_cal.isBetween(kursus.mula, kursus.tamat)
                });
                events_e = sen_kursus.filter(function(kursus){
                    return tkh_cal.isSame(kursus.tamat)
                });
                
                concat_e = _.sortBy(_.union(events_s, events_r, events_e), ['masa_m', 'masa_t']);

                concat_e.forEach(function(element){
                    $("#cell-"+i).parent().append(linkEvent(element));
                });
            }
        }
    }

    function linkEvent(element)
    {
        var now = moment();
        var text = "";
        var tkhMula;
        var tkhTamat;

        tkhMula = moment(element.tkh_mula);
        tkhTamat = moment(element.tkh_tamat);             
    
        if(element.stat_laksana == 'R') {
            text = text + "<div class=\"event\"> \
                <div class=\"event-desc\" data-kursus_id=\"" + element.id + "\" data-tajuk=\"" + element.tajuk + "\"> \
                    <i class=\"fa fa-square "+element.jenis.toLowerCase()+"\"></i><a href=\"#\"> " + element.tajuk + "</a>\
                </div> \
                <div class=\"event-time\"> \
                    " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                </div> \
            </div>";
        }
        else {
            text = text + "<div class=\"event pass\"> \
                <div class=\"event-desc\" data-kursus_id=\"" + element.id + "\" data-tajuk=\"" + element.tajuk + "\">\
                    <i class=\"fa fa-square "+element.jenis.toLowerCase()+"\"></i><a href=\"#\"> " + element.tajuk + "</a>\
                </div> \
                <div class=\"event-time\"> \
                    " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                </div> \
            </div>";
        }

        return text;
    }

    $('input.jenis').on('click', function(e) {
        var filterEvents = [];

        $('input.jenis:checked').each(function () {
            filterEvents = _.union(filterEvents, _.filter(events,[$(this).data('medan'),$(this).val().toUpperCase()]));
        });

        resetPopulateEvent();
        generateEvents(filterEvents);
    });

    function filterJenis()
    {
        var filterEvents = [];

        $('input.jenis:checked').each(function () {
            filterEvents = _.union(filterEvents, _.filter(events,[$(this).data('medan'),$(this).val().toUpperCase()]));
        });
        return filterEvents;
    }

    $('#btn-daftar-rancang').on('click', function(e){
        e.preventDefault();
        jenisDaftar = $(this).data('jenis');
        $('#MyModalDaftarKursus').modal();

    });

    $('#btn-daftar-siap').on('click', function(e){
        e.preventDefault();
        jenisDaftar = $(this).data('jenis');
        $('#MyModalDaftarKursus').modal();

    });

    $('#calendar').on('click','.event-desc', function(e){
        e.preventDefault();
        kursus_id = $(this).data('kursus_id');
        tajuk = $(this).data('tajuk');
        $('#MyModalKursusInfo').modal();
    });

    // modal proses
    $('#MyModalDaftarKursus').on('show.bs.modal',function(e){
        var vHeader = $(this).find(".modal-header");
        var vTajuk = $(this).find(".modal-title");
        var vData = $(this).find(".modal-body");
        
        vHeader.css( "color", "black" );
        vData.html(loader);

        if(jenisDaftar=='R') {
            vHeader.css( "background-color", "#c7adf0" );
            vTajuk.html('Daftar Kursus (Rancang)');
            load_content_modal_daftar(base_url + 'kursus/rancang_daftar_jabatan',vData);
        }

        if(jenisDaftar=='S') {
            vHeader.css( "background-color", "#dcb5b5" );
            vTajuk.html('Daftar Kursus (Siap)');
            load_content_modal_daftar(base_url + 'kursus/separa_daftar_jabatan',vData);
        }
    })

    $('#MyModalDaftarKursus').on('hidden.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);

        if(xhr)
        {
            xhr.abort();
        }
    })

    $('#MyModalKursusInfo').on('show.bs.modal',function(e){
        var vHeader = $(this).find(".modal-header");
        var vTajuk = $(this).find(".modal-title");
        var vData = $(this).find(".modal-body");
        var event = _.find(events,['id',kursus_id]);

        if(event.jenis == 'R') {
            vHeader.css( "background-color", "#c7adf0" );
        }

        if(event.jenis == 'S') {
            vHeader.css( "background-color", "#dcb5b5" );
        }

        vHeader.css( "color", "black" );
        vTajuk.html(event.tajuk.toUpperCase());
        vData.html(loader);
        load_content_modal_info({},vData);
    })

    $('#MyModalKursusInfo').on('hidden.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);

        if(xhr) {
            xhr.abort();
        }

        if(openEdit) {
            $('#MyModalKursusEdit').modal();
        }
    })

    function load_content_modal_daftar(url, placeholder){
        xhr = $.ajax({
            url: url,
            success: function(data, textStatus, jqXHR){
                placeholder.html(data);
                /* $(".easyui-combotree").css("width", $( '.col-md-6' ).actual( 'width' )-5);
                $('#comPenganjurLatihan').combotree();
                $('#comPenganjurPemb').combotree();
                $('#comPenganjurPemb2').combotree();
                $('#comPenganjurKend').combotree(); */
            }
        });
    }

    function load_content_modal_info(data,placeholder){
        xhr = $.ajax({
            url: base_url+'kursus/info_kursus_jabatan/'+kursus_id,
            success: function(data, textStatus, jqXHR){
                placeholder.html(data);
            }
        });
    }
    // tamat modal proses

    // form daftar kursus
    var daftarModal = $('#MyModalDaftarKursus');

    daftarModal.on('change', '.espel_program', function(e){
        e.preventDefault();
        var nilai = $(this).val();
        daftarModal.find('.hddProgram').val(nilai);

        initform(nilai);

        daftarModal.find(".easyui-combotree").css("width", $( '.col-md-6' ).actual( 'width' ));
        daftarModal.find('#comPenganjurLatihan').combotree();
        daftarModal.find('#comPenganjurPemb').combotree();
        daftarModal.find('#comPenganjurPemb2').combotree();
        daftarModal.find('#comPenganjurKend').combotree();

    });

    function viewPanelKursus(latihan,pembelajaran1,pembelajaran2,kendiri)
    {
        daftarModal.find('.espel_latihan').hide();
        daftarModal.find('.espel_pembelajaran1').hide();
        daftarModal.find('.espel_pembelajaran2').hide();
        daftarModal.find('.espel_kendiri').hide();

        if(latihan)
            daftarModal.find('.espel_latihan').show();

        if(pembelajaran1)
            daftarModal.find('.espel_pembelajaran1').show();

        if(pembelajaran2)
            daftarModal.find('.espel_pembelajaran2').show();

        if(kendiri)
            daftarModal.find('.espel_kendiri').show();
    }

    function initform(program_id) {
        if(program_id == 1 || program_id == 2){
            viewPanelKursus(true,false,false,false);
            daftarModal.find("#txtTkhMula").datetimepicker({
                format: "DD-MM-YYYY"
            });
            daftarModal.find("#txtTkhTamat").datetimepicker({
                format: "DD-MM-YYYY"
            });
            daftarModal.find("#txtTkhMula").on("dp.hide", function (e) {
                $('#txtTkhTamat').data("DateTimePicker").minDate(e.date);
            });
            daftarModal.find("#txtTkhTamat").on("dp.hide", function (e) {
                $('#txtTkhMula').data("DateTimePicker").maxDate(e.date);
            });

            var masaMula = daftarModal.find('#txtMasaMula').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });

            var masaTamat = daftarModal.find('#txtMasaTamat').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });
        }

        if(program_id == 3){
            viewPanelKursus(false,true,false,false);
            daftarModal.find("#txtTkhMulaPemb").datetimepicker({
                format: "DD-MM-YYYY"
            });
            daftarModal.find("#txtTkhTamatPemb").datetimepicker({
                format: "DD-MM-YYYY"
            });
            daftarModal.find("#txtTkhMulaPemb").on("dp.hide", function (e) {
                daftarModal.find('#txtTkhTamatPemb').data("DateTimePicker").minDate(e.date);
            });
            daftarModal.find("#txtTkhTamatPemb").on("dp.hide", function (e) {
                daftarModal.find('#txtTkhMulaPemb').data("DateTimePicker").maxDate(e.date);
            });

            var masaMula = daftarModal.find('#txtMasaMulaPemb').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });

            var masaTamat = daftarModal.find('#txtMasaTamatPemb').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });
        }

        if(program_id == 4){
            viewPanelKursus(false,false,true,false);
            daftarModal.find("#txtTkhMulaPemb2").datetimepicker({
                format: "DD-MM-YYYY"
            });
            daftarModal.find("#txtTkhTamatPemb2").datetimepicker({
                format: "DD-MM-YYYY"
            });
            daftarModal.find("#txtTkhMulaPemb2").on("dp.hide", function (e) {
                daftarModal.find('#txtTkhTamatPemb2').data("DateTimePicker").minDate(e.date);
            });
            daftarModal.find("#txtTkhTamatPemb2").on("dp.hide", function (e) {
                daftarModal.find('#txtTkhMulaPemb2').data("DateTimePicker").maxDate(e.date);
            });

            var masaMula = daftarModal.find('#txtMasaMulaPemb2').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });

            var masaTamat = daftarModal.find('#txtMasaTamatPemb2').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });
        }
        if(program_id == 5){
            viewPanelKursus(false,false,false,true);
            daftarModal.find("#txtTkhMulaKend").datetimepicker({
                format: "DD-MM-YYYY"
            });
            daftarModal.find("#txtTkhTamatKend").datetimepicker({
                format: "DD-MM-YYYY"
            });
            daftarModal.find("#txtTkhMulaKend").on("dp.hide", function (e) {
                daftarModal.find('#txtTkhTamatKend').data("DateTimePicker").minDate(e.date);
            });
            daftarModal.find("#txtTkhTamatKend").on("dp.hide", function (e) {
                daftarModal.find('#txtTkhMulaKend').data("DateTimePicker").maxDate(e.date);
            });

            var masaMula = daftarModal.find('#txtMasaMulaKend').timepicker({
                template: false,
                minuteStep: 15,
                showInputs: false,
                disableFocus: true,
                defaultTime: false
            });

            var masaTamat = daftarModal.find('#txtMasaTamatKend').timepicker({
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

    daftarModal.on('change', '#comAnjuran', function(e){
        if($(this).val() == 'L')
        {
            daftarModal.find("#input-txt-penganjur").show();
            daftarModal.find("#txtPenganjurLatihan").prop('required',true);
            daftarModal.find("#input-com-penganjur").hide();
            daftarModal.find("#comPenganjurLatihan").prop('required',false);
        }

        if($(this).val() == 'D')
        {
            daftarModal.find("#input-txt-penganjur").hide();
            daftarModal.find("#txtPenganjurLatihan").prop('required',false);
            daftarModal.find("#input-com-penganjur").show();
            daftarModal.find("#comPenganjurLatihan").prop('required',true);
        }
    });

    daftarModal.on('change', '#comAnjuranPemb', function(e){
        if($(this).val() == 'L')
        {
            daftarModal.find("#input-txt-penganjur-pemb").show();
            daftarModal.find("#txtPenganjurPemb").prop('required',true);
            daftarModal.find("#input-com-penganjur-pemb").hide();
            daftarModal.find("#comPenganjurPemb").prop('required',false);
        }

        if($(this).val() == 'D')
        {
            daftarModal.find("#input-txt-penganjur-pemb").hide();
            daftarModal.find("#txtPenganjurPemb").prop('required',false);
            daftarModal.find("#input-com-penganjur-pemb").show();
            daftarModal.find("#comPenganjurPemb").prop('required',true);
        }
    });

    daftarModal.on('change', '#comAnjuranPemb2', function(e){
        if($(this).val() == 'L')
        {
            daftarModal.find("#input-txt-penganjur-pemb2").show();
            daftarModal.find("#txtPenganjurPemb2").prop('required',true);
            daftarModal.find("#input-com-penganjur-pemb2").hide();
            daftarModal.find("#comPenganjurPemb2").prop('required',false);
        }

        if($(this).val() == 'D')
        {
            daftarModal.find("#input-txt-penganjur-pemb2").hide();
            daftarModal.find("#txtPenganjurPemb2").prop('required',false);
            daftarModal.find("#input-com-penganjur-pemb2").show();
            daftarModal.find("#comPenganjurPemb2").prop('required',true);
        }
    });

    daftarModal.on('change', '#comAnjuranKend', function(e){
        if($(this).val() == 'L')
        {
            daftarModal.find("#input-txt-penganjur-kend").show();
            daftarModal.find("#txtPenganjurKend").prop('required',true);
            daftarModal.find("#input-com-penganjur-kend").hide();
            daftarModal.find("#comPenganjurKend").prop('required',false);
        }

        if($(this).val() == 'D')
        {
            daftarModal.find("#input-txt-penganjur-kend").hide();
            daftarModal.find("#txtPenganjurKend").prop('required',false);
            daftarModal.find("#input-com-penganjur-kend").show();
            daftarModal.find("#comPenganjurKend").prop('required',true);
        }
    });

    daftarModal.on('submit', '#frm-program-latihan', function(e){
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
                formData.append('jenis', jenisDaftar);
                $.ajax({
                    method: 'post',
                    data: formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    url: base_url + 'kursus/ajax_separa_daftar_jabatan_simpan',
                    success: function(data) {
                        swal({
                            title: 'Berjaya!',
                            text: 'Proses mendaftar kursus selesai.',
                            type: 'success'
                        }).then(function() {
                            window.location.href=base_url + 'kursus/info_jabatan/' + data.kursus_id;
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
    
    daftarModal.on('submit', '#frm-pembelajaran-bersemuka', function(e){
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
                formData.append('jenis', jenisDaftar);
                
                $.ajax({
                    method: 'post',
                    data: formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    url: base_url + 'kursus/ajax_separa_daftar_jabatan_simpan',
                    success: function(data) {
                        swal({
                            title: 'Berjaya!',
                            text: 'Proses mendaftar kursus selesai.',
                            type: 'success'
                        }).then(function(){
                            window.location.href=base_url + 'kursus/info_jabatan/' + data.kursus_id;
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

    daftarModal.on('submit', '#frm-pembelajaran-tidak-bersemuka', function(e){
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
                formData.append('jenis', jenisDaftar);
                $.ajax({
                    method: 'post',
                    data: formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    url: base_url + 'kursus/ajax_separa_daftar_jabatan_simpan',
                    success: function(data) {
                        swal({
                            title: 'Berjaya!',
                            text: 'Proses mendaftar kursus selesai.',
                            type: 'success'
                        }).then(function(){
                            window.location.href=base_url + 'kursus/info_jabatan/' + data.kursus_id;
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

    daftarModal.on('submit', '#frm-kendiri', function(e){
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
                formData.append('jenis', jenisDaftar);
                $.ajax({
                    method: 'post',
                    data: formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    url: base_url + 'kursus/ajax_separa_daftar_jabatan_simpan',
                    success: function(data) {
                        swal({
                            title: 'Berjaya!',
                            text: 'Proses mendaftar kursus selesai.',
                            type: 'success'
                        }).then(function(){
                            window.location.href=base_url + 'kursus/info_jabatan/' + data.kursus_id;
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

    $('#MyModalKursusInfo').on('click', '#btn-urus', function(e){
        e.preventDefault();
        var kursus_id = $(this).data('kursusid');
        window.location.href=base_url + 'kursus/info_jabatan/' + kursus_id;
    });

    $('#MyModalKursusInfo').on('click', '#btn-edit', function(e){
        e.preventDefault();
        var kursus_id = $(this).data('kursusid');
        var edit = $('#MyModalKursusEdit');
        var vHeader = edit.find(".modal-header");
        var vTajuk = edit.find(".modal-title");
        var vData = edit.find(".modal-body");
        var event = _.find(events,['id',kursus_id]);

        programId = $(this).data('programid');
        openEdit = true;
        modalHeader = 'Kemaskini Daftar Kursus Anjuran Luar';

        if(event.jenis == 'R') {
            vHeader.css( "background-color", "#c7adf0" );
        }

        if(event.jenis == 'S') {
            vHeader.css( "background-color", "#dcb5b5" );
        }

        vHeader.css( "color", "black" );
        vTajuk.html(event.tajuk.toUpperCase());
        //modalUrl = base_url + 'kursus/edit_luar/' + kursus_id;
        $('#MyModalKursusInfo').modal('hide');        
    });

    $('#MyModalKursusInfo').on('click', '#btn-hapus', function(e) {
        e.preventDefault();
        var kursus_id = $(this).data('kursusid');

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
        }, () => {});
    });       
})();
</script>
