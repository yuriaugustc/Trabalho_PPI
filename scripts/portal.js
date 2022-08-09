let perf = document.getElementById("perf");

perf.addEventListener("click", ()=>{
    document.getElementById("perfil").removeAttribute("hidden");
    document.getElementById("anunCreate").hidden = "true";
    document.getElementById("myAnuns").hidden = "true";
    document.getElementById("anunDelete").hidden = "true";
});

let criar = document.getElementById("criar");

criar.addEventListener("click", ()=>{
    document.getElementById("perfil").hidden = "true";
    document.getElementById("anunCreate").removeAttribute("hidden");
    document.getElementById("myAnuns").hidden = "true";
    document.getElementById("anunDelete").hidden = "true";
});

let myanun = document.getElementById("myanun");

myanun.addEventListener("click", ()=>{
    document.getElementById("perfil").hidden = "true";
    document.getElementById("anunCreate").hidden = "true";
    document.getElementById("myAnuns").removeAttribute("hidden");
    document.getElementById("anunDelete").hidden = "true";
});

let anunD = document.getElementById("anunD");

anunD.addEventListener("click", ()=>{
    document.getElementById("perfil").hidden = "true";
    document.getElementById("anunCreate").hidden = "true";
    document.getElementById("myAnuns").hidden = "true";
    document.getElementById("anunDelete").removeAttribute("hidden");
});

//edicao de perfil 
perf.addEventListener("click", () => {
    fetch("../portal/perfil.php") // resgatando o dados do perfil utilizando o email guardado como variavel de sessao
    .then(response => response.json())
    .then(data => {
        document.getElementById("nome1").value = data.nome;
        document.getElementById("cpf").value = data.cpf;
        document.getElementById("tel").value = data.telefone;
        document.getElementById("email").value = data.email;
    })
});

let edit = document.getElementById("edit-atualiz");

edit.addEventListener("click", () => {
    if(edit.textContent === "Atualizar Dados!"){
        let form = document.getElementById("formAtualiz");
        
        let formEnv = new FormData(form);
        const options = {
            method: "POST",
            body: formEnv
        }
        console.log(formEnv);
        fetch("../portal/AtualizaDados.php", options);
        alert("Dados Atualizados!");
        window.location = ("../portal/index.php");
    }else{
        edit.textContent = "Atualizar Dados!"
        document.getElementById("nome1").removeAttribute("readonly");
        document.getElementById("cpf").removeAttribute("readonly");
        document.getElementById("tel").removeAttribute("readonly");
        document.getElementById("email").removeAttribute("readonly");
        document.getElementById("passw").removeAttribute("readonly");
    }
});

//criacao de anuncios

let criarAnuncio = document.getElementById("criarAnuncio");

criarAnuncio.addEventListener("click", () => {
    let form = document.querySelector("form");
    let formEnv = new FormData(form[1]);
    
    const options = {
        "method": "POST",
        "body": formEnv
    }
    fetch("../portal/createAnun.php", options)
    alert("Anúncio Criado com Sucesso!");
    window.location = ("../portal/index.php");
});

//AJAX para o preenchimento automatico de endereco
let cep = document.getElementById("cep");

cep.addEventListener("focusout", () => {
    fetch(`../portal/cep.php?cep=${cep.value}`)
    .then(response => response.json())
    .then(data => {
        document.getElementById("bairro").value = data.bairro;
        document.getElementById("cidade").value = data.cidade;
        document.getElementById("esatdo").value = data.estado;
    })
});

//listagem de anuncios do perfil
myanun.addEventListener("click", () => {
    fetch(`../portal/allAnuns.php`)
    .then(response => response.json())
    .then(data => {
        data.forEach(row => {
            fetch(`imgsrc.php?src=${row.idAnuncio}`)
            .then(response => response.json())
            .then(imgSrc => {
                let card = document.createElement("div");
                card.className = "card";
                card.style = "width: 18rem";
                let img = document.createElement("img");
                img.src = imgSrc.nomeArqFoto;
                img.className = "class-img-top"
                img.width = 200
                img.height = 200
                img.alt = row.titulo;

                let bodyCard = document.createElement("div");
                bodyCard.className = "card-body"
                let cardTitle = document.createElement("h5");
                cardTitle.className = "card-title";
                cardTitle.textContent = row.titulo;
                bodyCard.appendChild(cardTitle);
                let cardText = document.createElement("p");
                cardText.className = "card-text";
                cardText.textContent = row.descricao;
                bodyCard.appendChild(cardText);
                let Bedit = document.createElement("a");
                Bedit.className = "btn btn-primary";
                Bedit.href = "#"
                Bedit.textContent = "Editar Anuncio";
                Bedit.addEventListener("click", () => {
                    let anuns = document.getElementById("myAnuns");
                    anuns.hidden = "true";
                    anuns.firstElementChild.remove();
                    anuns.appendChild(document.createElement("div").id = "my-card-list"); //mais facil apagar e recria a div de cards para nao dar problemas de duplicidade;

                    document.getElementById("anunCreate").removeAttribute("hidden");

                    document.getElementById("title").value = row.titulo;
                    document.getElementById("description").value = row.titulo;
                    document.getElementById("price").value = row.descricao;
                    document.getElementById("datetime").value = row.dataHora;
                    document.getElementById("cep").value = row.cep;
                    document.getElementById("bairro").value = row.bairro;
                    document.getElementById("estado").value = row.estado;
                })
                bodyCard.appendChild(Bedit);

                card.appendChild(img);
                card.appendChild(bodyCard);
                document.getElementById("my-card-list").appendChild(card);
            })
        });
    })
});

