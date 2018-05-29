'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var QuestionList = function () {
    function QuestionList() {
        _classCallCheck(this, QuestionList);

        this.list = [];
        this.stages = [0, 1, 2, 3, 4];
        this.stageSize = 5;
    }

    _createClass(QuestionList, [{
        key: 'addQuestion',
        value: function addQuestion(questionInfo, id) {
            this.list.push(new Question(questionInfo, id));
        }
    }, {
        key: 'getQuestionById',
        value: function getQuestionById(id) {
            for (var i = 0; i < this.list.length; i++) {
                if (this.list[i].id === id) {
                    return this.list[i];
                }
            }
        }
    }, {
        key: 'getCorrectAnswersCountOnStage',
        value: function getCorrectAnswersCountOnStage(stage) {
            var start = stage * this.stageSize;
            var end = start + this.stageSize;
            var result = 0;
            for (var i = start; i < end; i++) {
                result += this.list[i].validateAnswer();
            }
            return result;
        }
    }, {
        key: 'printQuestions',
        value: function printQuestions() {
            console.log(this.list);
        }
    }]);

    return QuestionList;
}();

var ResultsNav = function () {
    function ResultsNav(num, cardsParent) {
        _classCallCheck(this, ResultsNav);

        this.maxNum = num;
        this.root = cardsParent;
        this.currentNode = document.createElement('span');
        this.currentNode.textContent = "1";
        this.separator = document.createElement('span');
        this.separator.textContent = "/";
        this.currentNum = 1;
        this.navNode = document.createElement('div');
        this.navNode.className = "nav-results";

        this.left = document.createElement('div');
        this.right = document.createElement('div');
    }

    _createClass(ResultsNav, [{
        key: 'render',
        value: function render() {
            var self = this;

            this.left.className = "nav-control nav-left nav-disabled";
            this.left.textContent = "<";
            this.left.onclick = function () {
                if (self.currentNum > 1) {
                    self.currentNum--;
                    self.update();
                    self.right.classList.remove('nav-disabled');
                }
                if (self.currentNum === 1) {
                    self.left.classList.add('nav-disabled');
                }
            };

            this.right.className = "nav-control nav-right";
            this.right.textContent = ">";
            this.right.onclick = function () {
                if (self.currentNum < self.maxNum) {
                    self.currentNum++;
                    self.update();
                    self.left.classList.remove('nav-disabled');
                }
                if (self.currentNum === self.maxNum) {
                    self.right.classList.add('nav-disabled');
                }
            };
            var maxNum = document.createElement('span');
            maxNum.textContent = this.maxNum.toString();

            this.navNode.appendChild(this.left);
            this.navNode.appendChild(this.currentNode);
            this.navNode.appendChild(this.separator);
            this.navNode.appendChild(maxNum);
            this.navNode.appendChild(this.right);

            return this.navNode;
        }
    }, {
        key: 'update',
        value: function update() {
            this.currentNode.textContent = this.currentNum.toString();
            var blocks = this.root.getElementsByClassName('parent-wrapper');
            var offset = (this.currentNum - 1) * 100;
            for (var i = 0; i < blocks.length; i++) {
                blocks[i].style.left = "-" + offset.toString() + "%";
            }
        }
    }]);

    return ResultsNav;
}();

var RoundsNav = function () {
    function RoundsNav(levels) {
        _classCallCheck(this, RoundsNav);

        this.levels = levels;
        this.roundNodes = [];
        this.roundsNode = document.createElement('div');
        this.roundsNode.className = "rounds-container";
    }

    _createClass(RoundsNav, [{
        key: 'render',
        value: function render() {
            for (var i = 0; i < this.levels.length; i++) {
                this.roundNodes[i] = document.createElement('div');
                this.roundNodes[i].className = "round-circle";
                this.roundNodes[i].textContent = (i + 1).toString();
                if (i === 0) {
                    this.roundNodes[i].classList.add('current');
                }
                this.roundsNode.appendChild(this.roundNodes[i]);
            }
            return this.roundsNode;
        }
    }, {
        key: 'updateLevel',
        value: function updateLevel(level, index) {
            this.roundNodes[index].textContent = level;
            var i = index - 1;
            if (i >= 0) {
                this.roundNodes[i].classList.remove('current');
                this.roundNodes[i].classList.add('passed');
            }
            this.roundNodes[index].classList.add('current');
        }
    }]);

    return RoundsNav;
}();

