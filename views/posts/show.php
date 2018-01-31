<?php require_once APPROOT.'/views/includes/header.php'; ?>
<br>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br><br>
<img src="<?php echo URLROOT; ?>/img/<?php echo $data['post']->img; ?>" alt="" class="card-img-top">
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p><?php echo $data['post']->body; ?></p>

<?php if($data['post']->user_id == $_SESSION['user_id']): ?>
<hr>
<a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark"><i class="fa fa-pencil"></i> Edit</a>

<form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post" class="pull-right">
    <input type="submit" value="Delete" class="btn btn-danger">
</form>

<?php endif; ?>
<br><br>
