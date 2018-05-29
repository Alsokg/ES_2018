class Reader{
  
  constructor(level, color, host = "https://englishstudent.net/"){
    this.level = level;
    this.host = host;
    this.status = false;
    this.test;
    this.newTest = [];
    this.questionsCount = 5;
    this.from = 0;
    this.color = color;
  }
  loadCallback(response){
    this.test = JSON.parse(response);
    let self = this;
    
    //this.shaffleElements();
    //this.clearElements();
    this.status = true;
    self.jsonToObject();
    this.shaffleElements();
    console.log(this.level, 'loaded elements...');
  }
  jsonToObject(){
    let json = this.test;
    let stoper = json['features'].length;
    let looper = 0;//globalJson counter
    let answers = 6;//inline
    let counter = 0;//over objects
    while (looper < stoper){
      this.newTest[counter] = [];
      if (json['features'][looper+1] != undefined){
      this.newTest[counter]['word_uk'] = json['features'][looper]['properties']['Field2'];
      this.newTest[counter]['correct'] = json['features'][looper+1]['properties']['Field4'];
      this.newTest[counter]['theme'] = json['features'][looper+1]['properties']['Field3'];
      this.newTest[counter]['number'] = parseInt(json['features'][looper+1]['properties']['Field2']);
      this.newTest[counter]['color'] = this.color;
      //new fields
      this.newTest[counter]['tr1'] = json['features'][looper+1]['properties']['Field5'];
      this.newTest[counter]['word2'] = json['features'][looper+1]['properties']['Field6'];
      this.newTest[counter]['tr2'] = json['features'][looper+1]['properties']['Field7'];
      this.newTest[counter]['word3'] = json['features'][looper+1]['properties']['Field8'];
      this.newTest[counter]['tr3'] = json['features'][looper+1]['properties']['Field9'];
      this.newTest[counter]['sen1'] = json['features'][looper+1]['properties']['Field10'];
      this.newTest[counter]['sen2'] = json['features'][looper+1]['properties']['Field11'];
      for (let i = 2; i <= answers; i++){
        let inlineCounter = (i - 1).toString();
        this.newTest[counter]['answer' + inlineCounter] = json['features'][looper+i]['properties']['Field4'];
        this.newTest[counter]['number' + inlineCounter] = parseInt(json['features'][looper+i]['properties']['Field2']);
        this.newTest[counter]['color'] = this.color;
            this.newTest[counter]['tr1' + inlineCounter] = json['features'][looper+i]['properties']['Field5'];
        this.newTest[counter]['word2' + inlineCounter] = json['features'][looper+i]['properties']['Field6'];
        this.newTest[counter]['tr2' + inlineCounter] = json['features'][looper+i]['properties']['Field7'];
        this.newTest[counter]['word3' + inlineCounter] = json['features'][looper+i]['properties']['Field8'];
        this.newTest[counter]['tr3' + inlineCounter] = json['features'][looper+i]['properties']['Field9'];
        this.newTest[counter]['sen1' + inlineCounter] = json['features'][looper+i]['properties']['Field10'];
        this.newTest[counter]['sen2' + inlineCounter] = json['features'][looper+i]['properties']['Field11'];
      }
      }
      looper += 7;
      counter++;
      
    }
  }

  loadJSON() {
    let xobj = new XMLHttpRequest();
    let self = this;
    xobj.overrideMimeType("application/json");
    xobj.open('GET', this.host + "devResources/js/test/json/" + this.level + '.json', false);

    xobj.onreadystatechange = function(){
      self.loadCallback(xobj.responseText);
    }
    xobj.send(null);
  }
  shaffleElements(){
    //this.newTest.sort(function() { return 0.5 - Math.random() });
    for (let i = this.newTest.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [this.newTest[i], this.newTest[j]] = [this.newTest[j], this.newTest[i]];
    }
    //return a;
  }
  clearElements(){
    for (let i = 0; i < this.test['features'].length - 1; i++){
      
      for (let j = 1; j < 6; j++){
        if (this.test['features'][i]['properties']['answer' + j.toString()] != null){
          this.test['features'][i]['properties']['answer' + j.toString()] = this.test['features'][i]['properties']['answer' + j.toString()].replace(/[{()}]/g, '');
          this.test['features'][i]['properties']['number' + j.toString()] = this.test['features'][i]['properties']['answer' + j.toString()].replace( /^\D+/g, '');
          this.test['features'][i]['properties']['answer' + j.toString()] = this.test['features'][i]['properties']['answer' + j.toString()].replace(/[0-9]/g, '');
        }
      }
    }
  }
  getAllElements(){
    return this.newTest;
  }
  getRandomElements(){
    //if (this.test['features'].length > this.questionsCount){
      let arr = [];
      for (let i = this.from; i < this.from + this.questionsCount; i++){
        arr.push(this.newTest[i]);
      }
      this.from += this.questionsCount;
      return arr;
    //} else {
    //  return null;
   // }
  }
}
