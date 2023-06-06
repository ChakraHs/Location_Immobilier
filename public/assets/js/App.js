var client=document.getElementById('convertion_client_proprietaire');
var proprietaire=document.getElementById('convertion_proprietaire_client');

var formclient=document.getElementById('client');
var formproprietaire=document.getElementById('proprietaire');

client.addEventListener('click',()=>{
    formproprietaire.style.display= 'none';
    formclient.style.display= 'block';
    proprietaire.style.color='black';
    client.style.color='#dd7973';
});

proprietaire.addEventListener('click',()=>{
    formclient.style.display= 'none';
    formproprietaire.style.display= 'block';
    client.style.color= 'black';
    proprietaire.style.color= '#dd7973';
})
