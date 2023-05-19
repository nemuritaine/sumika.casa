import { TweenMax } from "gsap";

export function menu() {
    const button = document.querySelector('.l-menu__btn'),
        nav = document.querySelector('.l-menu'),
        hamburger = document.querySelector('.hamburger'),
        body = document.querySelector('body');
    button.addEventListener('click', () => {
        if(button.classList.contains('active')) {
            button.classList.remove('active');
            TweenMax.to(hamburger, .25, {
                fill: '#252525',
            });
            TweenMax.to(nav, .45, {
                right: '-46%',
                autoAlpha: 0,
            });
            body.classList.remove('active');
            body.style.overflowY = "";
            document.removeEventListener('touchmove', scrollControl, { passive: false })
        } else {
            button.classList.add('active');
            TweenMax.to(hamburger, .25, {
                fill: '#fff',
            });
            TweenMax.to(nav, .45, {
                right: 0,
                autoAlpha: 1,
            });
            body.classList.add('active');
            body.style.overflowY = "hidden";
            document.addEventListener("touchmove", scrollControl, { passive: false });
        };
    });
};
function scrollControl(event) {
    event.preventDefault();
}