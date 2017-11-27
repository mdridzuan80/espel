<script>
    $(function(){
        $(".easyui-combotree").css("width", $( '.col-md-6' ).actual( 'width' ));
        $('#comPenganjurLatihan').combotree();
        $('#comPenganjurPemb').combotree();
        $('#comPenganjurPemb2').combotree();
        $('#comPenganjurKend').combotree();

        initform($('.espel_program').val());

        function initform(program_id) {
            if(program_id == 1 || program_id == 2){
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
        }

        $('#comAnjuran').on('change', function(e){
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

        $('#comAnjuranPemb').on('change', function(e){
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

        $('#comAnjuranPemb2').on('change', function(e){
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

        $('#comAnjuranKend').on('change', function(e){
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

        $('.frm-edit-separa-kursus').on('submit', function(e){
            e.preventDefault();
            var kursus_id = $(this).attr('data-kursus_id');
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
                        url: base_url + 'kursus/ajax_edit_separa_jabatan/' + kursus_id,
                        success: function(data) {
                            swal({
                                title: 'Berjaya!',
                                text: 'Proses pengemaskinian selesai.',
                                type: 'success'
                            }).then(function(){
                                button_submit.attr("disabled", false);
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
        
        $('.btn-hapus-separa').on('click', function(e){
            e.preventDefault();
            var kursus_id = $(this).attr('data-kursus_id');
            swal({
                title: 'Anda Pasti?',
                text: 'Maklumat ini tidak akan diperolehi semula selepas dihapuskan',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(function () {
                $.ajax({
                    url: base_url + 'kursus/ajax_delete_separa_jabatan/' + kursus_id,
                    success: function() {
                        swal('Berjaya!','','success').then(function(){
                            window.location.href = base_url + 'kursus/separa_takwim';
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
    });
</script>