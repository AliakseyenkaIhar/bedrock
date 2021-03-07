import { fadeIn, fadeOut } from '@js/helpers/fade';

export default class Modal {

	make(options) {
		const { toggler, modal, args } = options;
		modal.style.display = 'none';

		toggler.addEventListener('click', e => {
			e.preventDefault();

			console.log(modal)

			this.modalBackground = document.createElement('div');

			this.modalBackground.classList.add('hidden', 'inset-0', 'flex', 'justify-center', 'items-center', 'bg-black', 'bg-opacity-50', 'fixed');
			this.modalBackground.appendChild(modal);
			document.body.appendChild(this.modalBackground);
			modal.style.display = 'block';
			fadeIn(this.modalBackground, true, 'flex');

			this.modalBackground.addEventListener('click', this.hide());
		});
	}

	hide() {
		fadeOut(this.modalBackground);
	}

}
