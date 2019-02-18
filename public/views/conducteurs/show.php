<?php ob_start(); ?>

Show

<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>