<b>New Comment</b>
<form method="POST" action="/comments/create">
	<input type="hidden" id="member_id" name="member_id" value="<?= $member->get_id() ?>"/>
	<TEXTAREA id ="data" name="data" rows=5 cols=40></TEXTAREA>
	<input type="submit"/>
</form>
