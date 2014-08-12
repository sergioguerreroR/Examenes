/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function valida(respuesta){
    var respuestas = document.getElementsByClassName("respuesta");
    var i = respuestas.length;
    var correcta = document.getElementById("respuesta_correcta").value;
    
    if (respuesta == correcta){
        while(i--){
            if(respuesta == respuestas[i].value){
                respuestas[i].style.border = "2px solid green";
            }
        }
    }
    else{
        while(i--){
            if(correcta == respuestas[i].value){
                respuestas[i].style.border = "2px solid green";
            }
        }
    }
    //document.getElementById("explicacion").style.display = "block";
}

function resetCSS(){
    var respuestas = document.getElementsByClassName("respuesta");
    var i = respuestas.length;
    
    while(i--){
        respuestas[i].style.border = "";
    }
}