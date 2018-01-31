<?php require_once APPROOT.'/views/includes/header.php'; ?>
<div class="container">
<br>
<?php flash('post_message'); ?>
<br>
<div class="row mb-3">
    <div class="col-md-3">
        <h1>Posts</h1>
    </div>
    <div class="col-md-3 offset-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Add Post
        </a>
    </div>
</div>
</div>

<?php foreach($data['posts'] as $post): ?>
    <div class="card card-body mb-3">
       <img src="<?php echo URLROOT; ?>/img/<?php echo $post->img; ?>" alt="" class="card-img-top">
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2 mb-3">
            written by <?php echo $post->name; ?> on <?php echo $post->postCreated; ?>
        </div>
        <p class="card-text"><?php echo substr($post->body,0,500); ?></p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">Read more</a>
    </div>

<?php endforeach; ?>









