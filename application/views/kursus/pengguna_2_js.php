<script>
$(function(){
    var tahun = <?=$this->uri->segment(3, date('Y'))?>;
    var bulan = <?=$this->uri->segment(4, date('m'))?>;
    var xhr = {};
    var kursusId = 0;
    var tajuk = '';
    var events = [];

    $.ajax({
        url: base_url + "api/get_event_pengguna_2/" + tahun + "/" + bulan,
        success: function(sen_kursus, textStatus, jqXHR ){
            events = sen_kursus;
            generateEvents(sen_kursus);
        }
    });

    function generateEvents(sen_kursus)
    {
        var events_s = [];
        var events_r = [];
        var events_e = [];

        if(sen_kursus.length != 0){
            for(i = 1; i<=31; i++){
                var tkh_cal = moment(tahun + '-' + bulan + '-' + i.toString().padStart(2,'0'), 'YYYY-MM-DD');
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
        var kodWarna;

        tkhMula = moment(element.tkh_mula, 'YYYY-MM-DD HH:mm:ss');
        tkhTamat = moment(element.tkh_tamat, 'YYYY-MM-DD HH:mm:ss');

        if(!tkhMula.isBefore(now)) {
            //selepas hari ini
            if(element.stat_jabatan == 'Y') {
                if(element.jenis && element.jenis == 'R') {
                    kodWarna = element.jenis.toLowerCase();
                }
                else if(element.jenis && element.jenis == 'S') {
                    kodWarna = element.jenis.toLowerCase();
                }
                else {
                    kodWarna = 'n';
                }
            }
            else {
                kodWarna = element.stat_jabatan.toLowerCase();
            }

            text = text + "<div class=\"event\"> \
            <div class=\"event-desc\" data-kursusid=\"" + element.id + " \" data-tajuk=\"" + element.tajuk + "\"><i class=\"fa fa-square " + kodWarna + "\"></i> <a href=\"#\">" + element.tajuk + "</a>\
            </div> \
            <div class=\"event-time\"> \
                " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
            </div>";

            if(element.stat_hadir == 'M') {
                    text = text + "<div> \
                        <span class=\"label label-warning\">MOHON</span> \
                    </div>";
                }

                if(element.stat_hadir == 'L') {
                    text = text + "<div> \
                        <span class=\"label label-success\">DISAHKAN</span> \
                    </div>";
                }

                if(element.stat_hadir == 'T') {
                    text = text + "<div> \
                        <span class=\"label label-danger\">DITOLAK</span> \
                    </div>";
                }

            text = text + "</div>";
        }
        else
        {
            // sebelum hari ini
            if(element.stat_jabatan == 'Y') {
                if(element.jenis && element.jenis == 'R') {
                    kodWarna = element.jenis.toLowerCase();
                }
                else if(element.jenis && element.jenis == 'S') {
                    kodWarna = element.jenis.toLowerCase();
                }
                else {
                    kodWarna = 'n';
                }
            }
            else {
                kodWarna = element.stat_jabatan.toLowerCase();
            }

            text = text + "<div class=\"event pass\"> \
            <div class=\"event-desc\" data-kursusid=\"" + element.id + " \" data-tajuk=\"" + element.tajuk + "\"><i class=\"fa fa-square " + kodWarna + "\"></i> <a href=\"#\">" + element.tajuk + "</a>\
            </div> \
            <div class=\"event-time\"> \
                " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
            </div>";

            if(element.stat_hadir == 'M') {
                text = text + "<div> \
                    <span class=\"label label-warning\">MOHON</span> \
                </div>";
            }

            if(element.stat_hadir == 'L') {
                text = text + "<div> \
                    <span class=\"label label-success\">DISAHKAN</span> \
                </div>";
            }

            if(element.stat_hadir == 'T') {
                text = text + "<div> \
                    <span class=\"label label-danger\">DITOLAK</span> \
                </div>";
            }
            
             text = text + "</div>";
        }

        return text;
    }

    $('#calendar').on('click','.event-desc', function(e){
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
        
        if(event.stat_jabatan == 'Y') {
            vHeader.css( "background-color", "#0099FF" );
        }

        if(event.stat_jabatan=='T') {
            vHeader.css( "background-color", "#19BC9D" );
        }

        vHeader.css( "color", "black" );
        vTajuk.html(tajuk);
        vData.html(loader);
        //load_content_modal(modalUrl,postData,vData);
    })

    $('#MyModalKursusInfo').on('hidden.bs.modal',function(e){
        var vData = $(this).find(".modal-body");
        vData.html(loader);

        if(xhr)
        {
            xhr.abort();
        }
    })

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
                            location.reload();
                        });
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
                            location.reload();
                        });
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
    // end daftar kursus luar
});
</script>
