import Glide, { Controls, Breakpoints, Autoplay } from '@glidejs/glide/dist/glide.modular.esm'

new Glide('.glide', {
    type: 'carousel',
    perPage: 1,
    autoplay: 3000,
    hoverpause: true,
}).mount({ Controls, Breakpoints, Autoplay });