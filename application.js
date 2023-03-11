var focusindex = 1;

const popups = {
    about: function () {
        swal('About', 'szia is a project by samrpf to create an online operating environment based on zlinux.\nYou can find zlinux at https://zlinux.mkcodes.repl.co.');
    },
    credits: function () {
        swal('Credits', 'Base - zlinux (https://zlinux.mkcodes.repl.co)');
    },
    license: function () {
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
$('.szia-window-button').draggable({ cancel: false });