var Tooltip = function () {
    function Tooltip(node, message) {
        _classCallCheck(this, Tooltip);

        this.node = node;

        this.closer = document.createElement('div');

        this.closer.id = "close-tooltip";
        this.closer.textContent = "X";
        var self = this;

        this.closer.onclick = function () {
            self.node.style.height = "0px";
        };
        this.node.appendChild(this.closer);
    }

    _createClass(Tooltip, [{
        key: 'render',
        value: function render() {}
    }, {
        key: 'show',
        value: function show() {
            this.node.style.height = "66px";
        }
    }]);

    return Tooltip;
}();

var Question = function () {
    function Question(question, number) {
        _classCallCheck(this, Question);

        this.isCorrect = false;
        this.userAnswer = 0;
        this.id = number;
        this.theme = question['theme'];
        this.word = question['word_uk'];
        this.correct = question['correct'];
        this.color = question['color'];
        this.answers = [[question['correct'], question['number'], question['tr1'], question['word2'], question['tr2'], question['word3'], question['tr3'], question['sen1'], question['sen2']], [question['answer1'], question['number1'], question['tr11'], question['word21'], question['tr21'], question['word31'], question['tr31'], question['sen11'], question['sen21']], [question['answer2'], question['number2'], question['tr12'], question['word22'], question['tr22'], question['word32'], question['tr32'], question['sen12'], question['sen22']], [question['answer3'], question['number3'], question['tr13'], question['word23'], question['tr23'], question['word33'], question['tr33'], question['sen13'], question['sen23']], [question['answer4'], question['number4'], question['tr14'], question['word24'], question['tr24'], question['word34'], question['tr34'], question['sen14'], question['sen24']], [question['answer5'], question['number5'], question['tr15'], question['word25'], question['tr25'], question['word35'], question['tr35'], question['sen15'], question['sen25']]];
    }

    _createClass(Question, [{
        key: 'selectAnswer',
        value: function selectAnswer(event) {
            var block = event.target;
            if (event.target.className !== "block-wrapper") {
                block = block.parentNode;
                while (block.className !== "block-wrapper") {
                    block = block.parentNode;
                }
            }
            if (event.target.className === "test__answer") {
                //let answer = event.target.textContent();
                this.userAnswer = event.target.textContent;
            } else {
                var answer = void 0;
                var baseNode = event.target;
                if (event.target.className === "test__tr" || event.target.className === "test__sen" || event.target.className === "test__word") {
                    baseNode = baseNode.parentNode;
                }
                if (baseNode.className === "test__header") {
                    baseNode = baseNode.nextSibling;
                }
                if (baseNode.className === "test__theme") {
                    baseNode = baseNode.parentNode;
                    baseNode = baseNode.nextSibling;
                }
                if (baseNode.className === "test__container" || baseNode.className === "test__container selected") {
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
            var cards = block.getElementsByClassName("test__container");
            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
                for (var _iterator = cards[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                    var el = _step.value;

                    el.classList.remove('selected');
                    el.style.opacity = 0.75;
                }
            } catch (err) {
                _didIteratorError = true;
                _iteratorError = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion && _iterator.return) {
                        _iterator.return();
                    }
                } finally {
                    if (_didIteratorError) {
                        throw _iteratorError;
                    }
                }
            }

            var selected = event.target;
            while (selected.className !== "test__container") {
                selected = selected.parentNode;
            }
            selected.classList.add('selected');
            selected.style.opacity = 1;
        }
    }, {
        key: 'validateAnswer',
        value: function validateAnswer() {
            if (this.correct == this.userAnswer) {
                return 1;
            } else {
                return 0;
            }
        }
    }]);

    return Question;
}();

