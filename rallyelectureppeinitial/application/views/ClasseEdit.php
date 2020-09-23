<?php echo validation_errors(); ?>
<?php echo form_open($controller.'/Edit/'.$classe['id']); ?>
<div class="field">
    Enseignant : <?php $comboBoxEnseignant->Render(); ?>
</div>
<div class="field">
    Année scolaire : <input type="text" name="anneeScolaire" value="<?php echo $classe['anneeScolaire']; ?>"/>
</div>
<div class="field">
    Niveau : <?php $comboBoxNiveau->Render(); ?>
</div>
<button type="submit">Sauvegarder</button>
<?php echo form_close(); ?>