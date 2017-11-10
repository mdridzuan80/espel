<script>
$(function(){
    
    $.ajax({
        url: base_url + 'api/analisa_reaksi',
        beforeSend: function(jqXHR, settings){
            $("body").css("cursor", "progress");
        },
        success: function(data, textStatus, jqXHR){
            barchart_reaksi(data);
        },
        complete: function(jqXHR,textStatus){
            $("body").css("cursor", "default");
        }
    });

    $.ajax({
        url: base_url + 'api/analisa_pembelajaran',
        beforeSend: function(jqXHR, settings){
            $("body").css("cursor", "progress");
        },
        success: function(data, textStatus, jqXHR){
            barchart_pembelajaran(data);
        },
        complete: function(jqXHR,textStatus){
            $("body").css("cursor", "default");
        }
    });

    function barchart_reaksi(datasource){
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx,{
            type: "bar",
            data: {
                labels: ['Pencapaian Objektif Kursus', 'Kesesuaian tempoh masa', 'Bilik kuliah / Dewan', 'Nota/Handout', 'Teknik penyampaian penceramah', 'Kaedah kursus', 'Kandungan kursus', 'Urusetia kursus'],
                datasets: [{
                    label: "Tidak Memuaskan",
                    backgroundColor: "#eabd5d",
                    data: [datasource['b1-1'], datasource['b2-1'], datasource['b3-1'], datasource['b4-1'], datasource['b5-1'], datasource['b6-1'], datasource['b7-1'], datasource['b8-1']]
                }, {
                    label: "Memuaskan",
                    backgroundColor: "#ac557a",
                    data: [datasource['b1-2'], datasource['b2-2'], datasource['b3-2'], datasource['b4-2'], datasource['b5-2'], datasource['b6-2'], datasource['b7-2'], datasource['b8-2']]
                }, {
                    label: "Baik",
                    backgroundColor: "#ac557a",
                    data: [datasource['b1-3'], datasource['b2-3'], datasource['b3-3'], datasource['b4-3'], datasource['b5-3'], datasource['b6-3'], datasource['b7-3'], datasource['b8-3']]
                }, {
                    label: "Cemerlang",
                    backgroundColor: "#8d4c7d",
                    data: [datasource['b1-4'], datasource['b2-4'], datasource['b3-4'], datasource['b4-4'], datasource['b5-4'], datasource['b6-4'], datasource['b7-4'], datasource['b8-4']]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        })
    }

    function barchart_pembelajaran(datasource){
        var ctx = document.getElementById('myChart2').getContext('2d');
        new Chart(ctx,{
            type: "bar",
            data: {
                labels: ['Kursus ini memberi pengetahuan baru', 'Kursus ini meningkatkan pengetahuan berkaitan dengan tugas', 'Kursus ini memberi faedah dan membantu dalam melaksanakan tugas', 'Pengetahuan di dalam kursus ini meningkatkan kualiti kerja'],
                datasets: [{
                    label: "Tidak Memuaskan",
                    backgroundColor: "#eabd5d",
                    data: [datasource['c1-1'], datasource['c2-1'], datasource['c3-1'], datasource['c4-1']]
                }, {
                    label: "Memuaskan",
                    backgroundColor: "#ac557a",
                    data: [datasource['c1-2'], datasource['c2-2'], datasource['c3-2'], datasource['c4-2']]
                }, {
                    label: "Baik",
                    backgroundColor: "#ac557a",
                    data: [datasource['c1-3'], datasource['c2-3'], datasource['c3-3'], datasource['c4-3']]
                }, {
                    label: "Cemerlang",
                    backgroundColor: "#8d4c7d",
                    data: [datasource['c1-4'], datasource['c2-4'], datasource['c3-4'], datasource['c4-4']]
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        })

        var ctx2 = document.getElementById('myChart3').getContext('2d');
        new Chart(ctx2,{
            type: "bar",
            data: {
                labels: ['Kursus ini memberi kemahiran yang relevan dengan tugas', 'Kemahiran yang diperolehi dapat meningkatkan keupayaan diri dalam melaksanakan tugas', 'Kemahiran yang diperolehi di dalam kursus ini boleh meningkatkan kualiti tugas', 'Kemahiran yang diperolehi di dalam kursus ini boleh menyumbangkan kepada pencapaian organisasi'],
                datasets: [{
                    label: "Tidak Memuaskan",
                    backgroundColor: "#eabd5d",
                    data: [datasource['c5-1'], datasource['c6-1'], datasource['c7-1'], datasource['c8-1']]
                }, {
                    label: "Memuaskan",
                    backgroundColor: "#ac557a",
                    data: [datasource['c5-2'], datasource['c6-2'], datasource['c7-2'], datasource['c8-2']]
                }, {
                    label: "Baik",
                    backgroundColor: "#ac557a",
                    data: [datasource['c5-3'], datasource['c6-3'], datasource['c7-3'], datasource['c8-3']]
                }, {
                    label: "Cemerlang",
                    backgroundColor: "#8d4c7d",
                    data: [datasource['c5-4'], datasource['c6-4'], datasource['c7-4'], datasource['c8-4']]
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        })

        var ctx3 = document.getElementById('myChart4').getContext('2d');
        new Chart(ctx3,{
            type: "bar",
            data: {
                labels: ['Pembelajaran di dalam kursus membuka minda positif','Kursus ini membantu diri menjadi lebih peka dan produktif','Kursus ini mendorong untuk bekerja dengan lebih cekap','	Kursus ini meningkatkan komitmen kepada organisasi'],
                datasets: [{
                    label: "Tidak Memuaskan",
                    backgroundColor: "#eabd5d",
                    data: [datasource['c9-1'], datasource['c10-1'], datasource['c11-1'], datasource['c12-1']]
                }, {
                    label: "Memuaskan",
                    backgroundColor: "#ac557a",
                    data: [datasource['c9-2'], datasource['c10-2'], datasource['c11-2'], datasource['c12-2']]
                }, {
                    label: "Baik",
                    backgroundColor: "#ac557a",
                    data: [datasource['c9-3'], datasource['c10-3'], datasource['c11-3'], datasource['c12-3']]
                }, {
                    label: "Cemerlang",
                    backgroundColor: "#8d4c7d",
                    data: [datasource['c9-4'], datasource['c10-4'], datasource['c11-4'], datasource['c12-4']]
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        })
    }
});
</script>