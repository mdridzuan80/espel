<script>
(function(){
    var tahun = <?=$this->uri->segment(3, date('Y'))?>;
    var bulan = <?=$this->uri->segment(4, date('m'))?>;
    $.ajax({
        url: base_url + "api/get_event_all/" + tahun + "/" + bulan ,
        success: function(sen_kursus, textStatus, jqXHR ){
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
                var tkh_cal = moment(tahun + '-' + bulan + '-' + i.toString().padStart(2,'0'));
                events_s = sen_kursus.filter(function(kursus){
                    return tkh_cal.isSame(kursus.mula)
                });

                events_r = sen_kursus.filter(function(kursus){
                    return tkh_cal.isBetween(kursus.mula, kursus.tamat)
                });
                events_e = sen_kursus.filter(function(kursus){
                    return tkh_cal.isSame(kursus.tamat)
                });
                
                events_s.forEach(function(element){
                    $("#cell-"+i).parent().append(linkEvent(element));
                });
                events_r.forEach(function(element){
                    $("#cell-"+i).parent().append(linkEvent(element));
                });
                events_e.forEach(function(element){
                    if(element.mula != element.tamat) {
                        $("#cell-"+i).parent().append(linkEvent(element));
                    }
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
    
        if(element.stat_laksana == 'R')
        {
            text = text + "<div class=\"event\"> \
                <div class=\"event-desc\"><a href=\"<?=base_url("kursus/info_jabatan/")?>" + element.id + " \"> " + element.tajuk + "</a>\
                </div> \
                <div class=\"event-time\"> \
                    " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                </div> \
            </div>";
        }
        else
        {
            text = text + "<div class=\"event pass\"> \
            <div class=\"event-desc\"><a href=\"<?=base_url("kursus/info_jabatan/")?>" + element.id + " \"> " + element.tajuk + "</a>\
            </div> \
            <div class=\"event-time\"> \
                " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
            </div> \
        </div>";

        }
        return text;
    }

    function genCell(i){
        return function(data, textStatus, jqXHR ){
            var now = moment();
            var text = "";
            var tkhMula;
            var tkhTamat;

            if(data){
                data.forEach(function(kursus){
                    tkhMula = moment(kursus.tkh_mula);
                    tkhTamat = moment(kursus.tkh_tamat);
                    text = text + "<div class=\"event\"> \
                            <div class=\"event-desc\"><a href=\"<?=base_url("kursus/info_jabatan/")?>" + kursus.id + " \"> " + kursus.tajuk + "</a>\
                            </div> \
                            <div class=\"event-time\"> \
                                " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                            </div> \
                        </div>";
                });
                $("#cell-"+i).parent().append(text);
            }
        }
    }

    $('.btn-hapus-separa').on('click', function(e){
        e.preventDefault();
        var el = this;
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
                        $(el).parent().parent().parent().parent().parent().parent().hide('slow');
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
})();
</script>
