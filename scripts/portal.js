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
    fetch("getPerfil.php")
    .then(response => response.json())
    .then(data => {
        document.getElementById("nome1").value = data.nome;
        document.getElementById("cpf").value = data.cpf;
        document.getElementById("tel").value = data.telefone;
        document.getElementById("email").value = data.email;
    })
});

let edit = document.getElementById("edit-atualiz");

edit.addEventListener("click", ()=>{
    if(edit.textContent === "Atualizar Dados!"){
        alert("Dados Atualizados!");
        window.location = ("index.html");
    }else{
        edit.textContent = "Atualizar Dados!"
        document.getElementById("nome1").removeAttribute("readonly");
        document.getElementById("cpf").removeAttribute("readonly");
        document.getElementById("tel").removeAttribute("readonly");
        document.getElementById("email").removeAttribute("readonly");
    }
});

//listagem de anuncios do perfil
myanun.addEventListener("click", () => {
    fetch(`../portal/allAnuns.php?`)
    .then(response => response.json())
    .then(data => {
        data.forEach(row => {
            fetch(`imgsrc.php?src=${data.idAnuncio}`)
            .then(response => response.json())
            .then(imgSrc => {
                let card = document.createElement("div");
                card.className = "card";
                card.style = "width: 18rem";
                let img = document.createElement("img");
                img.src = `../img/imgAnuns/${imgSrc.nomeArqFoto}`
                img.className = "class-img-top"
                img.width = 200
                img.height = 200
                img.alt = data.titulo;

                let bodyCard = document.createElement("div");
                bodyCard.className = "card-body"
                let cardTitle = document.createElement("h5");
                cardTitle.className = "card-title";
                cardTitle.textContent = data.titulo;
                bodyCard.appendChild(cardTitle);
                let cardText = document.createElement("p");
                cardText.className = "card-text";
                cardText.textContent = data.descricao;
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

                    document.getElementById("title").value = data.titulo;
                    document.getElementById("description").value = data.titulo;
                    document.getElementById("price").value = data.descricao;
                    document.getElementById("datetime").value = data.dataHora;
                    document.getElementById("cep").value = data.cep;
                    document.getElementById("bairro").value = data.bairro;
                    document.getElementById("estado").value = data.estado;
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
            fetch(`imgsrc.php?src=${data.idAnuncio}`)
            .then(response => response.json())
            .then(imgSrc => {
                let card = document.createElement("div");
                card.className = "card";
                card.style = "width: 18rem";
                let img = document.createElement("img");
                img.src = `../img/imgAnuns/${imgSrc.nomeArqFoto}`
                img.className = "class-img-top"
                img.width = 200
                img.height = 200
                img.alt = data.titulo;

                let bodyCard = document.createElement("div");
                bodyCard.className = "card-body"
                let cardTitle = document.createElement("h5");
                cardTitle.className = "card-title";
                cardTitle.textContent = data.titulo;
                bodyCard.appendChild(cardTitle);
                let cardText = document.createElement("p");
                cardText.className = "card-text";
                cardText.textContent = data.descricao;
                bodyCard.appendChild(cardText);
                let Bedit = document.createElement("a");
                Bedit.className = "btn btn-danger";
                Bedit.href = "#"
                Bedit.textContent = "Deletar Anuncio";
                Bedit.addEventListener("click", () => {
                    let action = confirm("Deseja realmente excluir este anúncio?");
                    if(action){
                        fetch(`delete.php?${data.idAnuncio}`)
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
    .then(response = response.json())
    .then(data => {
        let listaInteressados = document.getElementById("lista-interesse");
        let contador = 1;
        data.forEach(() =>{
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
            button.textContent = `${data.contato} | ${data.dataHora}`
            h2.appendChild(button)
            let div = document.createElement("div");
            div.id = `collapse${contador}`
            div.className = "accordion-collapse collapse"
            div.ariaLabel = `interessado${contador}`
            div.dataset.bsParent = "accordion"
            let body = document.createElement("div");
            body.className = "accordion-body"
            body.textContent = data.mensagem
            div.appendChild(body)

            interessado.appendChild(h2);
            interessado.appendChild(div);
            listaInteressados.appendChild(interessado);
            contador++;
        }
        );
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