//busca de anuncios para delete
let searchD = document.getElementById("search-d");

searchD.addEventListener("click", () => {
    let string = document.getElementById("search-s").value;
    fetch(`../portal/search.php?search=${string}`)
    .then(response => response.json())
    .then(data => {
        data.forEach(row => {
            fetch(`imgsrc.php?src=${row.idAnuncio}`)
            .then(response => response.json())
            .then(imgSrc => {
                let card = document.createElement("div");
                card.className = "card";
                card.style = "width: 18rem";
                let img = document.createElement("img");
                img.src = `../img/imgAnuns/${imgSrc}`
                img.className = "class-img-top"
                img.width = 200
                img.height = 200
                img.alt = row.titulo;

                let bodyCard = document.createElement("div");
                bodyCard.className = "card-body"
                let cardTitle = document.createElement("h5");
                cardTitle.className = "card-title";
                cardTitle.textContent = row.titulo;
                bodyCard.appendChild(cardTitle);
                let cardText = document.createElement("p");
                cardText.className = "card-text";
                cardText.textContent = row.descricao;
                bodyCard.appendChild(cardText);
                let Bedit = document.createElement("a");
                Bedit.className = "btn btn-danger";
                Bedit.href = "#"
                Bedit.textContent = "Deletar Anuncio";
                Bedit.addEventListener("click", () => {
                    let action = confirm("Deseja realmente excluir este anúncio?");
                    if(action){
                        fetch(`delete.php?id=${row.idAnuncio}`)
                        card.remove();
                    }
                })
                bodyCard.appendChild(Bedit);

                card.appendChild(img);
                card.appendChild(bodyCard);
                document.getElementById("d-card-list").appendChild(card);
            })
        });
    })
});

let interesses = document.getElementById("interesses");

interesses.addEventListener("click", () => {
    fetch("interessados.php")
    .then(response => response.json())
    .then(data => {
        let listaInteressados = document.getElementById("lista-interesse");
        let contador = 1;
        for(row of data){
            let interessado = document.createElement("div").className = "accordion-item";
            
            let h2 = document.createElement("h2");
            h2.className = "accordion-header";
            h2.id = `interessado${contador}`
            let button = document.createElement("button");
            button.className = "accordion-button collapsed";
            button.type = "button"
            button.dataset.bsToggle = "collapse"
            button.dataset.bsTarget = `#collapse${contador}`
            button.ariaExpanded = "false"
            button.ariaControls = `collapse${contador}`
            button.textContent = `${row.contato} | ${row.dataHora}`
            h2.appendChild(button)
            let div = document.createElement("div");
            div.id = `collapse${contador}`
            div.className = "accordion-collapse collapse"
            div.ariaLabel = `interessado${contador}`
            div.dataset.bsParent = "accordion"
            let body = document.createElement("div");
            body.className = "accordion-body"
            body.textContent = row.mensagem
            div.appendChild(body)

            interessado.appendChild(h2);
            interessado.appendChild(div);
            listaInteressados.appendChild(interessado);
            contador++;
        }
    })
});

let closeInteresse = document.getElementById("closeInteresse");

closeInteresse.addEventListener("click", () => {
    let modalBody = document.getElementById("modal-body");
    modalBody.firstElementChild.remove();
    let newBody = document.createElement("div");
    newBody.className = "accordion"
    newBody.id = "lista-interesse"

    modalBody.appendChild(newBody);
});

let exit = document.getElementById("exit");

exit.addEventListener("click", () => {
    fetch("logout.php")
    window.location = "../index.html"
});