<?php
$replies = $getApplicantReplies->execute();
?>

<div>

  <?php if (count($replies) === 0): ?>
  <h2 class='placeholder'>Вы еще ни разу не откликнулись</h2>
  <?php else: ?>
  <div class='list'>
    <?php foreach ($replies as $reply): ?>
    <div class='item _border_sub'>
      <h3 class='item__title'><?= $reply->title ?></h3>
      <span><?= $reply->company ?></span>
      <span><?= $reply->date ?></span>
      <div class='item__buttons'>
        <button data-id="<?= $reply->id ?>" class='delete-reply-button button button_theme_danger'>Удалить</button>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

</div>

<script>
$('.delete-reply-button').on('click', function() {
  const id = $(this).data('id');
  const item = $(this).closest('.item');

  $.ajax({
    url: `/api/delete-reply.php?id=${id}`,
    method: 'delete',
    success: () => {
      item.remove();
    },
  });
});
</script>