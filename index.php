<!--
szia
Copyright (c) 2023 samrpf. See the LICENSE file for more information.
-->

<title>szia workstation</title>
<meta name='viewport' content='width=device-width, initial-scale=1' />
<meta charset='UTF-8' />

<script defer src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
<script defer src='https://code.jquery.com/jquery-1.12.4.js'></script>
<script defer src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>

<script defer src='application.js'></script>

<link rel="stylesheet" href="master.css" />

<div id='menu'>
	<p id='menu-title'>szia</p>

	<div>
		<a href onclick='popups.about()'>about</a>
		|
		<a href onclick='popups.credits()'>credits</a>
		|
		<a href onclick='popups.license()'>license</a>
	</div>
	
	<div id='time'>::placeholder::</div>
</div>

<?php
	function add($id, $appName, $appURL) {
		$template = '
		<script type="module">
			let %szia-id% = new SziaWindow("%szia-id%", "%szia-name%", "%szia-url%");
		    %szia-id%.hide();
		</script>

		<button
		    type="button"
		    id="%szia-id%-button"
			class="szia-window-button"
		    onclick="%szia-id%.load()">
		    %szia-name%
		</button>

		<br />

		<div
		  	id="%szia-id%-window"
		  	class="ui-widget-content szia-window"
			onclick="%szia-id%.focus()">

		  	<span>%szia-name%</span>

		  	<a
		      	onclick="%szia-id%.hide()"
				class="szia-window-control">
		    	[-]
			</a>

			<iframe
				id="%szia-id%-frame"
				src="about:blank"
				class="szia-window-frame" />
		</div>
		';
		$new_template = str_replace('%szia-id%', $id, $template);
		$new_template = str_replace('%szia-name%', $appName, $new_template);
		$new_template = str_replace('%szia-url%', $appURL, $new_template);
		echo $new_template;
	}

	add('bingapp', 'Bing', 'https://bing.com');
	add('wbr', 'Browser', 'browser/browser.html');
	add('noteapp', 'Notes', 'notes/notes.html');
	add('helpapp', 'Help', 'helpapp/helpapp.html');
?>
