/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var array = new Array();

//Funcion que valida las respuestas elegidas y las marca como aciertos, fallos o en blanco
function valida(respuesta,numero){
    var respuestas = document.getElementsByClassName("pregunta"+numero);
    var i = respuestas.length;
    var correcta = document.getElementById("respuesta_correcta"+numero).value;
    
    if (respuesta == correcta){
        while(i--){
            if(respuesta == respuestas[i].value){
                respuestas[i].style.border = "2px solid green";
                document.getElementById("explicacion"+numero).style.display = "block";
                resultados(numero,"acierto");
            }
        }
    }
    else{
        while(i--){
            if(correcta == respuestas[i].value){
                respuestas[i].style.border = "2px solid green";
                document.getElementById("explicacion"+numero).style.display = "block";
                resultados(numero,"fallo");
            }
        }
    }
    
}

//Almacenamos las respuestas en arrays
function resultados(numero,resultado){
    
    array[numero-1] = resultado;
    
}

//Devolvemos el array
function arrayResultados(){
    document.getElementById("resultados").value = window.array.toString();
}

//Casos practicos, mostrar respuestas y explicacion
function casosPracticos(elementos){
    document.getElementById(elementos).style.display = 'block';
    
}
