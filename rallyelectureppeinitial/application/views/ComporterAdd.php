<?php echo validation_errors(); ?>
<?php echo form_open('comporter/add'); ?>
<div class="field">     
    Rallye : <?php $comboBoxRallye->Render(); ?>
</div>
<div class="field"> 
    Livre : <?php $comboBoxLivre->Render(); ?>
</div>
<button type="submit">Save</button>
<?php echo form_close(); ?>