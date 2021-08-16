import { fadingUp } from './intersectionObserver';

export function loadingAuto(hook, isAdd, isCurrent) {
    const api_url = 'https://sumika.casa/wp-content/themes/sumika.casa/module-loading.php',
        add = isAdd,
        container = document.getElementById('js-infinite');
    let current = isCurrent,
        flag = false;
    window.addEventListener('scroll', function () {
        let documentHeight = container.clientHeight,
            clientRect = container.getBoundingClientRect(),
            scrollTop = window.pageYOffset || document.documentElement.scrollTop,
            clientRectY = clientRect.top + scrollTop,
            windowsHeight = window.innerHeight,
            scrollPosition = windowsHeight + scrollTop;
        if (scrollPosition >= documentHeight + clientRectY -100) {
            if (flag === false) {
                flag = true;
                fetch(api_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: `hook_post_type=${hook}&currently_loaded_count=${current}&additional_loading_count=${add}`
                })
                .then((response) => {
                    return response.json();
                })
                .then((json) => {
                    json.content.forEach((item) => {
                        container.insertAdjacentHTML('beforeEnd', item);
                    });
                    documentHeight = container.clientHeight;
                    fadingUp();
                    current = current + add;
                    flag = false;
                    if(json.complete) {
                        flag = true;
                    }
                })
                .catch((error) => {
                    return error.message;
                });
            }
        }
    });
}