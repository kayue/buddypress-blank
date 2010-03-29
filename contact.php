<?php // Template name: Contact Form ?>



<?php get_header(); ?>



<?php
	$mail_to = '';
	$error = array();
	$erfolg = false;
	if(!empty($_POST)){
		if(empty($_POST['kauthor'])){
				$error['kauthor'] = 'Bitte einen Namen angeben!';
		}
		if(!strpos($_POST['kemail'], '@')){
			$error['kemail'] = 'Bitte eine (gültige) E-Mail-Adresse angeben!';
		}
		if(empty($_POST['kcomment'])){
			$error['kcomment'] = 'Nicht die Nachricht vergessen!';
		}
		if(strtolower(trim($_POST['kantispam'])) !== 'franz'){
			$error['kantispam'] = 'Bitte auch die Antispam-Frage beantworten!';
		}
		if(empty($error)){
			if(!empty($_POST['ktele'])){
				$tele = "\n\r\n\r".'Telefonnummer: '.$_POST['ktele'];
			}
			else{
				$tele = '';
			}
			$mail_from = $_POST['kemail'];
			$mail_subject = '[Kontaktformular '.get_bloginfo('name').'] Nachricht von '.$_POST['kauthor'];
			$mail_message = wordwrap($_POST['kcomment'].$tele, 70);
			$mail_header = 'From: '.$mail_from."\r\n".
'Reply-To: '.$mail_from."\r\n".
'X-Mailer: PHP/'.phpversion().
"Mime-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: quoted-printable";
			mail($mail_to, $mail_subject, $mail_message, $mail_header);
			$erfolg = true;
		}
	}
?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



<div class="postcontainer" id="post-<?php the_ID(); ?>">
	<?php if(!is_single()): ?>
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<?php else: ?>
		<h2><?php the_title(); ?></h2>
	<?php endif; ?>

	<div class="postcontent">
		<?php the_content(); ?>
	</div>

	<?php if($erfolg): ?>

		<div class="kontakt-erfolg">
			<h3>Danke für die Nachricht!</h3>
			<p>
				Wir werden uns so schnell es geht um eine Antwort bemühen.
			</p>
		</div>
		<?php unset($_POST); ?>

	<?php else: ?>

	<form action="<?php the_permalink() ?>" method="post"><fieldset>
		<p class="form">
			<label for="kauthor"<?php if(isset($error['kauthor'])){ echo ' class="formerror"'; } ?>>
				Name <span>*</span>
			</label>
			<input name="kauthor" id="kauthor" value="<?php echo ($_POST['kauthor']) ? $_POST['kauthor'] : ''; ?>" type="text"<?php if(isset($error['kauthor'])){ echo ' class="formerror"'; } ?>>
			<?php if(isset($error['kauthor'])){ echo '<span class="formerror">'.$error['kauthor'].'</span>'; } ?>
		</p>
		<p class="form">
			<label for="kemail"<?php if(isset($error['kemail'])){ echo ' class="formerror"'; } ?>>
				E-Mail-Adresse <span>*</span>
			</label>
			<input name="kemail" id="kemail" value="<?php echo ($_POST['kemail']) ? $_POST['kemail'] : ''; ?>" type="text"<?php if(isset($error['kemail'])){ echo ' class="formerror"'; } ?>>
			<?php if(isset($error['kemail'])){ echo '<span class="formerror">'.$error['kemail'].'</span>'; } ?>
		</p>
		<p class="form">
			<label for="ktele">
				Telefonnummer
			</label>
			<input name="ktele" id="ktele" value="<?php echo ($_POST['ktele']) ? $_POST['ktele'] : ''; ?>" type="text">
		</p>
		<p class="form">
			<label id="antispam-label" for="kantispam-input"<?php if(isset($error['kantispam'])){ echo ' class="formerror"'; } ?>>
				Wie lautet der Vorname von <strong id="antispam-hint">Franz</strong> Beckenbauer? <span>*</span>
			</label>
			<input name="kantispam" id="kantispam-input" value="<?php echo ($_POST['kantispam']) ? $_POST['kantispam'] : ''; ?>" size="22" type="text"<?php if(isset($error['kantispam'])){ echo ' class="formerror"'; } ?>>
			<?php if(isset($error['kantispam'])){ echo '<span class="formerror">'.$error['kantispam'].'</span>'; } ?>
		</p>
		<p class="form">
			<label for="kcomment"<?php if(isset($error['kcomment'])){ echo ' class="formerror"'; } ?>>
				Nachricht <span>*</span>
			</label>
			<textarea name="kcomment" id="kcomment" rows="12" cols="50"<?php if(isset($error['kcomment'])){ echo ' class="formerror"'; } ?>><?php echo ($_POST['kcomment']) ? $_POST['kcomment'] : ''; ?></textarea>
			<?php if(isset($error['kcomment'])){ echo '<span class="formerror">'.$error['kcomment'].'</span>'; } ?>
		</p>
		<p class="clearfix buttons">
			<input value="Abschicken" type="submit">
		</p>
	</fieldset></form>

	<script>
	var kontaktCaptcha = document.getElementById('kantispam-input');
	if(kontaktCaptcha){
		kontaktCaptcha.value = 'Franz';
		kontaktCaptcha.parentNode.style.display = 'none';
	}
	</script>

	<?php endif; ?>

</div>



<?php endwhile; ?>



<?php else: ?>



<div class="postcontainer">
	<h2>Nichts gefunden</h2>
	<p>
		Es konnten keine der Anfrage entsprechenden Beiträge oder Seiten gefunden werden.
	</p>
</div>



<?php endif; ?>



<?php get_sidebar(); ?>



<?php get_footer(); ?>