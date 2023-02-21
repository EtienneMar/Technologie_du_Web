
var rotateAction = document.getElementById('rotateAction'); 
rotateAction.addEventListener('click', switchDestination(rotatePicture360));
rotateAction.addEventListener('mouseleave', rotatePicture360);


function rotatePicture360(){
    var pictureToRotate = document.getElementById('pictureToRotate');
    if (pictureToRotate.style.transform=="rotate(360deg)"){
        pictureToRotate.style.transform = "rotate(0deg)";
        pictureToRotate.style.webkitTransform = "rotate(0deg)";
    }else{
        pictureToRotate.style.transform = "rotate(360deg)";
        pictureToRotate.style.webkitTransform = "rotate(360deg)";
    }
}

function switchDestination(rotatePicture){
    rotatePicture();
    var listeDepart = document.getElementById('vDepart'); 
    var listeArrivee = document.getElementById('vArrivee');
    if (listeDepart.value!='Départ' && listeArrivee.value!='Arrivée'){
        var listeDepartValue = listeDepart.value;
        listeDepart.value=listeArrivee.value; 
        listeArrivee.value=listeDepartValue;
    }else{
        null;
    }
}



 
