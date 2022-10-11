
function showSignInEtudiantForm(){
    document.getElementById("signinentrepriseform").style.display = "none";
    document.getElementById("signinetudiantform").style.display = "block";
}
function showSignInEntrepriseForm(){
    document.getElementById("signinentrepriseform").style.display = "block";
    document.getElementById("signinetudiantform").style.display = "none";
}

function showPassword(){
    document.getElementById("cachemotpasse1").style.display = "none";
    document.getElementById("motpasse1").style.display = "block";
    document.getElementById("cachemotpasse2").style.display = "none";
    document.getElementById("motpasse2").style.display = "block";
}
function hidePassword(){
    document.getElementById("cachemotpasse1").style.display = "block";
    document.getElementById("motpasse1").style.display = "none";
    document.getElementById("cachemotpasse2").style.display = "block";
    document.getElementById("motpasse2").style.display = "none";
}
/*
function afficherContact(){
    document.getElementById("myModal").style.display = "block";
}*/