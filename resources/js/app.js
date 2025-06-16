// Import Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';

// Import Bootstrap JS (popper.js sudah termasuk di bootstrap 5)
import 'bootstrap';

// Import Owl Carousel CSS dan JS (kalau perlu JS-nya juga)
import 'owl.carousel/dist/assets/owl.carousel.min.css';
import 'owl.carousel/dist/assets/owl.theme.default.min.css';
import 'owl.carousel';

// Import jQuery Fancybox CSS dan JS (jika butuh fancybox JS juga)
import 'jquery.fancybox/source/jquery.fancybox.css';
import '@fancyapps/fancybox'; // atau 'jquery.fancybox' tergantung versi dan package

// Import font dan css custom
import '../fonts/flaticon_mycollection.css';
import '../css/fontawesome.min.css';
import '../css/style.css';
import '../css/responsive.css';

// Jika kamu butuh jQuery, import jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Import Bootstrap JS (popper otomatis include jika bootstrap 5+)
import 'bootstrap';

// Import Owl Carousel JS
import 'owl.carousel';

// Import Fancybox JS
import '@fancyapps/fancybox';

// Tambahan JS kustom kamu bisa di sini


// Contoh inisialisasi Owl Carousel atau Fancybox (jika perlu)
// $(document).ready(function(){
//   $(".owl-carousel").owlCarousel({
//     loop:true,
//     margin:10,
//     nav:true,
//     items:1
//   });
// });


// Jika kamu punya file CSS tambahan, bisa diimport di sini juga:
// import '../css/custom.css';

// Jika kamu ingin menulis kode JS custom, tulis di sini
// contoh:
// document.addEventListener('DOMContentLoaded', () => {
//     console.log('App ready!');
// });
