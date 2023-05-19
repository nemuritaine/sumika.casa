export class linkClick {
    constructor(hookName) {
        this.elm = document.querySelector(hookName);
        const target = this.elm.querySelectorAll('a[href^="#"]');
        const targetArr = Array.prototype.slice.call(target);
        targetArr.forEach(link => {
            link.addEventListener('click', (e) => this.clickHander(e));
        })
    }
    clickHander(e) {
        e.preventDefault();
        const targetId = e.currentTarget.hash;
        const targetElm = document.querySelector(targetId);
        const targetOffsetTop = window.pageYOffset + targetElm.getBoundingClientRect().top;
        window.scrollTo({
            top: targetOffsetTop,
            behavior: "smooth"
        })
    }
}