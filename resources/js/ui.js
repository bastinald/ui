require('@popperjs/core');
window.bootstrap = require('bootstrap');
import autosize from "autosize";

Livewire.onLoad(() => {
    autosize(document.querySelectorAll('textarea'));
    autosize.update(document.querySelectorAll('textarea'));
});

Livewire.hook('message.processed', (message, component) => {
    autosize(document.querySelectorAll('textarea'));
    autosize.update(document.querySelectorAll('textarea'));
});

Livewire.on('showBootstrapModal', () => {
    let element = document.getElementById('modal');
    let modal = new window.bootstrap.Modal(element, {
        backdrop: 'static',
        keyboard: false,
    });

    modal.show();
});

Livewire.on('hideModal', () => {
    let element = document.getElementById('modal');
    let modal = bootstrap.Modal.getInstance(element);

    element.addEventListener('hidden.bs.modal', () => {
        Livewire.emit('resetModal');
    });

    modal.hide();
});
