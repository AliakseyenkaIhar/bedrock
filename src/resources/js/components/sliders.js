import Swiper, { Navigation, Pagination } from 'swiper';
import Sliders from '@js/helpers/sliders';

import '@sass/includes/_swiper.scss';

Swiper.use([Navigation, Pagination]);
const sliders = new Sliders(Swiper);

sliders.make([
	{
		selector: '.slider-1',
		options: {
			loop: false,
			watchOverflow: true,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		},
	},
	{
		selector: '.slider-2',
		options: {
			slidesPerView: 2,
		},
	},
]);
