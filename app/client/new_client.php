<?php
// session_start();
require_once '../../common/app.php';
$lang='fr';
?>
<div class="row">	
    <div class="col-lg-6" style="margin: auto">			        
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><i class="fa fa-indent red"></i><strong>Nouveau Client</strong></h2>
        </div>
        <div class="panel-body">
                            <form action="" method="post">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nf-email" class="form-control" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="nf-password" class="form-control" placeholder="Prenom">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" name="nf-password" class="form-control" placeholder="Adresse">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Telephone</label>
                        <input type="text" id="telephone" name="nf-password" class="form-control" placeholder="Telephone">
                    </div>
                </form>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" id="SAVE" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Enregistrer</button>
    <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Annuler</button>
    </div>
    </div>
    </div><!--/.col-->
			
    </div><!--/col-->



<script type="text/javascript">
                
              
      clientProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var nom= $('#nom').val();
            var prenom = $("#prenom").val();
            var adresse = $("#adresse").val();
            var telephone = $('#telephone').val();
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('nom', nom);
            formData.append('prenom', prenom);
            formData.append('adresse', adresse);
            formData.append('telephone', telephone);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/client/ClientController.php',
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'JSON',
                data: formData,
                success: function (data)
                {
                    if (data.rc == 0)
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.action,
                            class_name: 'gritter-success gritter-light'
                        });
                       
                    } 
                    else
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                        
                    };
                },
                error: function () {
                    alert("failure - controller");
                }
            });

        };

        $("#SAVE").bind("click", function () {
            clientProcess();
        });
</script>