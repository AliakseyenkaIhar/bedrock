/**
 * External libraries and modules
 */
import smoothScroll from '@js/components/smooth-scroll';
import axios from 'axios';
import 'focus-visible';

/**
 * Local files
 */
// import './modernizr';
import '@/marusia.font';

/**
 * Styles
 */
import '@sass/libs.scss';
import '@sass/common.scss';

/**
 * Custom functions
 */
window.axios = axios;

smoothScroll(); // params could be timing (bool) and timing duration (int, ms)
