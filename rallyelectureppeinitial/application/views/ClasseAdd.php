<?php echo validation_errors(); ?>
<?php echo form_open($controller.'/Add'); ?>
<div class="field">     
    Enseignant : <?php $comboBoxEnseignant->Render(); ?>
</div>
<div class="field">
    Annee scolaire : <input type="text" name="anneeScolaire" value="" />
</div>
<div class="field"> 
    Niveau : <?php $comboBoxNiveau->Render(); ?>
</div>
<button type="submit">Sauvegarder</button>
<?php echo form_close(); ?>