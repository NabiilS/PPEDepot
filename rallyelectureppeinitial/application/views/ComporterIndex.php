<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('comporter/add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>idRallye</td>
        <td>idLivre</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($all_comporter as $c): ?>
        <tr>
            <td><?php echo $c['idRallye']; ?></td>
            <td><?php echo $c['idLivre']; ?></td>
            <td>
                <a href="<?php echo site_url('comporter/remove/'.$c['idRallye'].'/'.$c['idLivre']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>