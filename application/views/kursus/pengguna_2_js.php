<script>
(function(){
    var tahun = <?=$this->uri->segment(3, date('Y'))?>;
    var bulan = <?=$this->uri->segment(4, date('m'))?>;
    
    $.ajax({
        url: base_url + "api/get_event_pengguna_2/" + tahun + "/" + bulan,
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

        if(!tkhMula.isBefore(now))
        {
            if(element.stat_laksana == 'R'){
                if(element.stat_mohon){
                    text = text + "<div class=\"event pass\"> \
                        <div class=\"event-desc\">" + owner[0].tajuk + " \
                        </div> \
                        <div class=\"event-time\"> \
                            " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                        </div> \
                    </div>";
                }
                else {
                    text = text + "<div class=\"event\"> \
                        <div class=\"event-desc\"><a href=\"<?=base_url("kursus/info_kursus_pengguna/")?>" + element.id + " \"> " + element.tajuk + "</a>\
                        </div> \
                        <div class=\"event-time\"> \
                            " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                        </div> \
                    </div>";
                }
            }
            else
            {
                text = text + "<div class=\"event pass\"> \
                    <div class=\"event-desc\">" + element.tajuk + " \
                    </div> \
                    <div class=\"event-time\"> \
                        " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                    </div> \
                </div>";
            }   
        }
        else
        {
            text = text + "<div class=\"event pass\"> \
                    <div class=\"event-desc\">" + element.tajuk + " \
                    </div> \
                    <div class=\"event-time\"> \
                        " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                    </div> \
                </div>";
        }
        return text;
    }
})();
</script>