var QuestionView = function () {
    function QuestionView() {
        _classCallCheck(this, QuestionView);
    }

    _createClass(QuestionView, null, [{
        key: 'shaffleElements',
        value: function shaffleElements(arr) {
            arr.sort(function () {
                return 0.5 - Math.random();
            });
        }
    }, {
        key: 'renderNode',
        value: function renderNode(question, rootNode, number, active, color) {
            var doc = document;
            QuestionView.shaffleElements(question.answers);

            var wrapper = doc.createElement('div');
            wrapper.className = 'block-wrapper';

            var wrapperParent = doc.createElement('div');
            wrapperParent.className = 'parent-wrapper';

            var word = doc.createElement('div');
            word.className = "word-uk";
            word.textContent = (number + 1).toString() + ". " + question.word;
            wrapper.appendChild(word);

            for (var i = 0; i < question.answers.length; i++) {
                var container = doc.createElement('div');
                container.className = "test__container";
                if (active) {
                    if (question.correct === question.answers[i][0]) {
                        container.classList.add('before-ok');
                    } else if (question.userAnswer === question.answers[i][0]) {
                        container.classList.add('before-error');
                    } else {
                        container.classList.add('before-hidden');
                    }
                }

                if (!active) {
                    container.addEventListener('click', function (event) {
                        question.selectAnswer(event);
                    });
                }

                var header = doc.createElement('div');
                header.className = "test__header";
                header.style.backgroundColor = question.color;

                var content = doc.createElement('div');
                content.className = "test__content";
                var answ = doc.createElement('span');
                answ.className = "test__answer";
                answ.textContent = question.answers[i][0];
                var _number = doc.createElement('span');
                _number.className = "test__number";
                _number.textContent = question.answers[i][1];
                var theme = doc.createElement('span');
                theme.className = "test__theme";
                theme.textContent = question.theme;

                header.appendChild(_number);
                header.appendChild(theme);
                container.appendChild(header);
                content.appendChild(answ);

                //new fields
                if (question.answers[i][2] !== null) {
                    var tr1 = document.createElement('span');
                    tr1.className = "test__tr";
                    tr1.textContent = question.answers[i][2];
                    content.appendChild(tr1);
                }
                if (question.answers[i][3] !== null) {
                    var _tr = document.createElement('span');
                    _tr.className = "test__word";
                    _tr.textContent = question.answers[i][3];
                    content.appendChild(_tr);
                }
                if (question.answers[i][4] !== null) {
                    var _tr2 = document.createElement('span');
                    _tr2.className = "test__tr";
                    _tr2.textContent = question.answers[i][4];
                    content.appendChild(_tr2);
                }
                if (question.answers[i][5] !== null) {
                    var _tr3 = document.createElement('span');
                    _tr3.className = "test__word";
                    _tr3.textContent = question.answers[i][5];
                    content.appendChild(_tr3);
                }
                if (question.answers[i][6] !== null) {
                    var _tr4 = document.createElement('span');
                    _tr4.className = "test__tr";
                    _tr4.textContent = question.answers[i][6];
                    content.appendChild(_tr4);
                }
                if (question.answers[i][7] !== null) {
                    var _tr5 = document.createElement('span');
                    _tr5.className = "test__sen";
                    _tr5.textContent = question.answers[i][7];
                    content.appendChild(_tr5);
                }
                if (question.answers[i][8] !== null) {
                    var _tr6 = document.createElement('span');
                    _tr6.className = "test__sen";
                    _tr6.textContent = question.answers[i][8];
                    content.appendChild(_tr6);
                }

                container.appendChild(content);
                wrapper.appendChild(container);
                wrapperParent.appendChild(wrapper);
            }
            rootNode.appendChild(wrapperParent);
        }
    }]);

    return QuestionView;
}();

