var trajetPopulaireButtons = Array.from(document.getElementsByClassName("trajetPopulaire_button-reponse"));

trajetPopulaireButtons.forEach(element => {
        element.addEventListener('mouseenter', buttonAnimation);
        element.addEventListener('mouseleave', reset)
})

function buttonAnimation(){ 
    var IndexToSelect = trajetPopulaireButtons.indexOf(this);  
    //animation de l'arrow
    var arrowSelected = document.getElementById('arrow'+String(IndexToSelect));
    arrowSelected.animate([
        //keyFrame
        {left : '0'}, 
        {left: '10px'}, 
        {left: '0'}
    ], {   
        //option
        duration: 800,  
    }); 
    var trajetPopulaireButtonSelected = document.getElementById(this.id); 
    trajetPopulaireButtonSelected.style.background = "#5054E0";
    var contentButtonSelected = document.getElementById('button_content'+String(IndexToSelect)); 
    contentButtonSelected.style.color = "white";
}

function reset(){
    var IndexToSelect = trajetPopulaireButtons.indexOf(this);  
    var trajetPopulaireButtonSelected = document.getElementById(this.id); 
    trajetPopulaireButtonSelected.style.background = "white";
    var contentButtonSelected = document.getElementById('button_content'+String(IndexToSelect)); 
    contentButtonSelected.style.color = "black";
    
}