function ConvertClientPropriet()
{
    const formclient=document.getElementById('client');
    const formproprietaire=document.getElementById('proprietaire');
    formclient.style.display= none;
    formproprietaire.style.display= 'block';
}
function ConvertProprietClient()
{
    const formclient=document.getElementById('client');
    const formproprietaire=document.getElementById('proprietaire');
    formproprietaire.style.display= none;
    formclient.style.display= 'block';
}