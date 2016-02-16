/*
 Define variables for the values computed by the grabber event 
 handler but needed by mover event handler
*/
var diffX, diffY, theElement;


// The event handler function for grabbing the word
function grabber(event) {

// Set the global variable for the element to be moved

  theElement = event.currentTarget;

// Determine the position of the word to be grabbed,
//  first removing the units from left and top

  var posX = parseInt(theElement.style.left);
  var posY = parseInt(theElement.style.top);

// Compute the difference between where it is and
// where the mouse click occurred

  diffX = event.clientX - posX;
  diffY = event.clientY - posY;

// Now register the event handlers for moving and
// dropping the word

  document.addEventListener("mousemove", mover, true);
  document.addEventListener("mouseup", dropper, true);

// Stop propagation of the event and stop any default
// browser action

  event.stopPropagation();
  event.preventDefault();

}  //** end of grabber

// *******************************************************

// The event handler function for moving the word

function mover(event) {
// Compute the new position, add the units, and move the word

  theElement.style.left = (event.clientX - diffX) + "px";
  theElement.style.top = (event.clientY - diffY) + "px";

// Prevent propagation of the event

  event.stopPropagation();
}  //** end of mover

// *********************************************************
// The event handler function for dropping the word

function dropper(event) {

// Unregister the event handlers for mouseup and mousemove

  document.removeEventListener("mouseup", dropper, true);
  document.removeEventListener("mousemove", mover, true);

// Prevent propagation of the event

  event.stopPropagation();

  var poX = parseInt(theElement.style.left);
  var poY = parseInt(theElement.style.top);
  
  storePosition(poX,poY,theElement.innerHTML);


}  //** end of dropper



//[leastx, mostx, leasty,mosty,picnum]
  var correctanswers = [[-450,0,1], [-350,0,2], [-250,0,3], [-150,0,4], [-450,100,5], [-350,100,6], [-250,100,7], [-150,100,8], [-450,200,9], [-350,200,10], [-250,200,11], [-150,200,12]];
  var currentanswers = [[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0]]; 

function storePosition(x,y,idval){
  //window.alert(x);
  //window.alert(y);
  //window.alert(idval);
  var c = idval.split("<img src=\"img")
  var d = c[1];
  var f = d.split("-");
  var g = f[1];
  var h = g.split(".jpg\">");
  var j = h[0];
  var tilenumber = parseInt(j);
  //window.alert(j);
  var indexxxx = tilenumber-1;

  currentanswers[indexxxx] = [x,y,tilenumber]; 
    
  }

  var ids = ["one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve"];
function scramble() {
  
  var randFolder = Math.ceil(Math.random()*3);

  if (randFolder == 1) {
    var ig = "img1-";
  } else if (randFolder == 2) {
    var ig = "img2-";
  } else {
    var ig = "img3-";
  }
  //goes through and populates each span tag with a puzzle piece
  var scr = mixup(ids); 
  for (i = 1; i<=12; i++){
  
  var numb = i.toString();
  //sources are in order 
  sourc = '<img src = \"' + ig + numb + ".jpg\"/>";
  //where we put each source is ranomized
  var inde = scr[i-1];
  document.getElementById(inde).innerHTML = sourc;
  }
}

function mixup(x){
  var breakdown = x; //copy of ordered array
  var buildArray = []; //building new random one
  for (i = 0; i<= 11; i++){
    //get random int between 0 and length of breakdown array - 1
    var randit = Math.floor(Math.random()*breakdown.length); 
    buildArray.push(breakdown[randit]); 
    breakdown.splice(randit, 1);//takes element out of breakdown array 
  }
  return buildArray;
  
}


//////NOW ONTO TIMER STUFF //////
var sec = 0;
var min = 0;
var hou = 0;
var h;
var m;
var s;
var ivl; 

function add(){

    sec++;
    if (sec >= 60) {
        sec = 0;
        min++;
        if (min >= 60){
          min = 0;
          hou++;
        }
     }
     if (hou){
      h = hou.toString();
      if (hou <= 9){h = "0" + h;}
     }
     else{h = '00';}

     if (min){
      m = min.toString();
      if(min <= 9){m = "0" + m;}
     }
     else{m = '00';}

     if (sec <= 9){
      s = sec.toString();
      s = "0" + s;
     }
     else{s = sec.toString();}
     
     document.getElementById("timeheader").innerHTML = h + ":" + m + ":" + s;

}


function timer(){
  ivl = setInterval(add,1000);
}

var finalcheck = true;
function stopit(){
  clearInterval(ivl);
  for (i=0; i<= 11; i++){
     var xposit = currentanswers[i][0];
     var yposit = currentanswers[i][1];

     //first ROW should be near 0 in y position
     if ((i<=3) ){ if ((yposit < -7) || (yposit > 7)){finalcheck = false;}}
     //second ROW should be near 100 in y position 
     if ((i>=4) && (i<=7)){ if ((yposit < 93) || (yposit > 107)){finalcheck = false;}}
     //third ROW should be near 200 in y poosition 
     if ((i>=8) && (i<=11)){ if ((yposit < 193) || (yposit > 207)){finalcheck = false;}}


     //first column should be near -450 in x position 
     if ((i==0) || (i==4) || (i ==8)){if ((xposit < -457) || (xposit > -443)){finalcheck = false;}}
     //second column should be near -350 in x position 
     if ((i==1) || (i==5) || (i ==9)){if ((xposit < -357) || (xposit > -343)){finalcheck = false;}}
     //third column should be near -250 in x position 
     if ((i==2) || (i==6) || (i ==10)){if ((xposit < -257) || (xposit > -243)){finalcheck = false;}}
     //fourth column should be near -150 in x position 
     if ((i==3) || (i==7) || (i ==11)){if ((xposit < -157) || (xposit > -143)){finalcheck = false;}}

  }
  if(finalcheck){document.getElementById("lastdiv").innerHTML = "Congratulations! You got it.";}
  else{document.getElementById("lastdiv").innerHTML = "Better luck next time."; finalcheck=true;}
}

function compiledFunction(){
  scramble();
  timer();
}

