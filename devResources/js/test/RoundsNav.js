class RoundsNav{
    constructor(levels){
        this.levels = levels;
        this.roundNodes = [];
        this.roundsNode = document.createElement('div');
        this.roundsNode.className = "rounds-container";
    }
    render(){
        for (let i = 0; i < this.levels.length; i++){
            this.roundNodes[i] = document.createElement('div');
            this.roundNodes[i].className = "round-circle";
            this.roundNodes[i].textContent = (i+1).toString();
            if (i === 0){
                this.roundNodes[i].classList.add('current');
            }
            this.roundsNode.appendChild(this.roundNodes[i]);
        }
        return this.roundsNode;
    }
    updateLevel(level, index){
        this.roundNodes[index].textContent = level;
        let i = index - 1;
        if (i >= 0){
            this.roundNodes[i].classList.remove('current');
            this.roundNodes[i].classList.add('passed');
        }
        this.roundNodes[index].classList.add('current');
    }
}