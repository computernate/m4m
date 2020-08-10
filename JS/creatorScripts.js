/*******

Templates
Portait/landscape
Submit

*******/

var canvas;
var fonts = ["truman", "refdevil", "Times New Roman", "Helvetica"];
var background = new fabric.Rect({
  fill:'white',
  top:-1,
  left:-1,
  width:649,
  height:649,
  selectable:false
});

var tPick;
var bPick;

function initializeCanvas(){
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
      alert("WARNING: This page is not optimized for mobile performance. You may continue, but we suggest switching to desktop.");
  }
  if(window.innerWidth<=750){
    document.getElementById("memeCreator").width="324";
      document.getElementById("memeCreator").height="250";
  }

  canvas = new fabric.Canvas('memeCreator', {preserveObjectStacking:true});
  tPick = new CP(document.querySelector('#textColor'));

  canvas.add(background);

  var select = document.getElementById("font-family");
  fonts.forEach(function(font) {
    var option = document.createElement('option');
    option.innerHTML = font;
    option.value = font;
    select.appendChild(option);
  });

  fonts.unshift('Times New Roman');
  document.getElementById('font-family').onchange = function() {
    //if (this.value !== 'Times New Roman') {
      //loadAndUse(this.value);
    //} else {
      canvas.getActiveObject().set("fontFamily", this.value);
      canvas.requestRenderAll();
    //}
  };

  tPick.on("change",function(color){
    if(canvas.getActiveObject()!=null){
      document.getElementById("textColor").style.backgroundColor="#"+color;
      canvas.getActiveObject().set({fill:"#"+color});
      canvas.renderAll();
    }
  });

  canvas.on("mouse:down",function(e){
    if(e.target._text!=null){
      setTextboxes();
      enableTextInput();
    }
    else{
      disableTextInput();
    }
  });

}

function addToCreator(image){
  if (image.files && image.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      fabric.Image.fromURL(reader.result, function(oImg) {
        oImg.scaleToHeight(canvas.getHeight());
        canvas.add(oImg);
      });
    };
    reader.readAsDataURL(image.files[0]);
  }
}

function addTextbox(){
  var textbox = new fabric.Textbox('ADD TEXT HERE', {
    left: 250,
    top: 50,
    width: 150,
    fontSize: 40,
    fill:"#FFFFFF",
    stroke:"#000000",
    strokeWidth:4,
    paintFirst:'stroke'
  });
  canvas.add(textbox).setActiveObject(textbox);
  setTextboxes();
  enableTextInput();
}

function sendElementBack(){
  if(canvas.getActiveObject()==null)return;
  canvas.sendToBack(canvas.getActiveObject());
  canvas.sendToBack(background);
}

var deleteElement=function(){
  if(canvas.getActiveObject()==null)return;
  canvas.remove(canvas.getActiveObject());
}

function growFont(){
  if(canvas.getActiveObject()==null)return;
  canvas.getActiveObject().set("fontSize",canvas.getActiveObject().get("fontSize")+2);
  document.getElementById('textColor').value=canvas.getActiveObject().get("fontSize");
  canvas.renderAll();
}
function shrinkFont(){
  if(canvas.getActiveObject()==null)return;
  if(canvas.getActiveObject().get("fontSize")<=0)return;
  canvas.getActiveObject().set("fontSize",canvas.getActiveObject().get("fontSize")-2);
  document.getElementById('textColor').value=canvas.getActiveObject().get("fontSize");
  canvas.renderAll();
}
function toggleBorder(){
  if(canvas.getActiveObject()==null)return;
  var swidth = canvas.getActiveObject().get("strokeWidth");
  canvas.getActiveObject().set("strokeWidth",(swidth>0)?0:4);
  (swidth>0)?document.getElementById('borderToggle').classList.add("borderDisabled"):document.getElementById('borderToggle').classList.remove("borderDisabled");
  canvas.renderAll();
}
function setFontSize(size){
  //canvas.getActiveObject().set("fontSize",size);
}

function setTextboxes(){
  document.getElementById('textColor').value=canvas.getActiveObject().get("fontSize");
  document.getElementById("textColor").style.backgroundColor=canvas.getActiveObject().get("fill");
  ( canvas.getActiveObject().get("strokeWidth")>0)?document.getElementById('borderToggle').classList.add("borderDisabled"):document.getElementById('borderToggle').classList.remove("borderDisabled");
}

function flipCanvas(){
  if(confirm("WARNING: This will erase your progress so far. Continue?")){
    canvas=null;
    var width=document.getElementById('memeCreator').style.width;
    var height=document.getElementById('memeCreator').style.height;
    var canvasElement="<canvas width='"+height+"' height='"+width+"' id='memeCreator'></canvas>";
    document.getElementById('canvas-wrapper').innerHTML=canvasElement;
    initializeCanvas();
    document.getElementById("changeOrientation").value=(width=="500px")?"Change to Portrait":"Change to Landscape";
  }
}

function disableTextInput(){
  document.getElementById("textControls1").classList.add("disabled");
  document.getElementById("textControls2").classList.add("disabled");
}
function enableTextInput(){
  document.getElementById("textControls1").classList.remove("disabled");
  document.getElementById("textControls2").classList.remove("disabled");
}

function pullImage(){
  var src = canvas.toDataURL("image/png",1);
  console.log(src);
  document.getElementById("pulledImage").src=src;
  document.getElementById("uploadingMeme").value=src;
}

window.onkeydown=function(e){
  if(e.keyCode==46){
    deleteElement();
  }
  if(e.keyCode==37){
    canvas.getActiveObject().left-=2;
  }
  if(e.keyCode==39){
    canvas.getActiveObject().left+=2;
  }
  if(e.keyCode==38){
    e.preventDefault();
    canvas.getActiveObject().top-=2;
  }
  if(e.keyCode==40){
    e.preventDefault();
    canvas.getActiveObject().top+=2;
  }
  canvas.renderAll();
}
