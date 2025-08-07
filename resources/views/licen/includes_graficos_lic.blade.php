<?php

    $datos_2019=$funciones->rpt_lic19_datos(2019);
    $datos_2024=$funciones->rpt_lic19_datos(2025);



    $labels_grafi=$funciones->rpt_lic19_etiquetas();
    $labels_json = json_encode(explode(',', trim($labels_grafi, '[]')));

?>

<script>

var etiquetas = <?= $labels_json ?>;


$(function() {
    "use strict";
    
   // chart 6
    var ctx = document.getElementById("chart6").getContext('2d');
   
      var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke3.addColorStop(0, '#42e695');
      gradientStroke3.addColorStop(1, '#3bb2b8');

      var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke4.addColorStop(0, ' #FF002A');
      gradientStroke4.addColorStop(0.5, '#FF008A');

      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: etiquetas,
          datasets: [{
            label: 'AÑO 2019',
            data: {{ $datos_2019 }},
            borderColor: gradientStroke4,
            backgroundColor: gradientStroke4,
            hoverBackgroundColor: gradientStroke4,
            pointRadius: 0,
            fill: false,
            borderWidth: 1
          },
          {
            label: 'AÑO 2025',
            data: {{ $datos_2024 }},
            borderColor: gradientStroke3,
            backgroundColor: gradientStroke3,
            hoverBackgroundColor: gradientStroke3,
            pointRadius: 0,
            fill: false,
            borderWidth: 1
          }]
        },
        options:{
      maintainAspectRatio: false,
          legend: {
              position: 'bottom',
              display: true,
              labels: {
                boxWidth:12
              }
            },
            tooltips: {
              displayColors:false,
            },  
          scales: {
              xAxes: [{
                barPercentage: .5
              }],
              yAxes: [{ ticks: { beginAtZero: true } }]
             }
        }


      });



});

</script>
