


<div class="modal fade" id="mdl_mvs" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Consideraciones - <span class="text-primary" id="lbl_indic"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" enctype="multipart/form-data" id="frm_mvs">
                @csrf
            <div class="modal-body">

                <input type="hidden" name="id_indic_mv" id="id_indic_mv">

                <div class="row justify-content-center mb-3">
                    <div class="col-md-10">
                    	<label for="" class="form-label">Descripción:</label>
                        <div class="editor-wrapper">
                            <textarea id="text_mvs" name="text_mvs"></textarea> 
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mb-3">
                    <div class="col-lg-11">
                        <div class="d-flex" style="justify-content: right;">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin-right: 10px;" id="btn_close_mv">
                                <i class="bx bx-x"></i> Cerrar
                            </button>

                            @if(Auth::user()->rol==1)
                            <button class="btn btn-primary" type="button" id="btn_guardar_mv" onclick="guardar_mv()">
                                <i class="bx bx-check"></i> Guardar
                            </button>
                            @endif

                        </div>                        
                    </div>
                </div>

            </div>
            </form>
        </div>
    </div>
</div>




<script>
	
// editor de texto
$('#text_mvs').summernote({
    height: 250,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font',],
        ['para', ['ul', 'ol', 'paragraph']],
    ],
    lang: 'es-ES'
});



function guardar_mv(){
    var formData = new FormData($('#frm_mvs')[0]);

    $('#text_mvs').val($('#text_mvs').summernote('code'));
    var txt_mvs=$('#text_mvs').val();

    if (txt_mvs!='') {

        $('#btn_guardar_mv').prop('disabled', true);
        $('#btn_guardar_mv').html('<i class="bx bx-loader"></i> Guardando...');

        $.ajax({
            url: '{{ route("lic19_guardar_mv") }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                var obj_dato=JSON.parse(data);

                $('#btn_close_mv').click();
                arr_mvs=obj_dato.dt_mvs;

            }
        });
    }else{ toastr.warning("Complete los MVs");  }
}



</script>