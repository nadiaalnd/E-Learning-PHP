<?php $this->layout('templates/main', ['page_title' => 'Dashboard']) ?>

<?php $this->start('main') ?>
<p>Halo, <?= $this->e($name) ?></p>
<?php $this->stop() ?>