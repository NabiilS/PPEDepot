<?php echo validation_errors(); ?>
<?php echo form_open('Auteur/Add'); ?>
<div>Nom : <input type="text" name="nom" value="<?php echo $this->input->post('nom'); ?>" /></div>
<button type="submit">Save</button>
<?php echo form_close(); ?>