var Reader = function () {
    function Reader(level, color) {
        var host = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "https://englishstudent.net/";

        _classCallCheck(this, Reader);

        this.level = level;
        this.host = host;
        this.status = false;
        this.test;
        this.newTest = [];
        this.questionsCount = 5;
        this.from = 0;
        this.color = color;
    }

    _createClass(Reader, [{
        key: 'loadCallback',
        value: function loadCallback(response) {
            this.test = JSON.parse(response);
            var self = this;

            //this.shaffleElements();
            //this.clearElements();
            this.status = true;
            self.jsonToObject();
            this.shaffleElements();
            console.log(this.level, 'loaded elements...');
        }
    }, {
        key: 'jsonToObject',
        value: function jsonToObject() {
            var json = this.test;
            var stoper = json['features'].length;
            var looper = 0; //globalJson counter
            var answers = 6; //inline
            var counter = 0; //over objects
            while (looper < stoper) {
                this.newTest[counter] = [];
                if (json['features'][looper + 1] != undefined) {
                    this.newTest[counter]['word_uk'] = json['features'][looper]['properties']['Field2'];
                    this.newTest[counter]['correct'] = json['features'][looper + 1]['properties']['Field4'];
                    this.newTest[counter]['theme'] = json['features'][looper + 1]['properties']['Field3'];
                    this.newTest[counter]['number'] = parseInt(json['features'][looper + 1]['properties']['Field2']);
                    this.newTest[counter]['color'] = this.color;
                    //new fields
                    this.newTest[counter]['tr1'] = json['features'][looper + 1]['properties']['Field5'];
                    this.newTest[counter]['word2'] = json['features'][looper + 1]['properties']['Field6'];
                    this.newTest[counter]['tr2'] = json['features'][looper + 1]['properties']['Field7'];
                    this.newTest[counter]['word3'] = json['features'][looper + 1]['properties']['Field8'];
                    this.newTest[counter]['tr3'] = json['features'][looper + 1]['properties']['Field9'];
                    this.newTest[counter]['sen1'] = json['features'][looper + 1]['properties']['Field10'];
                    this.newTest[counter]['sen2'] = json['features'][looper + 1]['properties']['Field11'];
                    for (var i = 2; i <= answers; i++) {
                        var inlineCounter = (i - 1).toString();
                        this.newTest[counter]['answer' + inlineCounter] = json['features'][looper + i]['properties']['Field4'];
                        this.newTest[counter]['number' + inlineCounter] = parseInt(json['features'][looper + i]['properties']['Field2']);
                        this.newTest[counter]['color'] = this.color;
                        this.newTest[counter]['tr1' + inlineCounter] = json['features'][looper + i]['properties']['Field5'];
                        this.newTest[counter]['word2' + inlineCounter] = json['features'][looper + i]['properties']['Field6'];
                        this.newTest[counter]['tr2' + inlineCounter] = json['features'][looper + i]['properties']['Field7'];
                        this.newTest[counter]['word3' + inlineCounter] = json['features'][looper + i]['properties']['Field8'];
                        this.newTest[counter]['tr3' + inlineCounter] = json['features'][looper + i]['properties']['Field9'];
                        this.newTest[counter]['sen1' + inlineCounter] = json['features'][looper + i]['properties']['Field10'];
                        this.newTest[counter]['sen2' + inlineCounter] = json['features'][looper + i]['properties']['Field11'];
                    }
                }
                looper += 7;
                counter++;
            }
        }
    }, {
        key: 'loadJSON',
        value: function loadJSON() {
            var xobj = new XMLHttpRequest();
            var self = this;
            xobj.overrideMimeType("application/json");
            xobj.open('GET', this.host + "devResources/js/test/json/" + this.level + '.json', false);

            xobj.onreadystatechange = function () {
                self.loadCallback(xobj.responseText);
            };
            xobj.send(null);
        }
    }, {
        key: 'shaffleElements',
        value: function shaffleElements() {
            //this.newTest.sort(function() { return 0.5 - Math.random() });
            for (var i = this.newTest.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var _ref = [this.newTest[j], this.newTest[i]];
                this.newTest[i] = _ref[0];
                this.newTest[j] = _ref[1];
            }
            //return a;
        }
    }, {
        key: 'clearElements',
        value: function clearElements() {
            for (var i = 0; i < this.test['features'].length - 1; i++) {

                for (var j = 1; j < 6; j++) {
                    if (this.test['features'][i]['properties']['answer' + j.toString()] != null) {
                        this.test['features'][i]['properties']['answer' + j.toString()] = this.test['features'][i]['properties']['answer' + j.toString()].replace(/[{()}]/g, '');
                        this.test['features'][i]['properties']['number' + j.toString()] = this.test['features'][i]['properties']['answer' + j.toString()].replace(/^\D+/g, '');
                        this.test['features'][i]['properties']['answer' + j.toString()] = this.test['features'][i]['properties']['answer' + j.toString()].replace(/[0-9]/g, '');
                    }
                }
            }
        }
    }, {
        key: 'getAllElements',
        value: function getAllElements() {
            return this.newTest;
        }
    }, {
        key: 'getRandomElements',
        value: function getRandomElements() {
            //if (this.test['features'].length > this.questionsCount){
            var arr = [];
            for (var i = this.from; i < this.from + this.questionsCount; i++) {
                arr.push(this.newTest[i]);
            }
            this.from += this.questionsCount;
            return arr;
            //} else {
            //  return null;
            // }
        }
    }]);

    return Reader;
}();

