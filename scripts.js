// Martell Hernandez Hernandez
var altura=300;
var ancho=500;
var w = parseInt(window.screen.availWidth/2 - ancho/2);
var h = parseInt(window.screen.availHeight/2 - altura/2);
w = w.toString();
h = h.toString();
var propiedades="height="+altura+",width="+ancho+",top="+h+",left="+w;
var db="";

//Para que se vea bien
function cargarCentro(){
    var height, padTop;
    centro = document.getElementById("centro");
    heightH = document.getElementById("header").style.height;
    heightF = document.getElementById("footer").style.height;
    centro.style.marginTop = heightH;
    centro.style.marginBottom = heightF;
}


function abrir(tipo){
    switch(tipo){
        case 'createDB':
            var si= confirm("Se abrirá otra pagina.");
            if(si) window.open("CreateBD.php","Crear una base de datos",propiedades);
            break;
        case "dropDB":
            var si= confirm("Se abrirá otra pagina.");
            if(si) window.open("dropDB.php","Borrar una base de datos",propiedades);
            break;
        case "createT":
            var si= confirm("Se abrirá otra pagina.");
            if(si) window.open("CreateT.php","Crear una Tabla",propiedades);
            break;
        case "dropT":
            var si= confirm("Se abrirá otra pagina.");
            if(si) window.open("BorrarTabla.php","Borrar una Tabla",propiedades);
            break;
        case "update":
            var si= confirm("Se abrirá otra pagina.");
            if(si) window.open("updateDato.php","Modificar un registro de una tabla",propiedades);
            break;
        case "insert":
            var si= confirm("Se abrirá otra pagina.");
            if(si) window.open("insertDato.php","Insertar un registro de una tabla",propiedades);
            break;
        case "delete":
            var si= confirm("Se abrirá otra pagina.");
            if(si) window.open("delete.php","Borrar un registro de una tabla",propiedades);
            break;
        }
}

function revisarAtr(){
    var nom="numAtr"; //id
    var div=document.getElementById("atr");
    if(div.hasChildNodes){
        div.innerHTML="";
    }
    var numAtr = document.getElementById(nom).value;
    var i=0,nodeInput,nodeVal,nodeBr;
    if( numAtr!= null || numAtr!= " "){
        div.innerHTML="<strong>Atributos: </strong><br>";
        for(i=0; i<numAtr; i++){
            nodeInput = document.createElement("INPUT");
            nodeInput.setAttribute("type","text");
            nodeInput.setAttribute("name","atr"+i);
            nodeInput.setAttribute("placeholder","Nombre del Atributo "+(i+1));
            nodeInput.setAttribute("required","");
            div.appendChild(nodeInput);
            nodeVal = document.createElement("INPUT");
            nodeVal.setAttribute("type","text");
            nodeVal.setAttribute("name","atrVal"+i);
            nodeVal.setAttribute("placeholder","valor");
            nodeVal.setAttribute("required","");
            div.appendChild(nodeVal);
            nodeBr= document.createElement("BR");
            div.appendChild(nodeBr);
        }
    }
}