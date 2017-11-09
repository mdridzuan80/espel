$(document).ready(function() {
    (function(){
        $("#txtTkhMula").datetimepicker({
            format: "DD-MM-YYYY h:mm A"
        });
        $("#txtTkhTamat").datetimepicker({
            format: "DD-MM-YYYY h:mm A"
        });
        $("#txtTkhMula").on("dp.hide", function (e) {
            $('#txtTkhTamat').data("DateTimePicker").minDate(e.date);
        });
        $("#txtTkhTamat").on("dp.hide", function (e) {
            $('#txtTkhMula').data("DateTimePicker").maxDate(e.date);
        });
    })();

    (function(){
        $("#txtTkhMulaPemb").datetimepicker({
            format: "DD-MM-YYYY h:mm A"
        });
        $("#txtTkhTamatPemb").datetimepicker({
            format: "DD-MM-YYYY h:mm A"
        });
        $("#txtTkhMulaPemb").on("dp.hide", function (e) {
            $('#txtTkhTamatPemb').data("DateTimePicker").minDate(e.date);
        });
        $("#txtTkhTamatPemb").on("dp.hide", function (e) {
            $('#txtTkhMulaPemb').data("DateTimePicker").maxDate(e.date);
        });
    })();

    (function(){
        $("#txtTkhMulaPemb2").datetimepicker({
            format: "DD-MM-YYYY h:mm A"
        });
        $("#txtTkhTamatPemb2").datetimepicker({
            format: "DD-MM-YYYY h:mm A"
        });
        $("#txtTkhMulaPemb2").on("dp.hide", function (e) {
            $('#txtTkhTamatPemb2').data("DateTimePicker").minDate(e.date);
        });
        $("#txtTkhTamatPemb").on("dp.hide", function (e) {
            $('#txtTkhMulaPemb2').data("DateTimePicker").maxDate(e.date);
        });
    })();

    (function(){
        $("#txtTkhMulaKend").datetimepicker({
            format: "DD-MM-YYYY h:mm A"
        });
        $("#txtTkhTamatKend").datetimepicker({
            format: "DD-MM-YYYY h:mm A"
        });
        $("#txtTkhMulaKend").on("dp.hide", function (e) {
            $('#txtTkhTamatKend').data("DateTimePicker").minDate(e.date);
        });
        $("#txtTkhTamatKend").on("dp.hide", function (e) {
            $('#txtTkhMulaKend').data("DateTimePicker").maxDate(e.date);
        });
    })();

    (function(){
        $("#txtTkhLO").datetimepicker({
            format: "DD-MM-YYYY"
        });
        $("#txtTkhResit").datetimepicker({
            format: "DD-MM-YYYY"
        });
    })();

    $('.espel_program').change(function(e){
        e.preventDefault();
        var nilai = $(this).val();
        $('.hddProgram').val(nilai);

        if(nilai == 1 || nilai == 2){
            viewPanelKursus(true,false,false,false);
        }
        if(nilai == 3){
            viewPanelKursus(false,true,false,false);
        }
        if(nilai == 4){
            viewPanelKursus(false,false,true,false);
        }
        if(nilai == 5){
            viewPanelKursus(false,false,false,true);
        }
        if (nilai == 0) {
            viewPanelKursus(false, false, false, false);
        }
    });

    $("#cmdHadir").click(function(e){
        e.preventDefault();
        var data = { 'chkKehadiran[]' : [], 'hadir': 'L', 'submit':''};
        $(".chkKursusLuar:checked").each(function() {
          data['chkKehadiran[]'].push($(this).val());
        });

        $.ajax({
            data:data,
            method:'post',
            url: $(location).attr('href'),
            success: function(){
                location.reload(true);
            },
            error: function(jqXHR,textStatus,errorThrown){
                alert(errorThrown);
            }
        });
    });

    $("#cmdTidahHadir").click(function (e) {
        e.preventDefault();
        var data = { 'chkKehadiran[]': [], 'hadir': 'T', 'submit': '' };
        $(".chkKursusLuar:checked").each(function () {
            data['chkKehadiran[]'].push($(this).val());
        });

        $.ajax({
            data: data,
            method: 'post',
            url: $(location).attr('href'),
            success: function () {
                location.reload(true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

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

    $('#chkAll').click(function () {
     $('input:checkbox').prop('checked', this.checked);
 });

 (function(){
     $("#comAnjuran").change(function(e){
         console.log($(this).val());
        if($(this).val() == 'L')
        {
            $("#input-txt-penganjur").show();
            $("#input-com-penganjur").hide();
        }

        if($(this).val() == 'D')
        {
            $("#input-txt-penganjur").hide();
            $("#input-com-penganjur").show();
        }
     });
 })();

 (function(){
     $("#comAnjuranPemb").change(function(e){
         console.log($(this).val());
        if($(this).val() == 'L')
        {
            $("#input-txt-penganjur-pemb").show();
            $("#input-com-penganjur-pemb").hide();
        }

        if($(this).val() == 'D')
        {
            $("#input-txt-penganjur-pemb").hide();
            $("#input-com-penganjur-pemb").show();
        }
     });
 })();

 (function () {
     $("#comAnjuranPemb2").change(function (e) {
         console.log($(this).val());
         if ($(this).val() == 'L') {
             $("#input-txt-penganjur-pemb2").show();
             $("#input-com-penganjur-pemb2").hide();
         }

         if ($(this).val() == 'D') {
             $("#input-txt-penganjur-pemb2").hide();
             $("#input-com-penganjur-pemb2").show();
         }
     });
 })();

 (function(){
     $("#comAnjuranKend").change(function(e){
         console.log($(this).val());
        if($(this).val() == 'L')
        {
            $("#input-txt-penganjur-kend").show();
            $("#input-com-penganjur-kend").hide();
        }

        if($(this).val() == 'D')
        {
            $("#input-txt-penganjur-kend").hide();
            $("#input-com-penganjur-kend").show();
        }
     });
 })();

 (function (){
     var current = new Date();
     var dateObj = {
         placeholder: $('#sen_permohonan_ph'),
         tahun: current.getFullYear(),
         bulan: current.getMonth()+1
     };
     getPermohonanKursus(dateObj);

     $('#cmdTapis').click(function(e){
        e.preventDefault();
        dateObj.tahun = $('#comTahun').val();
        dateObj.bulan = $('#comBulan').val();
        getPermohonanKursus(dateObj);
     });

     function getPermohonanKursus(obj) {
         $.ajax({
             url: base_url + 'kursus/ajax_senarai_permohonan',
             data: { tahun: obj.tahun, bulan: obj.bulan },
             method: 'POST',
             success: function (data, textStatus, jqXHR) {
                 obj.placeholder.html(data);
             }
         });
     }
 })();
});
