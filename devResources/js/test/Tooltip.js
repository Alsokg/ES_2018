class Tooltip{
    constructor(node, message){
        this.node = node;
        
        this.closer = document.createElement('div');

        this.closer.id = "close-tooltip";
        this.closer.textContent = "X";
        let self = this;
        
        this.closer.onclick = function(){
            self.node.style.height = "0px";
        }
        this.node.appendChild(this.closer);
    }
    render(){

    }
    show(){
        this.node.style.height = "66px";
    }
}