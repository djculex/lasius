<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>-->

<p><{$block.online_total}></p>
<p><{$block.lang_members}>: <{$block.online_members}></p>
<p><{$block.lang_guests}>: <{$block.online_guests}></p>
<p><{$block.online_names}></p>
<{if $block.takeoverlinks == '0'}>
	<a id="lasius-online-users-selector" class="btn btn-xs btn-info" href="javascript:openWithSelfMain('<{$xoops_url}>/misc.php?action=showpopups&amp;type=online','Online',420,350);"
   title="<{$block.lang_more}>"><{$block.lang_more}></a>
<{else}>
	<!--<a id="lasius-online-users-selector-new" data-role="button"><{$block.lang_more}></a> -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<button type="reset" id="lasius-online-users-selector-new"><{$block.lang_more}></button>
<{/if}>
<!--
define('_LASIUS_BLOCK_LOCATIONCOUNTRY', 'Country');
define('_LASIUS_BLOCK_LOCATIONCITY', 'City');
define('_LASIUS_BLOCK_USERNAME', 'Username');
define('_LASIUS_BLOCK_WHEREINPAGE', 'Where ?');
define('_LASIUS_BLOCK_AVATAR', 'Image');
-->

<div id = "lasius-hidden-users">
	<table class="table">
		<!--<thead>
		<tr>
		<th scope="col"><{$smarty.const._LASIUS_BLOCK_LOCATIONFLAG}></th>
		<th scope="col"><{$smarty.const._LASIUS_BLOCK_AVATAR}></th>
		<th scope="col"><{$smarty.const._LASIUS_BLOCK_USERNAME}></th>
		<th scope="col"><{$smarty.const._LASIUS_BLOCK_LOCATIONCOUNTRYCITY}></th>
		<th scope="col"><{$smarty.const._LASIUS_BLOCK_WHEREINPAGE}></th>
		</tr>
		</thead>
		<tbody>-->
			<tr>
				<{section name=i loop=$blockhidden}>
				<td>
				<{$blockhidden[i].flaghtml}>
				</td>
				<{if $blockhidden[i].online_uid == "0"}>
					<td>&nbsp;</td>
				<{else}>
					<td><{$blockhidden[i].useravatar}></td>
				<{/if}>
				
				<{if $blockhidden[i].online_uid == "0"}>
					<td><{$smarty.const._LASIUS_BLOCK_ANONYMOUS}></td>
				<{else}>
					<td><{$blockhidden[i].username}></td>
				<{/if}>

				<td>
					<a href = "https://www.openstreetmap.org/search?query=<{$blockhidden[i].ipinfo.city}> + <{$blockhidden[i].ipinfo.country}>" target="_BLANK">
						<{$blockhidden[i].ipinfo.city}> / <{$blockhidden[i].ipinfo.country}>
					</a>
				</td>
				<td><{$blockhidden[i].module}></td>
				<{/section}>
			</tr>
		</tbody>
	</table>
</div>

