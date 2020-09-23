<?php echo validation_errors(); ?>
<?php echo form_open('Participer/Add'); ?>
<div class="field"> Rallye : <?php $comboBoxRallye->Render(); ?></div> 
<div class="field"> Eleve : <?php $comboBoxEleve->Render(); ?></div>
<button type="submit">Sauvegarder</button>
<?php echo form_close(); ?>