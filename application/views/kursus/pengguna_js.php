<script>
(function(){
    var tahun = <?=$this->uri->segment(3, date('Y'))?>;
    var bulan = <?=$this->uri->segment(4, date('m'))?>;
    for(var i=1;i<=31;i++)
    {
        $.ajax({
            url: base_url + "api/get_event_pengguna/" + tahun + "/" + bulan + "/" + i ,
            success: genCell(i)
        });
    }

    function genCell(i){
        return function(sen_kursus, textStatus, jqXHR ){
            var now = moment();
            var text = "";
            var tkhMula;
            var tkhTamat;

            if(sen_kursus){
                tkhMula = moment(sen_kursus[0].tkh_mula);
                tkhTamat = moment(sen_kursus[0].tkh_tamat);

                if(!tkhMula.isBefore(now))
                {
                    if(sen_kursus[0].stat_laksana != 'L'){
                        var owner = sen_kursus.filter(function(kursus){
                        if(kursus.nokp == <?=$this->appsess->getSessionData('username')?>){
                                return kursus;
                            }
                        });

                        if(owner.length!=0){
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
                                <div class=\"event-desc\"><a href=\"<?=base_url("kursus/info_kursus_pengguna/")?>" + sen_kursus[0].id + " \"> " + sen_kursus[0].tajuk + "</a>\
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
                            <div class=\"event-desc\">" + sen_kursus[0].tajuk + " \
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
                            <div class=\"event-desc\">" + sen_kursus[0].tajuk + " \
                            </div> \
                            <div class=\"event-time\"> \
                                " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                            </div> \
                        </div>";
                }

                $("#cell-"+i).parent().append(text);
            }
        }
    }
})();
</script>
