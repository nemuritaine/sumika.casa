export function pageNationChanger() {
    const selectElm = document.querySelector('select[name=pageselect]');
    if(selectElm) {
        selectElm.addEventListener('change', (e) => {
            let val = selectElm.selectedIndex;
            let url = selectElm.options[val].value;
            window.location.href = url;
        })
    }
}

export const getDevice = function() {
    const ua = navigator.userAgent.toLowerCase();
    if(ua.indexOf('iphone') > 0 || ua.indexOf('ipod') > 0 || ua.indexOf('android') > 0 && ua.indexOf('mobile') > 0) {
        return 'mobile';
    } else if (ua.indexOf('ipad') > 0 || ua.indexOf('android') > 0) {
        return 'tab';
    } else if (ua.indexOf('mac') > 0) {
        return 'mac';
    } else {
        return 'other';
    }
};

export function resizeViewport() {
    if(getDevice() === 'mobile') {
        document.querySelector('meta[name="viewport"]').setAttribute('content', 'width=device-width');
    } else {
        document.querySelector('meta[name="viewport"]').setAttribute('content', 'width=1200');
    }
};