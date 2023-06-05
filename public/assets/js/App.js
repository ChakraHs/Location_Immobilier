// function ConvertClientPropriet()
// {
//     const formclient=document.getElementById('client');
//     const formproprietaire=document.getElementById('proprietaire');
//     formclient.style.display= 'none';
//     formproprietaire.style.display= 'block';
// }
// function ConvertProprietClient()
// {
//     const formclient=document.getElementById('client');
//     const formproprietaire=document.getElementById('proprietaire');
//     formproprietaire.style.display= 'none';
//     formclient.style.display= 'block';
// }

var client=document.getElementById('convertion_client_proprietaire');
var proprietaire=document.getElementById('convertion_proprietaire_client');

var formclient=document.getElementById('client');
var formproprietaire=document.getElementById('proprietaire');

client.addEventListener('click',()=>{
    formproprietaire.style.display= 'none';
    formclient.style.display= 'block';
});

proprietaire.addEventListener('click',()=>{
    formclient.style.display= 'none';
    formproprietaire.style.display= 'block';
})
