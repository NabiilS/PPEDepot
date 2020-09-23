<?php echo validation_errors(); ?>
<?php echo form_open('eleve/edit/'.$eleve['id']); ?>
<div>
    Classe : <?php $comboBoxClasse->Render(); ?>
</div>
<div>Nom : <input type="text" name="nom" value="<?php echo ($this->input->post('nom') ? $this->input->post('nom') : $eleve['nom']); ?>" /></div>
<div>Prenom : <input type="text" name="prenom" value="<?php echo ($this->input->post('prenom') ? $this->input->post('prenom') : $eleve['prenom']); ?>" /></div>
<div>Login : <input type="text" name="login" value="<?php echo ($this->input->post('login') ? $this->input->post('login') : $eleve['login']); ?>" /></div>
<div>Password : <input type="password" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : $user->pass); ?>" /></div>
<button type="submit">Sauvegarder</button>
<?php echo form_close(); ?>