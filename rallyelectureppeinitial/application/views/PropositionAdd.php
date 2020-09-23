<?php echo validation_errors(); ?>
<?php echo form_open('Proposition/add'); ?>
<div>id Question : <input type="text" name="idQuestion" value="<?php echo $this->input->post('idQuestion'); ?>" /></div>
<div>Proposition : <input type="text" name="proposition" value="<?php echo $this->input->post('proposition'); ?>" /></div>
<div>Solution    : <input type="checkbox" name="solution" value="<?php echo ($this->input->post('solution')? $this->input->post('solution'):0); ?>" /></div>
<button type="submit">Save</button>
<?php echo form_close(); ?>