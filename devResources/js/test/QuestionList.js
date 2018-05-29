class QuestionList{
    constructor(){
        this.list = [];
        this.stages = [0,1,2,3,4];
        this.stageSize = 5;
    }
    addQuestion(questionInfo, id){
        this.list.push(new Question(questionInfo, id));
    }
    getQuestionById(id){
        for (let i = 0; i < this.list.length; i++){
            if (this.list[i].id === id){
                return this.list[i];
            }
        }
    }
    getCorrectAnswersCountOnStage(stage){
        let start = stage*this.stageSize;
        let end = start + this.stageSize;
        let result = 0;
        for (let i = start; i < end; i++){
            result += this.list[i].validateAnswer();
        }
        return result;
    }
    printQuestions(){
        console.log(this.list);
    }
}