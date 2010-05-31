<?php

echo $form->create("Post", array('action' => 'index', 'type' => 'GET'));
echo $form->input("q", array('label' => ''));
echo $form->end("Go");
?>