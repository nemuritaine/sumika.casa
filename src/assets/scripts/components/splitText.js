export class splitText {
	constructor(hook, options) {
        let opts = {
            'animation': 'explode',
			'colorize': null,
			'duration': 1.0,
			'justSplit': false,
			'scale': true,
            'type': 'lines',
			'useCSS': false,
			'useLite': false
        };
        if(options == null ||
            options == undefined ||
            options == '' ||
            (
                options.type !== 'lines' &&
                options.type !== 'letters'
            )
        ) {
            options = opts;
        };
        if(options.duration == undefined) {
            options.duration = 1.0;
        }

        let element = hook;
        this.element = element;

        if(element.classList.contains('is-split')) {
            element.innerHTML = '';
        } else {
            element.classList.add('is-split');
        }
        let userInput = element.textContent;
        let initialText = element.textContent;

        if(options.type == 'lines') {
            let result = this.splitWords(userInput);
			
            element.innerHTML = result;
            let obj = this.splitLines();

            if(options.justSplit == true) {
                return {
                    'id': element.getAttribute('id'),
                    'value': obj
                }
            }

            element.innerHTML = '';
			
            obj.forEach((value, index) => {
				let item = document.createElement('div');
				item.classList.add('c-split-lines__child');
				item.textContent = value.text;
				this.element.appendChild(item);
            });
        } else if(options.type == 'letters') {
            let result = this.splitLetters(initialText);
            if(options.justSplit == true) {
                return {
                    'id': element.getAttribute('id'),
                    'value': result
                };
            }
            element.innerHTML = '';
            element.innerHTML = result;
        }
    }
    splitLetters(userInput) {
        let arr = userInput.split('');
        for(let i = 0; i < arr.length; i++) {
            if(arr[i] == ' ') {
                arr[i] = '<span class="is-space">' + arr[i] + '</span>';
            } else {
                if(!arr[i].match(/\s\n\t\r/g) && arr[i]!="") arr[i] = '<span>' + arr[i] + '</span>';
            }
        }
        return arr.join(' ');
    }
    splitWords(userInput, justSplit) {
        let a = userInput.replace(/\n/g, '').split(' ');
        if(justSplit == true) {
            a.forEach((i, val) => {
                if(!val.match(/\n/) && val!='') a[i] = val;
            });
            return a;
        }
        a.forEach((val, i) => {
            if(!val.match(/\n/) && val != "") {
                a[i] = '<div class="c-word-measure">' + val + '</div>';
            }
        });
        let arr = a.join('');
        return arr;
    }
    splitLines(userInput) {
        let line = this.element.querySelectorAll('.c-word-measure'),
            count = line.length,
            lineAcc = [line[0].textContent],
            textAcc = [],
            lineLast = line[count - 1].getBoundingClientRect(),
            lineLastScrollTop =  window.pageYOffset || document.documentElement.scrollTop,
            lineLastTop = lineLast.top + lineLastScrollTop,
            lineLastY = lineLastTop;
        for(let i = 1; i < count; i++) {
            let rectPrev = line[i - 1].getBoundingClientRect(),
                scrollTopPrev = window.pageYOffset || document.documentElement.scrollTop,
                lineTopPrev = rectPrev.top + scrollTopPrev,
                prevY = lineTopPrev,
                rect = line[i].getBoundingClientRect(),
                scrollTop = window.pageYOffset || document.documentElement.scrollTop,
                lineTop = rect.top + scrollTop,
                Y = lineTop;
            if(Y == prevY) {
                lineAcc.push(line[i]).textContent;
            } else {
                textAcc.push({
                    text: lineAcc.join(' '),
                    top: prevY
                });
                lineAcc = [
                    line[i].textContent
                ];
            }
        }
        textAcc.push({
            text: lineAcc.join(' '),
            top: lineLastY
        });
        return textAcc;
    }
};