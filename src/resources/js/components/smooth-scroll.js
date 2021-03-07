/**
 * Smooth scrolling.
 *
 * With some speed and default smooth
 */

const smoothTimingScroll = (el, duration) => {
	const startingY = window.pageYOffset;
	const diff = el.offsetTop - startingY;
	let start;

	window.requestAnimationFrame(function step(timestamp) {
		if (!start) start = timestamp;
		const time = timestamp - start;
		const percent = Math.min(time / duration, 1);
		window.scrollTo(0, startingY + diff * percent);

		if (time < duration) {
			window.requestAnimationFrame(step);
		}
	});
};

const smoothDefaultScroll = (el) => {
	el.scrollIntoView({
		behavior: 'smooth',
		block: 'start',
	});
};

export default function smoothScroll (timing = false, duration = 500 ) {
	const smoothLinks = document.querySelectorAll('a[href^="#"]');
	smoothLinks.forEach((link) => {
		link.addEventListener('click', (e) => {
			e.preventDefault();
			const id = link.getAttribute('href');
			const el = document.querySelector(id);

			if(timing) {
				smoothTimingScroll(el, duration);
			} else {
				smoothDefaultScroll(el);
			}
		});
	});
};
