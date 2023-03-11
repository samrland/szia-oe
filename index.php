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

<script type='module'>
	var focusindex = 1;

	const popups = {
		about: function() {
			swal('About', 'szia is a project by samrpf to create an online operating environment based on zlinux.\nYou can find zlinux at https://zlinux.mkcodes.repl.co.');
		},
		credits: function() {
			swal('Credits', 'Base - zlinux (https://zlinux.mkcodes.repl.co)');
		},
		license: function() {
			swal('License', 'This piece of software follows the terms of the MIT License.\nYou can find it in the LICENSE file.');
		}
	};

	function updateTime() {
  		const today = new Date(Date.now());
  		$('#time').innerHTML = today.toUTCString();
		setTimeout(updateTime, 1000);
	}
	
	updateTime();

	class SziaWindow {
		constructor(id, name, url) {
			this.id = id;
			this.name = name;
			this.url = url;

			this.showing = false;
		}

		show() {
			$('#' + this.id + '-frame').src = this.url;
			$('#' + this.id + '-window').style.display = 'block';
			$('#' + this.id + '-button').style.background = '#91c4ed';
		}

		hide() {
			$('#' + this.id + '-frame').src = 'about:blank';
			$('#' + this.id + '-window').style.display = 'none';
			$('#' + this.id + '-button').style.background = 'transparent';
		}

		load() {
			// if window is showing, hide it, else show it again
			if (this.showing) {
				this.showing = false;
				this.hide();
			} else {
				this.showing = true;
				this.show();
			}
		}

		focus() {
    		focusindex += 1;
    		$('#' + this.id + '-window').style.zindex = focusindex.toString();
  		}
	}

	$('.szia-window').draggable();
	$('.szia-window').resizable();
	$('.szia-window-button').draggable({cancel: false});
</script>

<style>
	@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap');
	
	* {
		user-select: none;
	}

	body {
		font-family: 'Roboto', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
		font-weight: 400;
		background: url('https://malwarewatch.org/images/backgrounds/background9.jpg');
		color: white;
		margin-bottom: -1px;
  		-webkit-background-clip: padding-box; /* for Safari */
  		background-clip: padding-box; /* for IE9+, Firefox 4+, Opera, Chrome */
		overflow: hidden;
		margin: 0;
	}

	#menu {
		opacity: 90%;
  		position: absolute;
		top: 5px;
		right: 5px;
		text-align: right;
		padding-top: 0%;
	}

	#menu a {
		color: white;
	}

	#menu a:hover {
		color: white;
	}

	#menu a:visited {
		color: white;
	}

	#menu-title {
		font-weight: 100;
		font-size: 40px;
		margin-top: 1rem;
		margin-bottom: 1rem;
	}
	
	button {
		font-size: 13.6px;
		font-family: 'Roboto', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
	}

	iframe {
    	outline: none;
    	border: none;
    	resize: both;
    	overflow: auto;
  		position: auto;
  	}

	.szia-window {
    	outline: 1px solid white;
		backdrop-filter: blur(2px);
    	position: absolute;
    	top: 0;
    	left: 50%;
		min-height: 150px;
		min-width: 250px;
		resize: both;
		overflow: auto;
		max-height: fit-content;
		max-width: fit-content;
		filter: drop-shadow(4px 10px 4px rgba(0, 0, 0, 25%));
  	}

	.szia-window-button {
		border: 1px solid rgba(255, 255, 255, 0.7);
  		outline: none;
    	background: transparent;
  		color: white;
    	position: relative;
		transition: ease 0.5s;
	}

	.szia-window-button:hover {
		background: rgba(0, 0, 0, 0.75);
	}

	.szia-window-control {
		position: absolute;
		right: 0;
		font-family: 'Consolas', 'Courier New', monospace;
	}

	.szia-window-frame {
		width: 100%;
		height: 100%;
	}
</style>

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
		$template = str_replace('%szia-id%', $id, $template);
		$template = str_replace('%szia-name%', $appName, $template);
		$template = str_replace('%szia-url%', $appURL, $template);
		echo $template;
	}

	add('bingapp', 'Bing', 'https://bing.com');
	add('wbr', 'Browser', 'browser/browser.html');
	add('noteapp', 'Notes', 'notes/notes.html');
	add('helpapp', 'Help', 'helpapp/helpapp.html');
?>
