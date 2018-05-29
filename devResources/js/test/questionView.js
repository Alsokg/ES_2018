class QuestionView{
  static shaffleElements(arr){
    arr.sort(function() { return 0.5 - Math.random() });
  }
    static renderNode(question, rootNode, number, active, color){
        let doc = document;
        QuestionView.shaffleElements(question.answers);
        
        let wrapper = doc.createElement('div');
        wrapper.className = 'block-wrapper';
        
        let wrapperParent = doc.createElement('div');
        wrapperParent.className = 'parent-wrapper';
        
        let word = doc.createElement('div');
        word.className = "word-uk";
        word.textContent = (number + 1).toString() + ". " + question.word;
        wrapper.appendChild(word);
        
        for (let i = 0; i < question.answers.length; i++){
            let container = doc.createElement('div');
            container.className = "test__container";
            if (active){
              if (question.correct === question.answers[i][0]){
                container.classList.add('before-ok');
              } else if(question.userAnswer === question.answers[i][0]){
                container.classList.add('before-error');
              } else {
                container.classList.add('before-hidden');
              }
            }
            
            if (!active){
              container.addEventListener('click', function(event){
                question.selectAnswer(event);
              });
            }
            
            let header = doc.createElement('div');
            header.className = "test__header";
            header.style.backgroundColor = question.color;
            
            let content = doc.createElement('div');
            content.className = "test__content";
            let answ = doc.createElement('span');
            answ.className = "test__answer";
            answ.textContent = question.answers[i][0];
            let number = doc.createElement('span');
            number.className = "test__number";
            number.textContent = question.answers[i][1];
            let theme = doc.createElement('span');
            theme.className = "test__theme";
            theme.textContent = question.theme;
            
            
            header.appendChild(number);
            header.appendChild(theme);
            container.appendChild(header);
            content.appendChild(answ);
            
            //new fields
            if (question.answers[i][2] !== null){
              let tr1 = document.createElement('span');
              tr1.className = "test__tr";
              tr1.textContent = question.answers[i][2];
              content.appendChild(tr1);
            }
            if (question.answers[i][3] !== null){
              let tr1 = document.createElement('span');
              tr1.className = "test__word";
              tr1.textContent = question.answers[i][3];
              content.appendChild(tr1);
            }
            if (question.answers[i][4] !== null){
              let tr1 = document.createElement('span');
              tr1.className = "test__tr";
              tr1.textContent = question.answers[i][4];
              content.appendChild(tr1);
            }
            if (question.answers[i][5] !== null){
              let tr1 = document.createElement('span');
              tr1.className = "test__word";
              tr1.textContent = question.answers[i][5];
              content.appendChild(tr1);
            }
            if (question.answers[i][6] !== null){
              let tr1 = document.createElement('span');
              tr1.className = "test__tr";
              tr1.textContent = question.answers[i][6];
              content.appendChild(tr1);
            }
            if (question.answers[i][7] !== null){
              let tr1 = document.createElement('span');
              tr1.className = "test__sen";
              tr1.textContent = question.answers[i][7];
              content.appendChild(tr1);
            }
            if (question.answers[i][8] !== null){
              let tr1 = document.createElement('span');
              tr1.className = "test__sen";
              tr1.textContent = question.answers[i][8];
              content.appendChild(tr1);
            }
            
            container.appendChild(content);
            wrapper.appendChild(container);
            wrapperParent.appendChild(wrapper);
        }
        rootNode.appendChild(wrapperParent);
    }
}