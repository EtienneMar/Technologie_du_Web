var prix = document.getElementById('prixMax');


function changePrix(button){
    let id = button.getAttribute("id");
    let min = prix.getAttribute("min");
    let step = prix.getAttribute("step");
    let valeurMaj = parseInt(min)-5;
    if(prix.getAttribute("value") != null){
        valeurMaj = parseInt(prix.getAttribute("value"));
    }


    if (id == "incremente"){
        valeurMaj += parseInt(step);
        console.log(valeurMaj)
    }else{
        valeurMaj -= parseInt(step);
        console.log(valeurMaj)
    }

    if(valeurMaj >=min){
        prix.setAttribute("value", valeurMaj); 
    }else {
        prix.setAttribute("value", null);
    }
    
}