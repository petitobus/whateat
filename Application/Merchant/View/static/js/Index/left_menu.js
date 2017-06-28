/**
 * Created by Sunyuzhe on 2017/1/16.
 */

function effet_link(){
    var p = document.getElementsByTagName('p');
    for ( var i = 0; i<p.length; i++){
        p[i].onclick = function () {
                p.style.backgroundColor='green';
            }
        }
}