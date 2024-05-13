import Glide, { Controls, Breakpoints, Autoplay } from '@glidejs/glide/dist/glide.modular.esm'
import 'iconify-icon';
import 'flowbite';


document.getElementById('menu-icon').addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('menu-dropdown').classList.toggle('hidden');
})

new Glide('.glide', {
    type: 'carousel',
    perPage: 1,
    autoplay: 3000,
    hoverpause: true,
}).mount({ Controls, Breakpoints, Autoplay });
