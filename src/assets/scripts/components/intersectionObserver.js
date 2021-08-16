import { TweenMax } from "gsap";

// lazyload animation
export function lazyload() {
    let lazyImages = [].slice.call(document.querySelectorAll("img.lazyload"));
    const options = {
        root: null,
        rootMargin: '100px 100px',
        threshold: [0.25, 0.5]
    }
    if ("IntersectionObserver" in window) {
        const lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    if (lazyImage.dataset.hasOwnProperty('src')) {
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.dataset.src = '';
                        delete lazyImage.dataset.src;
                    }
                    if (lazyImage.dataset.hasOwnProperty('srcset')) {
                        lazyImage.srcset = lazyImage.dataset.srcset;
                        lazyImage.dataset.srcset = '';
                        delete lazyImage.dataset.srcset;
                    }
                    lazyImage.classList.remove("lazyload");
                    lazyImage.classList.add("lazyloaded");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        }, options);
        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }
}
// Array fade animation
export function fadeitem() {
    let fadeItems = [].slice.call(document.querySelectorAll(".array-fade"));
    const options = {
        root: null,
        threshold: [0, 0.2, 0.4, 0.6, 0.8, 1]
    }
    if ("IntersectionObserver" in window) {
        const fadeItemObserver  = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.intersectionRatio > 0.2) {
                    let fadeItem = entry.target;
                    TweenMax.staggerTo('.fade', .6, {
                        top: '0px',
                        opacity: 1,
                    }, .125);
                    fadeItem.classList.remove("array-fade");
                    fadeItemObserver.unobserve(fadeItem);
                }
            });
        }, options);
        fadeItems.forEach(el => {
            fadeItemObserver.observe(el);
        });
    }
}
// product-position fade animation
export function productPosition() {
    let product = [].slice.call(document.querySelectorAll(".product-position"));
    const options = {
        root: null,
        threshold: [0, 0.2, 0.4, 0.6, 0.8, 1]
    }
    if ("IntersectionObserver" in window) {
        const productPositionObserver  = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.intersectionRatio > 0.2) {
                    let productItem = entry.target;
                    TweenMax.to(productItem, .4, {
                        delay : 3,
                        autoAlpha: 0,
                        transform: 'translate(-50%,0) scale(0)',
                    });
                    productItem.classList.remove("product-position");
                    productPositionObserver.unobserve(productItem);
                }
            });
        }, options);
        product.forEach(el => {
            productPositionObserver.observe(el);
        });
    }
}

export function fadingUp() {
    let fadingUp = [].slice.call(document.querySelectorAll(".c-fade--up"));
    const options = {
        root: null,
        rootMargin: '50px 50px',
        threshold: [0.25, 0.5]
    }
    if ("IntersectionObserver" in window) {
        const fadingUpObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let item = entry.target;
                    //item.classList.remove("c-fade");
                    item.classList.add("c-faded--up");
                    fadingUpObserver.unobserve(item);
                }
            });
        }, options);
        fadingUp.forEach(function(item) {
            fadingUpObserver.observe(item);
        });
    }
}