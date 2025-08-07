@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.header')

@section('contenido')

<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>


  <?php
    
      $anio=2025;

      $labels_grafi=$funciones->rpt_lic19_etiquetas();
      $labels_json = json_encode(explode(',', trim($labels_grafi, '[]')));


      // reportes a documental
      $data_sm_doc=$funciones->rpt_lic19_datos_estado('SM',$anio,'DOCUMENTAL');
      $data_pm_doc=$funciones->rpt_lic19_datos_estado('PM',$anio,'DOCUMENTAL');
      $data_nm_doc=$funciones->rpt_lic19_datos_estado('NM',$anio,'DOCUMENTAL');
      $data_np_doc=$funciones->rpt_lic19_datos_estado('NP',$anio,'DOCUMENTAL');

  ?>


        <script>


            var etiquetas = <?= $labels_json ?>;
            

            $(function(){
            "use strict";

              // Graficos documental

                var options_doc = {
                  series: [{
                  name: 'No Aplica',
                  data: {{ $data_np_doc }}
                },{
                  name: 'NO CUMPLIDO',
                  data: {{ $data_nm_doc }}
                }, {
                  name: 'EN PROCESO',
                  data: {{ $data_pm_doc }}
                }, {
                  name: 'CUMPLIDO',
                  data: {{ $data_sm_doc }}
                }],
                  chart: {
                  type: 'bar',
                  height: 300
                },
                plotOptions: {
                  bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                  },
                },
                dataLabels: { enabled: false },
                stroke: {
                  show: true,
                  width: 2,
                  colors: ['transparent']
                },
                xaxis: {
                  categories: etiquetas,
                },
                yaxis: { title: { text: 'ESTADO'} },
                fill: { opacity: 1 },
                tooltip: {
                  y: { formatter: function (val) { return "" } }
                },
                colors: ['#008ffb','#FC2E13','#feb019','#00e396']
                };

            setTimeout(() => {

              // a nivel documental
              new ApexCharts(document.querySelector("#chart_general_doc"), options_doc).render();
              

            }, "500");

            });

        </script>




    <div class="row">

        <div class="col-md-12">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                  
                  <div class="text-center">
                    <img src="{{ asset('img/banner_unaaa.png') }}" class="mb-3" style="width: 150px;">
                    <h6>REPORTE DE CUMPLIMIENTO DE LAS CONDICIONES BÁSICAS DE CALIDAD</h6>
                  </div>
                  
                  <div class="" id="chart_general_doc"></div>
                  <br><br>

                </div>
            </div>
        </div>
        
    </div>


@endsection



