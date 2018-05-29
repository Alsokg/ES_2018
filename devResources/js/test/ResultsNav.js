class ResultsNav{
    constructor(num, cardsParent){
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
    render(){
        let self = this;
        
        this.left.className = "nav-control nav-left nav-disabled";
        this.left.textContent = "<";
        this.left.onclick = function(){
            if(self.currentNum > 1){
                self.currentNum--;
                self.update();
                self.right.classList.remove('nav-disabled');
            }
            if (self.currentNum === 1){
                self.left.classList.add('nav-disabled');
            }
        }
        
        this.right.className = "nav-control nav-right";
        this.right.textContent = ">";
        this.right.onclick = function(){
            if (self.currentNum < self.maxNum){
                self.currentNum++;
                self.update();
                self.left.classList.remove('nav-disabled');
            }
            if (self.currentNum === self.maxNum){
                self.right.classList.add('nav-disabled');
            }
        }
        let maxNum = document.createElement('span');
        maxNum.textContent = this.maxNum.toString();
        
        this.navNode.appendChild(this.left);
        this.navNode.appendChild(this.currentNode);
        this.navNode.appendChild(this.separator);
        this.navNode.appendChild(maxNum);
        this.navNode.appendChild(this.right);
        
        return this.navNode;
    }
    update(){
        this.currentNode.textContent = this.currentNum.toString();
        let blocks = this.root.getElementsByClassName('parent-wrapper');
        let offset = (this.currentNum - 1)*100;
        for (let i = 0; i < blocks.length; i++){
            blocks[i].style.left = "-" + offset.toString() + "%";
        }
    }
}