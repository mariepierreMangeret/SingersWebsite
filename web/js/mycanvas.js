var c =document.getElementById('my_canvas');
var ctx =c.getContext("2d");
            
ctx.beginPath (); //debut d'un autre chemin
ctx.moveTo(50,3);
ctx.lineTo(80,42);
ctx.lineTo(280,42);
ctx.lineTo(300,3);
ctx.fillStyle="black";
ctx.strokeStyle="white";
ctx.lineWidth=5;
ctx.fill();
ctx.stroke();

/*bordure haut noir*/
ctx.beginPath (); //debut d'un autre chemin
ctx.moveTo(50,0);
ctx.lineTo(60,12);
ctx.lineTo(292,12);
ctx.lineTo(300,0);
ctx.fillStyle="black";
ctx.fill();