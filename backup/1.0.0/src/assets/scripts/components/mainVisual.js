import { gsap } from "gsap";
import { TweenMax } from "gsap";
import * as anime from './anime.min';
import { splitText } from './splitText';

function scrollControl(event) {
    event.preventDefault();
}

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};
//画面幅計測
let win = {
	width: window.innerWidth,
	height: window.innerHeight
};
//アニメーション各種設定
const settings = {
	image: {duration: 900, delay: 0, easing: [0.8,0,0.2,1]},
	more: {duration: 900, delay: 0, easing: [0.8,0,0.2,1]},
	facts: {duration: 300, delay: 0, easing: [0.8,0,0.2,1]},
	title: {duration: 700, delay: 200, easing: [0.8,0,0.2,1]},
	description: {duration: 900, delay: 400, easing: 'easeOutExpo'},
	pagination: {duration: 300, delay: 400, easing: 'easeInOutQuad'},
	factsCtrl: {duration: 0, easing: 'linear'},
	gallery: {duration: 800, easing: [0.2,1,0.3,1]},
	navigationCtrls: {duration: 0, easing: [0.8,0,0.2,1]},
	previewCloseCtrl: {duration: 300, easing: 'easeOutExpo', visibility: 'visible'},
	factsItems: {duration: 800, easing: [0.8,0,0.2,1]},
	expander: {duration: 800, easing: [0.8,0,0.2,1]},
	globalNavi: {duration: 800, easing: [0.8,0,0.2,1]},
};
export class Entry {
	constructor(el) {
		this.DOM = {el: el};
		this.init();
	}
	init() {
		this.DOM.title = this.DOM.el.querySelector('.p-page--home__hero__ttl');
		new splitText(this.DOM.title, {
            'type': 'letters',
			'useLite': true
        });
		this.DOM.titleLetters = this.DOM.title.querySelectorAll('span');
		this.DOM.description = this.DOM.el.querySelector('.p-page--home__hero__txt');
		this.DOM.image = this.DOM.el.querySelector('.p-page--home__hero__page__image img');
		this.DOM.more = this.DOM.el.querySelector('.p-page--home__hero__page__more__inner');
		this.DOM.expander = this.DOM.el.querySelector('.p-page--home__hero__page__expander');
		this.DOM.globalNavi = this.DOM.el.querySelector('.l-menu__btn');
		this.DOM.facts = {
			wrapper: this.DOM.el.querySelector('.p-page--home__hero__detail'),
			items: Array.from(this.DOM.el.querySelectorAll('.p-page--home__hero__detail__item'))
		};
	}
	show(direction) {
		this.isHidden = false;
		return this.toggle(direction);
	}
	hide(direction) {
		this.isHidden = true;
		return this.toggle(direction);
	}
	toggle(direction) {
		this.direction = direction; 
		return Promise.all([
			this.toggleTitle(!this.isHidden),
			this.toggleDescription(!this.isHidden),
			this.toggleImage(!this.isHidden),
			this.toggleMore(!this.isHidden),
			this.toggleFacts(!this.isHidden)
		]);
	}
	toggleTitle() {
		anime.remove(this.DOM.titleLetters);
		return anime({
			targets: this.DOM.titleLetters,
			duration: settings.title.duration,
			delay: (target, index) => index * 30 + settings.title.delay,
			easing: settings.title.easing,
			translateY: this.isHidden ?
				[0,this.direction === 'next' ? '-100%' : '100%'] :
				[this.direction === 'next' ? '100%' : '-100%', 0],
			opacity: {
				value: this.isHidden ? 0 : 1,
				duration: 1,
				delay: (target, index) => this.isHidden ? settings.title.duration + settings.title.delay : settings.title.delay
			}
		}).finished;
	}
	toggleDescription() {
		anime.remove(this.DOM.description);
		return anime({
			targets: this.DOM.description,
			duration: settings.description.duration,
			delay: !this.isHidden ? settings.description.duration * 0.5 + settings.description.delay : settings.description.delay,
			easing: settings.description.easing,
			translateY: this.isHidden ? [0, this.direction === 'next' ? '-10%' : '10%'] : [this.direction === 'next' ? '20%' : '-20%', 0],
			opacity: this.isHidden ? 0 : 1
		}).finished;
	}
	toggleImage() {
		this.DOM.image.style.transformOrigin = !this.isHidden ? `50% ${this.direction === 'next' ? 0 : 100}%` : `50% 50%`;
		anime.remove(this.DOM.image);
		return anime({
			targets: this.DOM.image,
			duration: settings.image.duration,
			delay: settings.image.delay,
			easing: settings.image.easing,
			translateY: this.isHidden ? ['0%',this.direction === 'next' ? '-100%' : '100%'] : [this.direction === 'next' ? '100%' : '-100%','0%'],
			scale: !this.isHidden ? [1.8,1] : 1,
			opacity: {
				value: this.isHidden ? 0 : 1,
				duration: 1,
				delay: this.isHidden ? settings.image.duration + settings.image.delay : settings.image.delay
			}
		}).finished;
	}
	toggleMore() {
		anime.remove(this.DOM.more);
		return anime({
			targets: [this.DOM.more, this.DOM.more.children],
			duration: settings.more.duration,
			delay: settings.more.delay,
			easing: settings.more.easing,
			translateY: this.isHidden ? ['0%',this.direction === 'next' ? '-100%' : '100%'] : [this.direction === 'next' ? '100%' : '-100%','0%'],
			opacity: {
				value: this.isHidden ? 0 : 1,
				duration: (target, index) => index ? settings.more.duration/3 : 1,
				delay: (target, index) => index ? 
					this.isHidden ? 100 : settings.more.duration * 0.5 + settings.more.delay :
					this.isHidden ? settings.more.duration + settings.more.delay : settings.more.delay
			}
		}).finished;
	}
	//prev:nextボタンで記事タイトル表示アニメーション制御
	toggleFacts() {
		anime.remove(this.DOM.facts.items);
		return anime({
			targets: this.DOM.facts.items.slice(0, 2),
			duration: settings.facts.duration,
			delay: (target, index) => {
				return !this.isHidden ? index * 40 + settings.facts.duration * 0.5 + settings.facts.delay : index * 40 + settings.facts.delay;
			},
			easing: settings.facts.easing,
			translateY:
				this.isHidden ?
					[this.DOM.facts.ty, this.direction === 'next' ? this.DOM.facts.ty-20 : this.DOM.facts.ty+20] :
					[this.direction === 'next' ? this.DOM.facts.ty+20 : this.DOM.facts.ty-20, this.DOM.facts.ty],
			opacity: this.isHidden ? 0 : 1
		}).finished;
	}
};


