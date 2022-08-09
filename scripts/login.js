
let email = document.getElementById("email2");

email.addEventListener("focusout", () => {
    if(email.value === ""){
        document.getElementById("spanEmail").textContent = "Preencha este campo!";
        document.getElementById("spanEmail").style.color = "red";
    }
});

let senha = document.getElementById("passw2");

senha.addEventListener("focusout", () =>{
    if(senha.value === ""){
        document.getElementById("spanPassw").textContent = "Preencha este campo!";
        document.getElementById("spanPassw").style.color = "red";
    }
});

let log = document.getElementById("log");

log.addEventListener("click", () => {
    if(!(email.value === "") && !(senha.value === "")){
        fetch(`./publico/access.php?email=${email.value}&passw=${senha.value}`)
        .then(response => response.json())
        .then(data => {
            if(email.value === data.email && data.senhaHash){ // a senha está sendo comparada dessa forma pois foi escrito um bool no valor, pois não é possivel comparar a senha digitada com o valor hash no js, por isso fiz a comparacao no php
                fetch(`../portal/sessionStart.php?email=${email.value}`);
                window.location = "../portal/index.html";
            }
            else {
                document.getElementById("spanPassw").textContent = "Email ou senha inválidos!";
                document.getElementById("spanPassw").style.color = "red";
            }
        }); //2nThen
    }// if
});//addEventListener

let cad = document.getElementById("cad");

cad.addEventListener("click", () =>
    document.getElementById("signin").dispatchEvent(new Event("click"))
);