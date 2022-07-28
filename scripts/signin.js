//quando o usuario preencher o cpf, uma requisição AJAX será iniciada para verificar se aquele cpf digitado já foi cadastrado
let cpf = document.getElementById("cpf");

cpf.addEventListener("focusout", ()=> {
    fetch(`./publico/validate.php?cpf=${cpf.value}`) // confere se o cpf está cadastrado
    .then(response => response.json()) // recebe a resposta
    .then( data => {
        if(cpf.value === data.cpf){ // verifica se o cpf digitado é igual ao cadastrado no sistema (é redundante pois foi enviado ao servidor como identificacao, se achou significa que já é igual, mas enfim)
            cpf.nextElementSibling.textContent = "Este cpf já está cadastrado!"; // notificacao ao usuario de que o cpf ja está cadastrado
            cpf.nextElementSibling.style.color = "red";
            document.getElementById("create").disabled = true; // desabilitando o botão de envio do formulario para o usuario não criar uma conta com dois cpfs iguais;
        }
        else {
            document.getElementById("create").disabled = false; // caso o cpf não seja igual, habilita novamente o botão (este else serve para a segunda vez que for digitado o cpf e este estar apto para criacao da conta)
        }
    })
});

// assim que a senha for preenchida, o js validará se todos os campos foram preenchidos para assim liberar o botao de envio;

let passw = document.getElementById("passw1");

passw.addEventListener("click", () => {
    let nome = document.getElementById("nome");
    let cpf = document.getElementById("cpf");
    let tel = document.getElementById("tel");
    let email = document.getElementById("email1");
    let pass = document.getElementById("passw1");
    if(!(nome.value === "") && !(cpf.value === "") && !(tel.value === "") && !(email.value === "") && !(pass.value === ""))
        document.getElementById("create").disabled = false;
    else{
        if(nome.value === ""){
            nome.style.borderColor = "red";
            nome.nextElementSibling.textContent = "Preencha este campo!";
            nome.nextElementSibling.style.color = "red";
        }
        if(cpf.value === ""){
            cpf.style.borderColor = "red";
            cpf.nextElementSibling.textContent = "Preencha este campo!";
            cpf.nextElementSibling.style.color = "red";
        }
        if(tel.value === ""){
            tel.style.borderColor = "red";
            tel.nextElementSibling.textContent = "Preencha este campo!";
            tel.nextElementSibling.style.color = "red";
        }
        if(email.value === ""){
            email.style.borderColor = "red";
            email.nextElementSibling.textContent = "Preencha este campo!";
            email.nextElementSibling.style.color = "red";
        }
        if(pass.value === ""){
            pass.style.borderColor = "red";
            pass.nextElementSibling.textContent = "Preencha este campo!";
            pass.nextElementSibling.style.color = "red";
        }
    }
});