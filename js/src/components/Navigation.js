
export class Navigation {
    async init() {

        const navigationElem = document.querySelector('#nav-toggle');

        navigationElem.addEventListener('click', function () {
            const navMenu = document.querySelector('#nav-wrapper');
            navMenu.classList.toggle('is-active');
        });

    }
}
