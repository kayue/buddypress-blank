<?php
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die();
?>


<div id="kommentare">



<?php if($comments): ?>
<?php foreach($comments as $comment): ?>



<div id="comment-<?php comment_ID() ?>">
	<h3><?php comment_author_link() ?> <a title="Sprungmarke zu diesem Kommentar" href="#comment-<?php comment_ID() ?>">#</a></h3>
	<p>
		Geschrieben am <?php comment_date() ?> um <?php comment_time() ?> Uhr
	</p>
	<?php comment_text() ?>
</div>



<?php endforeach; ?>



<?php else : ?>
	<p>Noch keine Kommentare oder Backlinks.</p>
<?php endif; ?>



<p class="center">
	<?php comments_rss_link('RSS-Feed zu diesem Beitrag'); ?>
</p>



<?php if ( comments_open() ) : ?>



<fieldset id="kommentarformular">
	<h3>Kommentar schreiben</h3>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">



	<?php if($user_ID): ?>



		<p>
			<?php printf(__('Eingeloggt als %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Logout') ?>"><?php _e('Logout'); ?></a>
			<label for="comment">Beitrag</label>
			<textarea name="comment" id="comment" cols="100" rows="12"></textarea>
		</p>



	<?php else : ?>



		<p>
			<label for="comment">Beitrag</label>
			<textarea name="comment" id="comment" cols="100" rows="12"></textarea>
		</p>
		<p>
			<label for="author">Name <?php if ($req) print '<span>*</span>'; ?></label>
			<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>">
		</p>
		<p>
			<label for="email">E-Mail-Adresse (wird nicht angezeigt) <?php if ($req) print '<span>*</span>'; ?></label>
			<input type="email" name="email" id="email" value="<?php echo $comment_author_email; ?>">
		</p>
		<p>
			<label for="url">Website</label>
			<input type="url" name="url" id="url" value="<?php echo $comment_author_url; ?>">
		</p>



	<?php endif; ?>



	<?php do_action('comment_form', $post->ID); ?>



	<p>
		<input name="submit" type="submit" id="submit" value="<?php echo attribute_escape(__('Kommentar abschicken!')); ?>">
	<p>



	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>">



</form>
</fieldset>



<?php endif ?>



<?php if(!comments_open()) { ?>
<p>
	Kommentare sind für diesen Beitrag geschlossen.
</p>
<?php } ?>



</div>