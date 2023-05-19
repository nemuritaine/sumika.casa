import { TweenMax } from "gsap";

const closest = (el, targetClass) => {
    for (let item = el; item; item = item.parentElement) {
        if (item.classList.contains(targetClass)) {
            return item
        }
    }
}

export function roomTour() {
    let winWidth = window.innerWidth;
    const itemList = [].slice.call(document.querySelectorAll('.room-tour'));
    itemList.forEach(item => {
        if(winWidth < 1023) {
            item.addEventListener('touchstart', () => {
                let title = item.getElementsByClassName('title');
                if(item.classList.contains('hover')) {
                    TweenMax.to(title, .3, {
                        autoAlpha: 0,
                    });
                    item.classList.remove('hover');
                } else {
                    TweenMax.to(title, .3, {
                        autoAlpha: 1,
                    });
                    item.classList.add('hover');
                    document.addEventListener('touchmove', (event) => {
                        if(!closest(event.target, 'title')) {
                            TweenMax.to(title, .3, {
                                autoAlpha: 0,
                            });
                            item.classList.remove('hover');
                        }
                    })
                }
            });
        } else {
            item.addEventListener('mouseover', () => {
                let title = item.getElementsByClassName('title');
                if(!item.classList.contains('hover')) {
                    TweenMax.to(title, .3, {
                        autoAlpha: 1,
                    });
                    item.classList.add('hover');
                }
            });
            item.addEventListener('mouseout', () => {
                let title = item.getElementsByClassName('title');
                if(item.classList.contains('hover')) {
                    TweenMax.to(title, .3, {
                        autoAlpha: 0,
                    });
                    item.classList.remove('hover');
                }
            });
        }
    });
};