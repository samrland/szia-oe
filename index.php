<!--
szia
Copyright (c) 2023 samrpf. See the LICENSE file for more information.
-->

<title>szia workstation</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="UTF-8" />

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>

<script>
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
  		const timeElapsed = Date.now();
  		const todayObject = new Date(timeElapsed);
  		const today = todayObject.toUTCString();
  		document.getElementById("time").innerHTML = today;
		setTimeout(updateTime, 1000);
	}
	
	updateTime();
</script>

<style>
	@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap');
	
	body {
		font-family: 'Roboto', sans-serif;
		font-weight: 400;
		background-image: url('background.jpg');
		color: white;
		margin-bottom: -1px;
  		-webkit-background-clip: padding-box; /* for Safari */
  		background-clip: padding-box; /* for IE9+, Firefox 4+, Opera, Chrome */
		overflow: hidden;
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
	
	#menu {
  		position: absolute;
		top: 5px;
		right: 5px;
		text-align: right;
		padding-top: 0%;
	}

	#menu-title {
		font-weight: 100;
		font-size: 40px;
	}
	
	button {
		font-size: 13.6px;
	}
</style>

<div id="menu">
	<p id="menu-title">szia</p>

	<div>
		<a href="" onclick="popups.about()">about</a>
		|
		<a href="" onclick="popups.credits()">credits</a>
		|
		<a href="" onclick="popups.license()">license</a>
	</div>
	
	<div id="time">::placeholder::</div>
</div>

<style>
	.szia-window {
    	outline: 1px solid white;
		backdrop-filter: blur(2px);
    	position: absolute;
    	top: 0;
    	left: 50%;
		width: 500px;
		height: 500px;
		min-height: 100px;
		min-width: 100px;
		resize: both;
		overflow: auto;
		max-height: fit-content;
		max-width: fit-content;
		filter: drop-shadow(5px 5px 4px rgba(0, 0, 0, 0.2));
  	}
	
	iframe {
    	outline: none;
    	border: none;
    	resize: both;
    	overflow: auto;
  		position: auto;
  	}

	.szia-window-button {
		border: 1px solid rgba(255, 255, 255, 0.7);
  		outline: none;
    	background-color: transparent;
  		color: white;
    	position: relative;
		transition: ease 0.5s;
		width: 10%;
	}

	.szia-window-button:hover {
		width: 20%;
		background-color: rgba(0, 0, 0, 0.75);
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

<script>
	class SziaWindow {
		constructor(id, name, url) {
			this.id = id;
			this.name = name;
			this.url = url;

			this.showing = false;
		}

		show() {
			document.getElementById(this.id + "-frame").src = this.url;
			document.getElementById(this.id + "-window").style.display = "block";
			document.getElementById(this.id + "-button").style.background = "#91c4ed";
		}

		hide() {
			document.getElementById(this.id + "-frame").src = "about:blank";
			document.getElementById(this.id + "-window").style.display = "none";
			document.getElementById(this.id + "-button").style.background = "transparent";
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
	}
</script>

<?php
	$szia_script = '
		<script>
			let %szia-id% = new SziaWindow("%szia-id%", "%szia-name%", "%szia-url%");
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
		  	class="ui-widget-content szia-window">

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

		<script>
		    %szia-id%.hide();
		</script>
	';

	function add($id, $appName, $appURL, $scriptFormat) {
		$add_script = str_replace("%szia-id%", $id, $scriptFormat);
		$add_script = str_replace("%szia-name%", $appName, $add_script);
		$add_script = str_replace("%szia-url%", $appURL, $add_script);

		echo $add_script;
	}

	add('https://bing.com', 'Bing', 'bingapp', $szia_script);
	add('browser/browser.html', 'Browser', 'wbr', $szia_script);
	add('notes/notes.html', 'Notes', 'noteapp', $szia_script);
	add('helpapp/helpapp.html', 'Help', 'helpapp', $szia_script);
?>

<script>
	$('.szia-window').draggable();
	$('.szia-window').resizable();
	$('.szia-window-button').draggable({cancel: false});
</script>
