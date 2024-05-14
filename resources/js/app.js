import 'iconify-icon';
import 'flowbite';

document.getElementById('menu-icon').addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('menu-dropdown').classList.toggle('hidden');
})

