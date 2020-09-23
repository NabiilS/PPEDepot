<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a> 
</div>
<table>
    <tr>
        <td>idRallye de Participer</td>
        <td>idEleve de Participer</td>
        <td>idQuestion</td>
        <td>idProposition</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($reponses as $r): ?>
        <tr>
            <td><?php echo $r['idParticiperRallye']; ?></td>
            <td><?php echo $r['idParticiperEleve']; ?></td>
            <td><?php echo $r['idQuestion']; ?></td>
            <td><?php echo $r['idProposition']; ?></td>
            <td>
                <a href="<?php echo site_url('reponse/edit/'.$r['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('reponse/remove/'.$r['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>