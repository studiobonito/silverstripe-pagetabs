<% require javascript(pagetabs/javascript/page-tabset-init.js) %>

<% control PageTabSet %>
<div id="page-tabset-$ID" class="page-tabset $CSSClass">
	<ul>
		<% control PageTabs %>
		<li><a href="#page-tab-$ID" class="$CSSClass">$Title</a></li>
		<% end_control %>
	</ul>
	<% control PageTabs %>
	<div id="page-tab-$ID" class="$CSSClass">
		<% control PageTabItems %>
		<% if MultipleOf(2) %>
		<p class="$CSSClass even"><% if Image %>$Image<% end_if %>$Content</p>
		<% else %>
		<p class="$CSSClass odd"><% if Image %>$Image<% end_if %>$Content</p>
		<% end_if %>
		<% end_control %>
	</div>
	<% end_control %>
</div>
<% end_control %>