var Test = function () {
    function Test(levels, colors, buttonText) {
        _classCallCheck(this, Test);

        this.node = document.getElementById('questions');
        this.readers = [];
        this.levels = levels;
        this.questionCounter = 0;
        this.currentStage = 0;
        this.totalStages = 5;
        this.buttonText = buttonText;
        this.questionsList = new QuestionList();
        this.roundNav = new RoundsNav(levels);
        this.resultsNav = new ResultsNav(25, this.node);
        this.tooltip = new Tooltip(document.getElementById('test-tooltip'), "");

        this.colors = colors;
        for (var i = 0; i < levels.length; i++) {
            this.readers[levels[i]] = new Reader(levels[i], colors[i]);
        }
        this.levelId = 0;
        this.currentLevel = levels[this.levelId];
        this.readers[this.currentLevel].loadJSON();
    }

    _createClass(Test, [{
        key: 'loadTest',
        value: function loadTest() {
            if (!this.readers[this.currentLevel].status) {
                this.readers[this.currentLevel].loadJSON();
            }
        }
    }, {
        key: 'clearQuestionsView',
        value: function clearQuestionsView() {
            while (this.node.firstChild) {
                this.node.removeChild(this.node.firstChild);
            }
        }
    }, {
        key: 'createQuestions',
        value: function createQuestions() {
            this.loadTest();
            var questions = this.readers[this.currentLevel].getRandomElements();
            var _iteratorNormalCompletion2 = true;
            var _didIteratorError2 = false;
            var _iteratorError2 = undefined;

            try {
                for (var _iterator2 = questions[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
                    var value = _step2.value;

                    this.questionsList.addQuestion(value, this.questionCounter++);
                }
            } catch (err) {
                _didIteratorError2 = true;
                _iteratorError2 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion2 && _iterator2.return) {
                        _iterator2.return();
                    }
                } finally {
                    if (_didIteratorError2) {
                        throw _iteratorError2;
                    }
                }
            }
        }
    }, {
        key: 'createWholeQuestions',
        value: function createWholeQuestions() {
            this.loadTest();
            var questions = this.readers[this.currentLevel].getAllElements();
            var _iteratorNormalCompletion3 = true;
            var _didIteratorError3 = false;
            var _iteratorError3 = undefined;

            try {
                for (var _iterator3 = questions[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
                    var value = _step3.value;

                    this.questionsList.addQuestion(value, this.questionCounter++);
                }
            } catch (err) {
                _didIteratorError3 = true;
                _iteratorError3 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion3 && _iterator3.return) {
                        _iterator3.return();
                    }
                } finally {
                    if (_didIteratorError3) {
                        throw _iteratorError3;
                    }
                }
            }
        }
    }, {
        key: 'renderCurrent',
        value: function renderCurrent() {
            this.clearQuestionsView();
            var size = this.questionsList.stageSize;
            for (var i = 0; i < this.questionsList.stageSize; i++) {
                QuestionView.renderNode(this.questionsList.getQuestionById(this.currentStage * size + i), this.node, this.currentStage * size + i, false, this.colors[this.levelId]);
            }
        }
    }, {
        key: 'renderWholeQuestions',
        value: function renderWholeQuestions() {
            console.log('whole.render');

            for (var i = 0; i < this.levels.length; i++) {
                var arr = this.readers[this.levels[i]].getAllElements();
                console.log(arr.length);
                this.createWholeQuestions();
                this.levelId++;
                this.currentLevel = this.levels[this.levelId];
            }
            for (var j = 0; j < 300; j++) {
                console.log(j);
                QuestionView.renderNode(this.questionsList.getQuestionById(j), this.node, j, false, this.colors[this.levelId]);
            }
        }
    }, {
        key: 'renderResults',
        value: function renderResults() {
            this.roundNav.roundsNode.remove();
            this.clearQuestionsView();
            this.node.classList.add('results-view');
            var bg = document.getElementById('testPage');
            bg.classList.add('bg-silver');
            var size = this.questionsList.list.length;
            for (var i = 0; i < size; i++) {
                QuestionView.renderNode(this.questionsList.getQuestionById(i), this.node, i, true, this.colors[this.levelId]);
            }
            var navResults = document.getElementById('result-nav');
            navResults.appendChild(this.resultsNav.render());

            var recommend = document.getElementById('recomend');
            recommend.style.display = "block";
            var rec = document.getElementById('rec-level');
            rec.textContent = rec.textContent + this.levels[this.levelId];
            console.log(rec);
        }
    }, {
        key: 'updateCurrentLevel',
        value: function updateCurrentLevel(answers) {
            if (answers > 4) {
                this.levelId++;
            } else if (answers < 3 && this.levelId > 0) {
                this.levelId--;
            }
            console.log("answers", answers);
            console.log("Go to", this.levelId);
        }
    }, {
        key: 'run',
        value: function run() {
            var wr = document.createElement('div');
            wr.className = "button-buy-wrapper test-button";
            var loader = document.createElement('a');
            loader.className = "blue-btn";
            wr.appendChild(loader);
            var self = this;
            loader.textContent = "StartTest";
            loader.onclick = function (e) {
                e.preventDefault();
                var answerd = self.node.getElementsByClassName('selected').length;
                if (self.currentStage !== 0 && answerd < 5) {
                    self.tooltip.show();
                    return false;
                } else {
                    self.tooltip.closer.click();
                }
                if (self.currentStage < self.totalStages) {
                    if (self.currentStage !== 0) {
                        self.updateCurrentLevel(self.questionsList.getCorrectAnswersCountOnStage(self.currentStage - 1));
                        self.currentLevel = self.levels[self.levelId];
                        $("html, body").animate({ scrollTop: $('#rounds-navigator').offset().top - 100 }, 1000);
                    } else {
                        var nav = document.getElementById('rounds-navigator');
                        nav.appendChild(self.roundNav.render());
                    }
                    self.roundNav.updateLevel(self.levels[self.levelId], self.currentStage);
                    self.createQuestions();
                    self.renderCurrent();
                    //self.currentLevel = self.levels[self.currentStage];
                    self.currentStage++;
                    if (self.currentStage === self.totalStages) {
                        loader.textContent = self.buttonText[1];
                    } else {
                        loader.textContent = (self.currentStage + 1).toString() + " " + self.buttonText[0];
                        var arrow = document.createElement('span');
                        arrow.textContent = " >";
                        loader.appendChild(arrow);
                    }
                } else {
                    self.updateCurrentLevel(self.questionsList.getCorrectAnswersCountOnStage(self.totalStages - 1));
                    self.renderResults();
                    self.finishTest();
                    $("html, body").animate({ scrollTop: $('#rounds-navigator').offset().top - 100 }, 1000);
                    //to do after test complete
                    wr.remove();
                }
            };
            document.body.appendChild(wr);
            loader.click();
        }
    }, {
        key: 'getList',
        value: function getList() {
            return this.questionsList;
        }
    }, {
        key: 'cartBinder',
        value: function cartBinder() {
            //where code to bind main page cart and test dynemic results
            var doc = document;
            var button = doc.getElementsByClassName('js-link')[0];
            console.log("cartBinder", "clicked");
            var main = doc.getElementsByClassName('screen-cart')[0];
            main.style.display = "block";
            var currentBox = doc.getElementsByClassName("global-p" + button.id);
            var id = button.id.substr(1);
            var clickItem = doc.getElementsByClassName("inc" + id)[0];
            clickItem.click();
            var lvl = button.getAttribute('data-level');
            if (lvl === "b1" || lvl === "b2") {
                var nextId = parseInt(id) + 1;
                var clickItem2 = doc.getElementsByClassName("inc" + nextId.toString())[0];
                clickItem2.click();
            }
        }
    }, {
        key: 'finishTest',
        value: function finishTest() {
            var level = "c2";
            if (this.levelId < 5) {
                level = this.levels[this.levelId].toLowerCase();
            }
            console.log(level);
            var self = this;
            $.ajax({
                type: "POST",
                url: "/uk/test/product",
                dataType: "JSON",
                data: {
                    product: level
                },
                error: function error(response) {
                    console.log('error', response);
                },
                success: function success(response) {
                    console.log(response);
                    var box = document.getElementById('box-js');
                    box.style.removeProperty('display');

                    var arr = response['response'];

                    var title = document.getElementsByClassName('name-js')[0];
                    var description = document.getElementsByClassName('description-js')[0];
                    var imgContainer = document.getElementsByClassName('image-js')[0];
                    var btn = document.getElementsByClassName('js-link')[0];
                    btn.setAttribute('data-id', "product-" + arr[0]['id']);
                    btn.setAttribute('data-level', level);
                    //btn.classList.add("inc" + arr[0]['id']);
                    btn.id = "r" + arr[0]['id'];
                    btn.onclick = self.cartBinder;
                    for (var i = 0; i < arr.length; i++) {
                        title.textContent = title.textContent + arr[i]['title'];
                        if (arr[i]['description'] !== null) {
                            description.textContent = description.textContent + arr[i]['description'];
                        }
                        if (i + 1 !== arr.length) {
                            title.textContent = title.textContent + ",\r\n";
                            if (arr[i]['description'] !== null) {
                                description.textContent = description.textContent + ", ";
                            }
                        }
                        var img = document.createElement('img');
                        img.src = "/" + arr[i]['img'][0]['src'];
                        img.alt = arr[i]['img'][0]['alt'];
                        img.title = arr[i]['img'][0]['alt'];
                        imgContainer.appendChild(img);
                    }

                    var price = document.getElementsByClassName('new-price-js')[0];
                    var currency = " " + price.textContent;
                    price.textContent = arr[0]['price'] + currency;

                    var old = document.getElementsByClassName('old-price-js')[0];
                    if (arr['old'] > 0) {
                        var currencyOld = " " + old.textContent;
                        old.textContent = arr[0]['old'] + currencyOld;
                    } else {
                        old.remove();
                    }
                }
            });
        }
    }]);

    return Test;
}();