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


    // indics
    $indic_sm_doc=$funciones->rpt_lic19_porcent_indic('SM',$anio,'DOCUMENTAL');
    $indic_pm_doc=$funciones->rpt_lic19_porcent_indic('PM',$anio,'DOCUMENTAL');
    $indic_nm_doc=$funciones->rpt_lic19_porcent_indic('NM',$anio,'DOCUMENTAL');
    $indic_nop_doc=$funciones->rpt_lic19_porcent_indic('NOP',$anio,'DOCUMENTAL');

    //$indic_pm_doc=55-($indic_sm_doc + $indic_nm_doc + $indic_nop_doc);



    // mvs
    $mv_sm_doc=$funciones->rpt_lic19_porcent_mv('SM',$anio,'DOCUMENTAL');
    $mv_pm_doc=$funciones->rpt_lic19_porcent_mv('PM',$anio,'DOCUMENTAL');
    $mv_nm_doc=$funciones->rpt_lic19_porcent_mv('NM',$anio,'DOCUMENTAL');

    $mv_nop_doc=$funciones->rpt_lic19_porcent_mv('NOP',$anio,'DOCUMENTAL');






    $por_cbc_nop=$funciones->lic19_por_cbc('NP',$anio);
    $por_cbc_sm=$funciones->lic19_por_cbc('SM',$anio);
    $por_cbc_pm=$funciones->lic19_por_cbc('PM',$anio);
    $por_cbc_nm=$funciones->lic19_por_cbc('NM',$anio);

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



              var options_indic_doc = {
                  series: [{{ $indic_nm_doc }}, {{ $indic_pm_doc }}, {{ $indic_sm_doc }}],
                  chart: {
                      foreColor: '#9ba7b2',
                      height: 250,
                      type: 'donut',
                  },
                  colors: ['#FC2E13','#feb019','#00e396'],
                  labels: ['NO CUMPLIDO', 'EN PROCESO','CUMPLIDO'],
                  responsive: [{
                      breakpoint: 480,
                      options: {
                          chart: {
                              height: 320
                          },
                          legend: {
                              position: 'bottom'
                          }
                      }
                  }]
              };

              var options_mv_doc = {
                  series: [{{ $mv_nm_doc }}, {{ $mv_pm_doc }}, {{ $mv_sm_doc }}],
                  chart: {
                      foreColor: '#9ba7b2',
                      height: 250,
                      type: 'donut',
                  },
                  colors: ['#FC2E13','#feb019','#00e396'],
                  labels: ['No se mantiene', 'Se mantiene parcialmente','Se mantiene'],
                  responsive: [{
                      breakpoint: 480,
                      options: {
                          chart: {
                              height: 320
                          },
                          legend: {
                              position: 'bottom'
                          }
                      }
                  }]
              };









              // por CBC
            var options_cbc = {
                    colors: ['#008ffb', '#00e396', '#feb019', '#ff4560'],
                    series: [
                      {
                        name: 'NO APLICA',
                        data: {{ $por_cbc_nop }}
                      }, 
                      {
                        name: 'CUMPLIDO',
                        data: {{ $por_cbc_sm }}
                      }, 
                      {
                        name: 'EN PROCESO',
                        data: {{ $por_cbc_pm }}
                      }, 
                      {
                        name: 'NO CUMPLIDO',
                        data: {{ $por_cbc_nm }}
                      }
                    ],
                    chart: {
                      type: 'bar',
                      height: 350,
                      stacked: true,
                      toolbar: {
                        show: true
                      },
                    },
                    responsive: [{
                      breakpoint: 480,
                      options: {
                        legend: { position: 'bottom', offsetX: -10, offsetY: 0 }
                      }
                    }],
                    plotOptions: {
                      bar: {
                        horizontal: false,
                        borderRadius: 10,
                        borderRadiusApplication: 'end', // 'around', 'end'
                        borderRadiusWhenStacked: 'last', // 'all', 'last'
                        dataLabels: {
                          total: {
                            enabled: true,
                            style: {
                              fontSize: '13px',
                              fontWeight: 900
                            }
                          }
                        }
                      },
                    },
                    xaxis: {
                      type: 'text',
                      categories: ['CBC I', 'CBC II', 'CBC III', 'CBC IV', 'CBC V', 'CBC VI','CBC VII','CBC VIII'],
                    },
                    legend: { position: 'right', offsetY: 40 },
                    fill: { opacity: 1 }
              };





            setTimeout(() => {

              // a nivel documental
              new ApexCharts(document.querySelector("#chart_general_doc"), options_doc).render();
              new ApexCharts(document.querySelector("#chart_indic_doc"), options_indic_doc).render();
              new ApexCharts(document.querySelector("#chart_mv_doc"), options_mv_doc).render();
              new ApexCharts(document.querySelector("#chart_cbc"), options_cbc).render();
              

            }, "500");

            });

        </script>





    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-9">
                    <h5 style="margin: 0px;">REPORTE DE CUMPLIMIENTO DE LAS CONDICIONES BÁSICAS DE CALIDAD</h5>
                  </div>
                  <div class="col-lg-3" style="text-align: right;">
                      <a href="{{ route('lic_pdf_detallado') }}" target="_blank" class="btn btn-primary btn-rounded waves-effect waves-light">
                        <i class="fas fa-file-alt"></i>  Generar reporte
                      </a>
                  </div>
                </div>
                
              </div>
            </div>
        </div>
    </div>

    <div class="row">

    	<div class="col-md-12">
			<div class="card radius-10 overflow-hidden">
				<div class="card-body">

                  
          <div class="" id="chart_general_doc"></div>
          <br>



          <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#por_cbc" role="tab">
                      <span class="d-block d-sm-none"><i class="fas fa-chart-bar"></i></span>
                      <span class="d-none d-sm-block">POR CBC</span>    
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#por_indic" role="tab">
                      <span class="d-block d-sm-none"><i class="fas fa-chart-area"></i></span>
                      <span class="d-none d-sm-block">POR INDICADOR</span>    
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#por_mv" role="tab">
                      <span class="d-block d-sm-none"><i class="fas fa-chart-line"></i></span>
                      <span class="d-none d-sm-block">POR MV</span>    
                  </a>
              </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content p-3 text-muted">
              <div class="tab-pane active" id="por_cbc" role="tabpanel">
                    <br>
                    <div class="row">
                      <div class="col-lg-2"></div>
                      <div class="col-lg-8">
                        <div class="" id="chart_cbc"></div>
                      </div>
                    </div>
              </div>
              <div class="tab-pane" id="por_indic" role="tabpanel">
                  <div class="p-2 mb-2" style="background-color: #F3FFFC;">
                    <h6 class="m-0" style="text-align: center;">Reporte de cumplimiento - Por indicador</h6>
                  </div>
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="" id="chart_indic_doc"></div>
                    </div>
                    <div class="col-lg-4">
                      <table class="table">
                        <tr>
                          <td><span class="text-muted">No aplica</span></td>
                          <td>{{ $indic_nop_doc }}</td>
                        </tr>
                        <tr>
                          <td> <i class="bx bx-stop" style="color: #FC2E13;"></i> NO CUMPLIDO</td>
                          <td>{{ $indic_nm_doc }}</td>
                        </tr>
                        <tr>
                          <td> <i class="bx bx-stop" style="color: #feb019;"></i> EN PROCESO</td>
                          <td>{{ $indic_pm_doc }}</td>
                        </tr>
                        <tr>
                          <td> <i class="bx bx-stop" style="color: #00e396;"></i> CUMPLIDO</td>
                          <td>{{ $indic_sm_doc }}</td>
                        </tr>
                        <tr>
                          <td>TOTAL</td>
                          <td>{{ $indic_nop_doc + $indic_nm_doc + $indic_pm_doc + $indic_sm_doc }}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
              </div>
              <div class="tab-pane" id="por_mv" role="tabpanel">
                  <div class=" d-flex p-2 mb-2" style="background-color: #F3FFFC;">
                    <div style="width: 50%;">
                      <h6 class="m-0" style="text-align: center;">Reporte de cumplimiento - Por MV</h6>
                    </div>
                    <div style="width: 50%;text-align: right;">
                      
                      <a href="{{ route('lic19_pdf_estado') }}" target="_blank" class="btn btn-warning btn-sm radius-30">
                        Reporte por MV
                      </a>
                      
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-8">
                      <div class="" id="chart_mv_doc"></div>
                    </div>
                    <div class="col-lg-4">
                      <table class="table">
                        <tr>
                          <td><span class="text-muted">No aplica</span></td>
                          <td>{{ $mv_nop_doc }}</td>
                        </tr>
                        <tr>
                          <td> <i class="bx bx-stop" style="color: #FC2E13;"></i> NO CUMPLIDO </td>
                          <td>{{ $mv_nm_doc }}</td>
                        </tr>
                        <tr>
                          <td> <i class="bx bx-stop" style="color: #feb019;"></i> EN PROCESO</td>
                          <td>{{ $mv_pm_doc }}</td>
                        </tr>
                        <tr>
                          <td> <i class="bx bx-stop" style="color: #00e396;"></i> CUMPLIDO</td>
                          <td>{{ $mv_sm_doc }}</td>
                        </tr>
                        <tr>
                          <td>TOTAL</td>
                          <td>{{ $mv_nop_doc + $mv_nm_doc + $mv_pm_doc + $mv_sm_doc }}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
        

          <br><br><br>

				</div>
			</div>
    	</div>
    	
    </div>


@endsection



