<?php include('header.php'); ?>
<div class="container">
<form method="post">
<h3><center><strong>UPDATE POST</strong></center></h3>

<?php foreach ($posts as $post):?>

<form method="post">
  <div class="form-group">
    <label><strong>TITLE</strong></label>
    <input type="text" class="form-control" name="title" value="<?php echo $post['title']; ?>">
  </div>
  <div class="form-group">
    <label><strong>BODY</strong></label>
    <textarea id="editor1" class="form-control" name="body"><?php echo trim($post['body']); ?></textarea>
  </div>
   <button type="submit" class="btn btn-info btn-block" name="submit" id="submit"><strong>SUBMIT</strong></button>
</form>
<?php endforeach; ?>
</div>
<script>
    CKEDITOR.replace( 'editor1' );
</script>