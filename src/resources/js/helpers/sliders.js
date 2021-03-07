export default class Sliders {

	constructor(instance) {
		this.inst = instance;

		if (typeof this.inst !== 'function') {
			throw new Error('There is a problem with slider instance. Are you sure Swiper installed?');
		}
	}

	make(sliders) {
		this.sliders = sliders;

		this.sliders.forEach(slider => {
			const { selector, options } = slider;
			new this.inst(selector, options);
		});
	}

}
