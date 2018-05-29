class Test{
    constructor(levels, colors, buttonText){
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
        for (let i = 0; i < levels.length; i++){
            this.readers[levels[i]] = new Reader(levels[i], colors[i]);
        }
        this.levelId = 0;
        this.currentLevel = levels[this.levelId];
        this.readers[this.currentLevel].loadJSON();
        
    }
    loadTest(){
        if (!this.readers[this.currentLevel].status){
            this.readers[this.currentLevel].loadJSON();
        } 
    }
    clearQuestionsView(){
        while (this.node.firstChild) {
            this.node.removeChild(this.node.firstChild);
        }
    }
    createQuestions(){
        this.loadTest();
        let questions = this.readers[this.currentLevel].getRandomElements();
        for (let value of questions){
            this.questionsList.addQuestion(value, this.questionCounter++);
        }
    }
    createWholeQuestions(){
        this.loadTest();
        let questions = this.readers[this.currentLevel].getAllElements();
        for (let value of questions){
            this.questionsList.addQuestion(value, this.questionCounter++);
        }
    }
    renderCurrent(){
        this.clearQuestionsView();
        const size = this.questionsList.stageSize;
        for (let i = 0; i < this.questionsList.stageSize; i++){
            QuestionView.renderNode(this.questionsList.getQuestionById(this.currentStage*size + i), this.node, this.currentStage*size + i, false, this.colors[this.levelId]);
        }
    }
    renderWholeQuestions(){
        console.log('whole.render');
        
        for (let i = 0; i < this.levels.length; i++){
            let arr = this.readers[this.levels[i]].getAllElements();
            console.log(arr.length);
            this.createWholeQuestions();
            this.levelId++;
            this.currentLevel = this.levels[this.levelId];
        }
                    for (let j = 0; j < 300; j++){
                console.log(j);
                QuestionView.renderNode(this.questionsList.getQuestionById(j), this.node, j, false, this.colors[this.levelId]);
            }
    }
    renderResults(){
        this.roundNav.roundsNode.remove();
        this.clearQuestionsView();
        this.node.classList.add('results-view');
        let bg = document.getElementById('testPage');
        bg.classList.add('bg-silver');
        const size = this.questionsList.list.length;
        for (let i = 0; i < size; i++){
            QuestionView.renderNode(this.questionsList.getQuestionById(i), this.node, i, true, this.colors[this.levelId]);
        }
        let navResults = document.getElementById('result-nav');
        navResults.appendChild(this.resultsNav.render());
        
        let recommend = document.getElementById('recomend');
        recommend.style.display = "block";
        let rec = document.getElementById('rec-level');
        rec.textContent = rec.textContent + this.levels[this.levelId];
        console.log(rec);
    }
    updateCurrentLevel(answers){
        if (answers > 4){
            this.levelId++; 
        } else if(answers < 3 && this.levelId > 0){
            this.levelId--;
        }
        console.log("answers", answers);
        console.log("Go to", this.levelId);
    }
    run(){
        let wr = document.createElement('div');
        wr.className = "button-buy-wrapper test-button";
        let loader = document.createElement('a');
        loader.className = "blue-btn"
        wr.appendChild(loader);
        let self = this;
        loader.textContent = "StartTest";
        loader.onclick = function(e){
            e.preventDefault();
            let answerd = self.node.getElementsByClassName('selected').length;
            if (self.currentStage !== 0 && answerd < 5){
                self.tooltip.show();
                return false;
            } else {
                self.tooltip.closer.click();
            }
            if (self.currentStage < self.totalStages){
                if (self.currentStage !== 0){
                    self.updateCurrentLevel(self.questionsList.getCorrectAnswersCountOnStage(self.currentStage - 1));
                    self.currentLevel = self.levels[self.levelId];
                    $("html, body").animate({ scrollTop: $('#rounds-navigator').offset().top - 100 }, 1000);
                } else {
                    let nav = document.getElementById('rounds-navigator');
                    nav.appendChild(self.roundNav.render());
                }
                self.roundNav.updateLevel(self.levels[self.levelId], self.currentStage);
                self.createQuestions();
                self.renderCurrent();
                //self.currentLevel = self.levels[self.currentStage];
                self.currentStage++;
                if (self.currentStage === self.totalStages){
                    loader.textContent = self.buttonText[1];
                } else {
                    loader.textContent = (self.currentStage+1).toString() + " " + self.buttonText[0];
                    let arrow = document.createElement('span');
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
    getList(){
        return this.questionsList;
    }
    cartBinder(){
        //where code to bind main page cart and test dynemic results
        let doc = document;
        let button = doc.getElementsByClassName('js-link')[0];
        console.log("cartBinder", "clicked");
        let main = doc.getElementsByClassName('screen-cart')[0];
        main.style.display = "block";
        let currentBox = doc.getElementsByClassName("global-p" + button.id);
        let id = button.id.substr(1);
        let clickItem = doc.getElementsByClassName("inc" + id)[0];
        clickItem.click();
        let lvl = button.getAttribute('data-level');
        if ( lvl === "b1" || lvl === "b2"){
            let nextId = parseInt(id) + 1;
            let clickItem2 = doc.getElementsByClassName("inc" + nextId.toString())[0];
            clickItem2.click();
        }
    }
    finishTest(){
        let level = "c2";
        if (this.levelId < 5){
            level = this.levels[this.levelId].toLowerCase();
        }
        console.log(level);
        let self = this;
        $.ajax({
            type: "POST",
            url: "/uk/test/product",
            dataType: "JSON",
            data: {  
                product: level
            },
            error: function(response){
                console.log('error', response);
            },
            success: function(response) {
                console.log(response);
                let box = document.getElementById('box-js');
                box.style.removeProperty('display');
                
                let arr = response['response'];
                
                let title = document.getElementsByClassName('name-js')[0];
                let description = document.getElementsByClassName('description-js')[0];
                let imgContainer = document.getElementsByClassName('image-js')[0];
                let btn = document.getElementsByClassName('js-link')[0];
                btn.setAttribute('data-id', "product-" + arr[0]['id']);
                btn.setAttribute('data-level', level);
                //btn.classList.add("inc" + arr[0]['id']);
                btn.id = "r" + arr[0]['id'];
                btn.onclick = self.cartBinder;
                for (let i = 0; i < arr.length; i++){
                  title.textContent = title.textContent + arr[i]['title'];
                  if (arr[i]['description'] !== null){
                    description.textContent = description.textContent + arr[i]['description'];
                  }
                  if ((i + 1) !== arr.length){
                    title.textContent = title.textContent + ",\r\n";
                    if (arr[i]['description'] !== null){
                        description.textContent = description.textContent + ", ";
                    }
                  }
                  let img = document.createElement('img');
                    img.src = "/" + arr[i]['img'][0]['src'];
                    img.alt = arr[i]['img'][0]['alt'];
                    img.title = arr[i]['img'][0]['alt'];
                    imgContainer.appendChild(img);
                  }
                
                let price = document.getElementsByClassName('new-price-js')[0];
                let currency = " " + price.textContent;
                price.textContent = arr[0]['price'] + currency;
                
                let old = document.getElementsByClassName('old-price-js')[0];
                if (arr['old'] > 0){
                  let currencyOld = " " + old.textContent;
                  old.textContent = arr[0]['old'] + currencyOld;
                } else {
                  old.remove();
                }
            }
        });
    }
}