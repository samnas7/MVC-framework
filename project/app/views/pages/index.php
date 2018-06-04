<?php
require APPROOT . '/views/inc/header.php';
?>

<h1 class="text-centre"><i class='fa fa-book fa-inverse'></i><?php echo $data['title']; ?></h1>
<ul>
<?php foreach ($data['posts'] as $post) {
   echo " <li> $post->title</li>";
}?>
<?php foreach ($data['posts'] as $post):
   echo " <li> $post->title</li>";
endforeach;
?>
</ul>
<?php

require APPROOT . '/views/inc/footer.php';
?>