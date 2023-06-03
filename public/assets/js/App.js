const convertion_client_proprietaire=document.getElementById('convertion_client_proprietaire');
const formclient=document.getElementById('client');
const formproprietaire=document.getElementById('proprietaire');

let formDisplayed = false;

convertion_client_proprietaire.addEventListener('click',()=>{
    formDisplayed = !formDisplayed;
    formclient.style.display= !formDisplayed ? 'block' : 'none';
    formproprietaire.style.display= formDisplayed ? 'block' : 'none';
})