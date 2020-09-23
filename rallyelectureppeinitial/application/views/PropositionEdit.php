<?php echo validation_errors(); ?>
<?php echo form_open('proposition/edit/'.$proposition['id']); ?>
<div>id Question : <input type="text" name="idQuestion" value="<?php echo ($this->input->post('idQuestion') ? $this->input->post('idQuestion') : $proposition['idQuestion']); ?>" /></div>
<div>proposition : <input type="text" name="proposition" value="<?php echo ($this->input->post('proposition') ? $this->input->post('proposition') : $proposition['proposition']); ?>" /></div>
<div>solution    : <input type="checkbox" name="solution" value="1" <?php echo ($proposition['solution']==1 ? 'checked="checked"' : ''); ?> /></div>
<button type="submit">Save</button>
<?php echo form_close(); ?>