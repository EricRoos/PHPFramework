<p>
<? foreach($members as $member){ ?>
		<a href="/members/<?= $member->get_id(); ?>"><?= $member->get_name(); ?></a><br/>
<?php } ?>
</p>
<a href='members/new'>New Member</a>