export class mainHero {
	constructor(el) {
		this.DOM = {};
		this.DOM.el = el;
		this.init();
	}
	init() {
		this.DOM.factsContainer = this.DOM.el.querySelector('.p-page--home__hero__menu');
		this.DOM.factsCtrls = {
			toggle: this.DOM.factsContainer.querySelector('.p-page--home__hero__menu__btn'),
			more: this.DOM.factsContainer.querySelector('.p-page--home__hero__menu__btn--more'),
			less: this.DOM.factsContainer.querySelector('.p-page--home__hero__menu__btn--less'),
		};
		this.DOM.previewCloseCtrl = this.DOM.factsContainer.querySelector('.p-page--home__hero__menu__btn--close');
		this.DOM.pagination = this.DOM.el.querySelector('.p-page--home__hero__index--num');
		this.DOM.navigation = this.DOM.el.querySelector('.p-page--home__hero__nav');
		this.DOM.navigation.prevCtrl = this.DOM.navigation.querySelector('.p-page--home__hero__nav__btn--prev');
		this.DOM.navigation.nextCtrl = this.DOM.navigation.querySelector('.p-page--home__hero__nav__btn--next');
		this.DOM.entries = Array.from(this.DOM.el.querySelectorAll('.p-page--home__hero__page'), entry => new Entry(entry));
		this.entriesTotal = this.DOM.entries.length;
		this.currentPos = 0;
		this.layout();
		this.initEvents();
	}
	layout() {
		this.currentEntry = this.DOM.entries[this.currentPos];
		const factEl = this.currentEntry.DOM.facts.items[0];
		const factHeight = factEl.getBoundingClientRect().height + parseFloat(window.getComputedStyle(factEl).marginBottom);
		const paddingFactsStyle = window.getComputedStyle(this.currentEntry.DOM.facts.wrapper);
		const paddingFacts = parseFloat(paddingFactsStyle.paddingTop) + parseFloat(paddingFactsStyle.paddingBottom);
		if (win.width > 1440) {
			this.factsTranslation = win.height - 2.4 * factHeight - paddingFacts;
		} else if (win.width > 1024) {
			this.factsTranslation = win.height - 1.4 * factHeight - paddingFacts;
		} else if (win.width > 768) {
			this.factsTranslation = win.height - 1.6 * factHeight - paddingFacts;
		} else if (win.width > 0) {
			this.factsTranslation = 470;
		}
		for (let i = 0; i <= this.entriesTotal - 1; ++i) {
			const entry = this.DOM.entries[i];
			entry.DOM.expander.style.transform = `scale3d(0.54,1,1) translate3d(0px,${this.factsTranslation}px,0px)`;
			for (let j = 0, len = entry.DOM.facts.items.length; j <= len - 1; ++j) {
				entry.DOM.facts.ty = this.factsTranslation;
				const item = entry.DOM.facts.items[j];
				item.style.transform = `translate3d(0px,${this.factsTranslation}px,0px)`;
				if(j > 1) {
					//人気記事一覧画像ボタン初期表示設定
					item.style.opacity = 0;
					item.style.visibility = 'hidden';
				}
				else if(i === this.currentPos) {
					//人気記事一覧画像ボタン初期表示設定
					item.style.opacity = 1;
					item.style.visibility = 'visible';
				}
			}
		}
	}
	initEvents() {
		this.onPrevClick = () => this.navigate('prev');
		this.onNextClick = () => this.navigate('next');
		this.DOM.navigation.prevCtrl.addEventListener('click', this.onPrevClick);
		this.DOM.navigation.nextCtrl.addEventListener('click', this.onNextClick);
		this.DOM.factsCtrls.toggle.addEventListener('click', () => this.toggleFactsContainer());
		for (let i = 0; i <= this.entriesTotal - 1; ++i) {
			const entry = this.DOM.entries[i];
			entry.DOM.facts.items
				.filter(fact => fact.classList.contains('is-clickable'))
				//人気記事一覧画像クリック制御
				.forEach(clickableFact => clickableFact.addEventListener('click', () => this.preview(clickableFact.dataset.gallery)));
		}
		this.DOM.previewCloseCtrl.addEventListener('click', () => this.closePreview());			
		this.onResize = () => {
			win = {width: window.innerWidth, height: window.innerHeight};
			this.layout();
			if(this.isFactsOpen) {
				this.DOM.factsCtrls.more.style.opacity = 1;
				this.DOM.factsCtrls.less.style.opacity = 0;
				this.isFactsOpen = !this.isFactsOpen;
				this.toggleNavigationCtrls({opacity: 1, duration: 1});
				this.isFactsAnimating = false;
			}
			if(this.gallery) {
				this.DOM.previewCloseCtrl.style.opacity = 0;
				this.toggleGallery(this.gallery, {duration: 1,opacity: 0}).then(() => this.gallery = null);
			}
			this.DOM.el.classList.remove('is-open');
		};
		window.addEventListener('resize', debounce(() => this.onResize(), 20));	
	}
	navigate(direction) {
		if (this.isEntriesAnimating || this.isFactsAnimating) return;
		this.isEntriesAnimating = true;
		this.direction = direction;
		const newPos = this.currentPos = this.direction === 'next' ? 
			this.currentPos < this.entriesTotal - 1 ? this.currentPos + 1 : 0 : 
			this.currentPos = this.currentPos > 0 ? this.currentPos - 1 : this.entriesTotal - 1;
		const newEntry = this.DOM.entries[newPos];
		this.update(newEntry);
		//6秒間クリックできなくする
		this.DOM.factsCtrls.toggle.style.pointerEvents = 'none';
		function toggleFactsNotWorking() {
			setTimeout(function() {
				document.querySelector('.p-page--home__hero__menu__btn').style.pointerEvents = 'auto';
			}, 3000);
		}
		toggleFactsNotWorking();
	}
	update(newEntry) {
		const updateFn = () => {
			Promise.all([this.currentEntry.hide(this.direction), newEntry.show(this.direction), this.updatePageNumber()]).then(() => {
				this.isEntriesAnimating = false;
				this.currentEntry.DOM.el.classList.remove('is-current');
				newEntry.DOM.el.classList.add('is-current');
				this.currentEntry = newEntry;
			});
		};
		if(this.isFactsOpen) {
			this.toggleFactsContainer().then(updateFn);
		}
		else {
			updateFn();
		}
	}
	//スライド番号
	updatePageNumber() {
		anime.remove(this.DOM.pagination);
		let halfway = false;
		return anime({
			targets: this.DOM.pagination,
			duration: settings.pagination.duration,
			easing: 'easeInOutQuad',
			translateY: [
				{value: this.direction === 'next' ? '-100%' : '100%', delay: settings.pagination.delay},
				{value: [this.direction === 'next' ? '100%' : '-100%','0%'], delay: settings.pagination.duration}
			],
			opacity: [
				{value: 0, delay: settings.pagination.delay},
				{value: [0,1], delay: settings.pagination.duration}
			],
			update: (anime) => {
				if (anime.progress >= 50 && !halfway) {
					halfway = true;
					this.DOM.pagination.innerHTML = `0${this.currentPos + 1}`;
				}
			}
		}).finished;
	}
	toggleFactsContainer() {
		if (this.isFactsAnimating) {
			return;
		};
		this.isFactsAnimating = true;
		return Promise.all([
			this.toggleFactsCtrl(),
			this.animateExpander(),
			this.animateFactsItems()
		]).then(() => {
			this.isFactsOpen = !this.isFactsOpen;
			this.isFactsAnimating = false;
		});
	}
	preview(gallery) {
		if (this.isFactsAnimating || !gallery) return;
		this.isFactsAnimating = true;
		this.gallery = gallery;
		this.DOM.el.classList.add('is-open');
		Promise.all([
			this.toggleNavigationCtrls({
				opacity: 0
			}),
			//人気記事画像一覧表示ボタンを押した際の
			//人気記事ボタンのアニメーション制御
			this.toggleFactsCtrl({
				delay: 0,
				opacity: 0
			}),
			this.animateExpander({
				translateY: 0,
				scaleX: 1.05
			}),
			//人気記事画像一覧表示ボタンを押した際の
			//一覧表示ボタンのアニメーション内容
			this.animateFactsItems({
				translateY: 0,
				opacity: 0,
				delay: 0
			}),
			//閉じるボタン
			this.togglePreviewCloseCtrl({
				opacity: 1,
				delay: 800
			}),
			//人気記事画像一覧の表示時のアニメーション制御
			this.toggleGallery(gallery, {
				opacity: 1,
				scale: (target, index) => index ? [0.7,1] : [1,1],
				delay: (target, index) => index ? index * 100 + 700 : 700
			})
		]).then(() => this.isFactsAnimating = false);
	}
	closePreview() {
		if (this.isFactsAnimating) return;
		this.isFactsAnimating = true;
		Promise.all([
			this.toggleNavigationCtrls({
				opacity: 1
			}),
			this.toggleFactsCtrl({
				delay: 600,
				opacity: (target, index) => index,
			}),
			this.animateExpander({
				translateY: 0,
				scaleX: 0.54
			}),
			//人気記事画像一覧表示ボタン
			//一覧を開いたのちに閉じるボタンを押した際のアニメーション内容
			this.animateFactsItems({
				translateY: 0,
				opacity: 1,
				delay: 200
			}),
			this.togglePreviewCloseCtrl({
				opacity: 0,
			}),
			this.toggleGallery(this.gallery, {
				opacity: 0
			})
		]).then(() => {
			this.isFactsAnimating = false;
			this.gallery = null;
			this.DOM.el.classList.remove('is-open');
		});
	}
	//人気記事一覧黒背景サイズコントロール
	animateExpander(animeconfig) {
		return this.animate(Object.assign({
			targets: this.currentEntry.DOM.expander,
			duration: settings.expander.duration,
			easing: settings.expander.easing,
			delay: !this.isFactsOpen ? 0 : 300,
			translateY: !this.isFactsOpen ? [this.factsTranslation, 0] : this.factsTranslation,
			scaleX: [0.54,0.54]
		}, animeconfig));
	}
	animateGlobalNavi(animeconfig) {
		return this.animate(Object.assign({
			targets: this.currentEntry.DOM.globalNavi,
			duration: settings.globalNavi.duration,
			easing: settings.globalNavi.easing,
			delay: !this.isFactsOpen ? 0 : 300,
			translateY: !this.isFactsOpen ? [this.factsTranslation, 0] : this.factsTranslation,
			scaleX: [0.54,0.54]
		}, animeconfig));
	}
	//人気記事画像一覧表示ボタン制御
	animateFactsItems(animeconfig) {
		return this.animate(Object.assign({
			targets: this.currentEntry.DOM.facts.items,
			duration: settings.factsItems.duration,
			easing: settings.factsItems.easing,
			delay: (target, index, total) => !this.isFactsOpen ? (index+1) * 30 + 150 : (total-index-1) * 30,
			translateY: !this.isFactsOpen ? [this.factsTranslation,0] : this.factsTranslation,
			opacity: (target, index) => !this.isFactsOpen ? 1 : index > 1 ? 0 : 1,
			//ここでクリック時の表示制御を行う
			visibility: (target, index) => !this.isFactsOpen ? index = 2 ? target.style.visibility = 'visible' : target.style.visibility = 'hidden' : index > 1 ? target.style.visibility = 'hidden' : target.style.visibility = 'visible',
		}, animeconfig));
	}
	//人気記事の一覧ボタン制御
	toggleFactsCtrl(animeconfig) {
		return this.animate(Object.assign({
			targets: [this.DOM.factsCtrls.more, this.DOM.factsCtrls.less],
			duration: settings.factsCtrl.duration,
			easing: settings.factsCtrl.easing,
			opacity: (target, index) => index ? !this.isFactsOpen ? 1 : 0 : !this.isFactsOpen ? 0 : 1,
			overflowY: (target, index) => !this.isFactsOpen ? document.addEventListener("touchmove", scrollControl, { passive: false }) : document.removeEventListener('touchmove', scrollControl, { passive: false }),
		}, animeconfig));
	}
	//人気記事一覧クリック発火
	togglePreviewCloseCtrl(animeconfig) {
		return this.animate(Object.assign({
			targets: this.DOM.previewCloseCtrl,
			duration: settings.previewCloseCtrl.duration,
			easing: settings.previewCloseCtrl.easing,
			overflowY: (target, index) => !this.isFactsOpen ?
			document.removeEventListener('touchmove', scrollControl, { passive: false }) : document.addEventListener("touchmove", scrollControl, { passive: false }),
		}, animeconfig));
	}
	toggleNavigationCtrls(animeconfig) {
		return this.animate(Object.assign({
			targets: [this.DOM.navigation.prevCtrl, this.DOM.navigation.nextCtrl],
			duration: settings.navigationCtrls.duration,
			easing: settings.navigationCtrls.easing
		}, animeconfig));
	}
	toggleGallery(gallery, animeconfig) {
		return this.animate(Object.assign({
			targets: this.DOM.el.querySelectorAll(`#${gallery} > .p-page--home__hero__gallery__item`),
			duration: settings.gallery.duration,
			easing: settings.gallery.easing
		}, animeconfig));
	}
	animate(opts) {
		anime.remove(opts.targets);
		return anime(opts).finished;
	}
};

export function setHeight() {
	let width = window.innerWidth,
		height = window.innerHeight;
	if(width < 480) {
		TweenMax.set(".p-page--home__hero", {
			height: height
		}),
		TweenMax.set(".p-page--home__hero__menu", {
			height: height
		}),
		TweenMax.set(".p-page--home__hero__gallery", {
			height: height
		})
	}
}

export class scrollFade {
    constructor(elm) {
        const target = document.querySelector(elm);
        window.addEventListener('scroll', function() {
            let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            if(scrollTop >= 1) {
                gsap.to(target, .4, {
                    autoAlpha: 1
                });
            } else {
                gsap.to(target, .4, {
                    autoAlpha: 0
                });
            }
        })
    }
}