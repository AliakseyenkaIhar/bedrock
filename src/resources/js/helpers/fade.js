/**
 * fadeIn and fadeOut functions.
 */

const fadeIn = (element, smooth = true, displayStyle = 'block') => {
	const el = element;
	el.style.opacity = 0;
	el.style.display = displayStyle;
	if (smooth) {
		let opacity = 0;
		let request;
		const animation = () => {
			opacity += 0.1;
			el.style.opacity = opacity;
			if (opacity >= 1) {
				opacity = 1;
				cancelAnimationFrame(request);
			}
		};
		const rAf = () => {
			request = requestAnimationFrame(rAf);
			animation();
		};
		rAf();
	} else {
		el.style.opacity = 1;
	}
};

const fadeOut = (element, smooth = true, displayStyle = 'none') => {
	const el = element;
	if (smooth) {
		let { opacity } = el.style;
		let request;
		const animation = () => {
			opacity -= 0.1;
			el.style.opacity = opacity;
			if (opacity <= 0) {
				opacity = 0;
				el.style.display = displayStyle;
				cancelAnimationFrame(request);
			}
		};
		const rAf = () => {
			request = requestAnimationFrame(rAf);
			animation();
		};
		rAf();
	} else {
		el.style.opacity = 0;
	}
};

export { fadeIn, fadeOut };
