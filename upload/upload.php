<?php 
move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
echo 'images/'.$_FILES['file']['name'];