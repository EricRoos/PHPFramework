<? $comments = $member->comments(); ?>
<? foreach($comments as $comment){ ?>
		<p> 
			<?= $comment->get_data(); ?>
			<br/>
			<?= $comment->member()->get_name(); ?>
		</p>
<?	} ?>
