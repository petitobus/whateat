var nbClicked = 1 ;

function cacher(){
    var but = document.getElementsByClassName('Burberry');
    but.style.display='none';
}

function allonger() {
    var but = document.getElementsByClassName('Burberry');
    alert(nbClicked%2+"");
    nbClicked++;
    if(nbClicked%2==1){
        but.style.display = 'inline';
    }
    else{
        but.style.display = 'none' ;
    }
}
function table_any_ville() {
    document.getElementById('page_any_ville').style.display='block';
    document.getElementById('page_ville').style.display='none';
}
function returnToVille(){
    document.getElementById('page_any_ville').style.display='none';
    document.getElementById('page_ville').style.display='block';
}
function table_any_quartier() {
    document.getElementById('page_any_quartier').style.display='block';
    document.getElementById('page_quartier').style.display='none';
}
function returnToQuartier() {
    document.getElementById('page_any_quartier').style.display='none';
    document.getElementById('page_quartier').style.display='block';
}
function selectDate() {
    document.getElementById("SelectDate").style.display="block";

}
function drawRoll(){
    var canvas=document.getElementById('myCanvas');
    var ctx=canvas.getContext('2d')
    //ctx.clearRect(0,0,width,height);
    ctx.beginPath();
    ctx.strokeStyle="black";
    ctx.arc(250,0,100,0,Math.PI,false);
    ctx.stroke();
    ctx.fillStyle='black';
    ctx.fill();
}
function EATReserve(quelle){
    document.getElementById("NombreReserve").style.display="block";
    document.getElementById("NombreReserveSelectDate").style.display="block";
}
index = 1 ;

function IndexPlus(){
    index++;
    document.getElementById("NombreReserveIndex").innerHTML=index;
    document.getElementById("NombreReserveValider").name=index;
}
function IndexMoins(){
    index--;
    document.getElementById("NombreReserveIndex").innerHTML=index;
    document.getElementById("NombreReserveValider").name=index;
}
function ReserveValide(){
    
}
function page_shop_navi(){
    if(index%2==1){
        document.getElementById("page_shop_right").style.left = "400px";
        document.getElementById("page_shop_left").style.display = "block";
        index++;
    }
    else{
        document.getElementById("page_shop_right").style.left = "0px";
        document.getElementById("page_shop_left").style.display = "none";
        index++;
    }
}
