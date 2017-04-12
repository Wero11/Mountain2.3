<script id="judgeTemplate" type="x-jquery-tmpl">
<div class="recentjudgeitem">
	<h3 id="${judge_id}">
		<span class="recentjudgeimage">
			<img src="public/upload/${ProfileImage}" width="45" height="45" style="webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;"/>
		</span>
		<span class="recentjudgelabel">
				${first_name}
		</span>
		<button type="button" class="close" v-on="click:deleteAssignedJudge(${judge_id})"><span>×</span></button>
	</h3>
</div>
</script>