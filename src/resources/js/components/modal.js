import Modal from '@js/helpers/modal';

const modals = new Modal();

modals.make({
	toggler: document.querySelector('.open-modal'),
	modal: document.querySelector('.modal'),
	options: {}
});
