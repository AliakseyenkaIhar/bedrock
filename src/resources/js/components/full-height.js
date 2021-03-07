/**
 * Create a full height section on mobile devices.
 *
 * https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
 */
(function init100vh(){
	const setHeight = () => {
		const vh = window.innerHeight * 0.01;
		document.documentElement.style.setProperty('--vh', `${vh}px`);
	}
	setHeight();
	window.addEventListener('resize', setHeight);
})();
