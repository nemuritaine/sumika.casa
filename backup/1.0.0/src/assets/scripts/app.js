  
import { TweenMax } from "gsap";
import { linkClick } from './components/button';
import { resizeViewport, getDevice, pageNationChanger } from './components/common';
import { objectFitImages } from './components/ofi.min';
import { roomTour } from './components/mouse-over';
import { menu } from './components/menu';
import { lazyload, fadeitem, productPosition } from './components/intersectionObserver';
import { mainHero, setHeight, scrollFade } from './components/mainVisual';
import { loadingAuto } from './components/post';
import * as imagesLoaded from './components/imagesloaded.pkgd.min';

const body = document.querySelector('body');
const main = document.querySelector('main');
  
document.addEventListener('DOMContentLoaded', () => {
    getDevice;
    objectFitImages('img.cover');
    objectFitImages('img.contain');
    new linkClick('body');
    new scrollFade('.c-btn--return');
    pageNationChanger();
    roomTour();
    menu();
    fadeitem();
    lazyload();
    productPosition();
    if(body.classList.contains('single')) {
    }
    if(main.classList.contains("home")) {
        loadingAuto('post', 4, 8);
        setHeight();
        imagesLoaded(document.querySelectorAll('.p-page--home__hero img'), () => {
            new mainHero(document.querySelector(".p-page--home__hero"));
        });
        const mainVisual = document.querySelector(".p-page--home__hero"),
            expander = document.querySelectorAll(".p-page--home__hero__page__expander"),
            facts = document.querySelectorAll(".p-page--home__hero__detail"),
            toggle = document.querySelector(".p-page--home__hero__menu__btn"),
            array = [mainVisual, expander, toggle, facts];
        TweenMax.staggerTo(array, .5, {
            autoAlpha: 1,
        }, .25);
    }
});

window.addEventListener('resize', () => {
    resizeViewport();
    if(main.classList.contains("home")) {
        setHeight();
    }
});


