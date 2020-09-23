<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('Enseignant/Add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>id</td>
        <td>Nom</td>
        <td>Prenom</td>
        <td>Email</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($enseignants as $e): ?>
        <tr>
            <td><?php echo $e['id']; ?></td>
            <td><?php echo $e['nom']; ?></td>
            <td><?php echo $e['prenom']; ?></td>
            <td><?php echo $e['login']; ?></td>
            <td>
                <a href="<?php echo site_url('Enseignant/Edit/'.$e['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('Enseignant/Remove/'.$e['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>