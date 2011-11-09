<div id="page-tabset-$ID" class="page-tabset $CSSClass">
	<ul>
		<% control PageTabs %>
		<li><a href="&#35;page-tab-$ID" class="$CSSClass">$Title</a></li>
		<% end_control %>
	</ul>
	<% control PageTabs %>
	<div id="page-tab-$ID" class="$CSSClass">
		<% control PageTabItems %>
		<p class="$CSSClass">$Content</p>
		<% end_control %>
	</div>
	<% end_control %>
</div>