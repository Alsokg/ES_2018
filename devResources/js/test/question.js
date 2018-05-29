class Question{
    constructor(question, number){
        this.isCorrect = false;
        this.userAnswer = 0;
        this.id = number;
        this.theme = question['theme'];
        this.word = question['word_uk'];
        this.correct = question['correct'];
        this.color = question['color'];
        this.answers = [
            [
                question['correct'],
                question['number'],
                question['tr1'],
                question['word2'],
                question['tr2'],
                question['word3'],
                question['tr3'],
                question['sen1'],
                question['sen2']
            ],
            [
                question['answer1'],
                question['number1'],
                question['tr11'],
                question['word21'],
                question['tr21'],
                question['word31'],
                question['tr31'],
                question['sen11'],
                question['sen21']
            ],
            [
                question['answer2'],
                question['number2'],
                question['tr12'],
                question['word22'],
                question['tr22'],
                question['word32'],
                question['tr32'],
                question['sen12'],
                question['sen22']
            ],
            [
                question['answer3'],
                question['number3'],
                question['tr13'],
                question['word23'],
                question['tr23'],
                question['word33'],
                question['tr33'],
                question['sen13'],
                question['sen23']
            ],
            [
                question['answer4'],
                question['number4'],
                question['tr14'],
                question['word24'],
                question['tr24'],
                question['word34'],
                question['tr34'],
                question['sen14'],
                question['sen24']
            ],
            [
                question['answer5'],
                question['number5'],
                question['tr15'],
                question['word25'],
                question['tr25'],
                question['word35'],
                question['tr35'],
                question['sen15'],
                question['sen25']
            ]
        ];
    }
    selectAnswer(event){
        let block = event.target;
        if (event.target.className !== "block-wrapper"){
            block = block.parentNode;
            while (block.className !== "block-wrapper"){
                block = block.parentNode;
            }
        }
        if (event.target.className === "test__answer"){
            //let answer = event.target.textContent();
            this.userAnswer = event.target.textContent;
        } else {
            let answer;
            let baseNode = event.target;
            if (event.target.className === "test__tr" || event.target.className === "test__sen" || event.target.className === "test__word"){
                baseNode = baseNode.parentNode;
            }
            if (baseNode.className === "test__header"){
                baseNode = baseNode.nextSibling;
            }
            if (baseNode.className === "test__theme"){
                baseNode = baseNode.parentNode;
                baseNode = baseNode.nextSibling;
            }
            if (baseNode.className === "test__container" || baseNode.className === "test__container selected"){
                baseNode = baseNode.childNodes[1];
            }

            for (var i = 0; i < baseNode.childNodes.length; i++) {
                if (baseNode.childNodes[i].className === "test__answer") {
                    answer = baseNode.childNodes[i];
                    break;
                }        
            }
            this.userAnswer = answer.textContent;
        }
        let cards = block.getElementsByClassName("test__container");
        for (let el of cards){
            el.classList.remove('selected');
            el.style.opacity = 0.75;
        }
        let selected = event.target;
        while (selected.className !== "test__container"){
            selected = selected.parentNode;
        }
        selected.classList.add('selected');
        selected.style.opacity = 1;
    }
    validateAnswer(){
        if (this.correct == this.userAnswer){
            return 1;
        } else {
            return 0;
        }
    }
}