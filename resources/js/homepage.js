import Glide, { Controls, Breakpoints, Autoplay } from '@glidejs/glide/dist/glide.modular.esm'

new Glide('#glide', {
    type: 'carousel',
    perPage: 2,
    autoplay: 5000,
    hoverpause: true,
}).mount({ Controls, Breakpoints, Autoplay });
