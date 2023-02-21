var listeDepart = document.getElementById('vDepart'); 
listeDepart.addEventListener("change", hideListeArrivee);


var listeArrivee = document.getElementById('vArrivee');
listeArrivee.addEventListener("change", hideListeDepart);


function hideListeArrivee(){
    onclick=listeArrivee.querySelectorAll('option').forEach(option => {option.style.display='block'});
    listeArrivee.querySelectorAll('option').forEach(option => {
        if(option.value == listeDepart.value){
            option.style.display='none';
        }
    });
       
}

function hideListeDepart(){
    onclick=listeDepart.querySelectorAll('option').forEach(option => {option.style.display='block'});
    listeDepart.querySelectorAll('option').forEach(option => {
        if(option.value == listeArrivee.value){
            option.style.display='none';
        }
    });
       
}


