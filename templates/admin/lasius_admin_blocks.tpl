<!-- Header -->
<{includeq file='db:lasius_admin_header.tpl' }>

<div class="top">
	<table width="100%" class="outer" cellspacing="1">
		<tr>
			<th>Block title</th><th>Autoupdate on/off </th><th>Interval</th></tr>
			<{foreach from=$activeblocks key=myId item=i}>
				<{if in_array($i,$supportedblocks)}>
					<tr class="<{cycle values="odd,even"}>">
						<td>
							<span id = 'actblocksel' name = '<{$i}>' value = '<{$myId}>'>
								<{$i}>
							</span>
						</td>
						<td>
							<!-- Rounded switch -->
							<label class="switch">
							  <input name="activatedonoff" type="checkbox" id="<{$myId}>" <{if $activated.$i > 0}>checked="checked"<{/if}>>
							  <span class="slider round"></span>
							</label>
						</td>
						<td>
							<div class="selectdiv">
								<label>
									<{html_options name=dropdown$myId id=$myId options=$timeInterval selected=$selected.$i}>
							  </label>
							</div>
						</td>
					</tr>
				<{/if}>
			<{/foreach}>
	</table>
</div>
<!-- Footer -->
<{includeq file='db:lasius_admin_footer.tpl' }>
