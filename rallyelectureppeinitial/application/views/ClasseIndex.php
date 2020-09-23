<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('classe/add'); ?>">Ajouter</a>
</div>

<table>
    <tr>
        <td>Id</td>
        <td>IdEnseignant</td>
        <td>Anneescolaire</td>
        <td>IdNiveau</td>
        <td>Actions</td>
    </tr>
    <?php if (isset($classes)): ?>
        <?php foreach ($classes as $c): ?>
            <tr>
                <td><?php echo $c['id']; ?></td>
                <td><?php echo $c['idEnseignant']; ?></td>
                <td><?php echo $c['anneeScolaire']; ?></td>
                <td><?php echo $c['idNiveau']; ?></td>
                <td>
                    <a href="<?php echo site_url($controller.'/edit/'.$c['id']); ?>">Edit</a> | 
                    <a href="<?php echo site_url($controller.'/remove/'.$c['id']); ?>">Delete</a>
                  </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <td><b><?php echo "aucun enregistrement"; ?></b></td>
    <?php endif; ?>
</table>