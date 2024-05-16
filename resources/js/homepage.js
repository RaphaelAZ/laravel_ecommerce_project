import Glide, { Controls, Breakpoints, Autoplay } from '@glidejs/glide/dist/glide.modular.esm'

new Glide('#glide', {
    type: 'carousel',
    perView: 3,
    //autoplay: 5000,
    rewind: true,
    hoverpause: true,
}).mount({ Controls, Breakpoints, Autoplay });
