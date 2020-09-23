<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('niveau/add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>Id</td>
        <td>Niveau scolaire</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($niveaux as $n): ?>
        <tr>
            <td><?php echo $n['id']; ?></td>
            <td><?php echo $n['niveauScolaire']; ?></td>
            <td>
                <a href="<?php echo site_url('niveau/edit/'.$n['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('niveau/remove/'.$n['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>