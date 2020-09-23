<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('question/add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>id</td>
        <td>Question</td>
        <td>Points</td>
        <td>id Livre</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($questions as $q): ?>
        <tr>
            <td><?php echo $q['id']; ?></td>
            <td><?php echo $q['question']; ?></td>
            <td><?php echo $q['points']; ?></td>
            <td><?php echo $q['idLivre']; ?></td>
            <td>
                <a href="<?php echo site_url('question/edit/'.$q['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('question/remove/'.$q['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>