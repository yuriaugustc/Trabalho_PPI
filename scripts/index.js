//produtos
let produtos = document.getElementById("produtos");

produtos.addEventListener("click", () => {
    document.getElementById("welcome").hidden = "true";
    document.getElementById("prods").removeAttribute("hidden");
    document.getElementById("details").hidden = "true";
    document.getElementById("advansearch").hidden = "true";
    document.getElementById("mainCadastro").hidden = "true";
    document.getElementById("mainLogin").hidden = "true";
    let contador = 0;
    fetch(`../publico/getProducts.php?count=${contador}`)
    .then(response => response.json())
    .then(data => {
        getProducts(data);
        contador++;
    })
    window.onscroll = function () {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight-10)
        fetch(`../publico/getProducts.php?count=${contador}`)
        .then(response => response.json())
        .then(data => {
            getProducts(data);
            contador++;
        })
    }
});

// barra de pesquisa rapida
let pesq = document.getElementById("pesq");
pesq.addEventListener("click", () => {
    document.getElementById("welcome").hidden = "true";
    document.getElementById("prods").removeAttribute("hidden");
    document.getElementById("details").hidden = "true";
    document.getElementById("advansearch").hidden = "true";
    document.getElementById("mainCadastro").hidden = "true";
    document.getElementById("mainLogin").hidden = "true";
    
    let string = document.getElementById("search").value;
    let contador = 0;
    fetch(`../publico/search.php?search=${string}&number=${contador}`)
    .then(response => response.json())
    .then(data => {
        getProducts(data);
        contador++;
    })
    window.onscroll = () => {
        
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight-10){
            fetch(`../publico/search.php?search=${string}&number=${nmbr}`)
            .then(response => response.json())
            .then(data => getProducts(data))
            contador++;
        }
    }
});

// funcao auxiliar para imprimir os produtos
function getProducts(data){
    for(row of data) {
        fetch(`imgsrc.php?id=${row.idAnuncio}`)
        .then(response => response.json())
        .then(imgSrc => {
            let card = document.createElement("div");
            card.className = "card";
            let a = document.createElement("a");
            a.href = "#";
            let img = document.createElement("img");
            img.src = imgSrc.NomeArqFoto;
            img.alt = row.titulo;
            img.width = 300;
            img.height = 300;
            let p = document.createElement("p");
            p.textContent = row.titulo;
            let p1 = document.createElement("p");
            p1.textContent = `R$ ${row.preco}`;
            let p2 = document.createElement("p");
            p2.textContent = row.descricao
            a.appendChild(img);
            a.appendChild(p);
            a.appendChild(p1);
            a.appendChild(p2);
            card.appendChild(a);
            card.addEventListener("click", () => {
                document.getElementById("welcome").hidden = "true";
                document.getElementById("prods").hidden = "true";
                document.getElementById("advansearch").hidden = "true";
                document.getElementById("mainCadastro").hidden = "true";
                document.getElementById("mainLogin").hidden = "true";
                document.getElementById("details").removeAttribute = "hidden";

                document.getElementById("imgProd").src = imgSrc.nomeArqFoto;
                document.getElementById("title").textContent = row.titulo;
                document.getElementById("price").textContent = row.preco;
            });
            document.getElementById("prods").appendChild(card);
        })
    }
}

//listener da main de detalhes
//botao de voltar
let voltar = document.getElementById("voltar");
voltar.addEventListener("click", ()=> {
    document.getElementById("welcome").hidden = "true";
    document.getElementById("prods").removeAttribute = "hidden";
    document.getElementById("details").hidden = "true";
    document.getElementById("advansearch").hidden = "true";
    document.getElementById("mainCadastro").hidden = "true";
    document.getElementById("mainLogin").hidden = "true";
});

// enviar interesse
let demonstrarInteresse = document.getElementById("demonstrarInteresse");
demonstrarInteresse.addEventListener("click", ()=>{
    let msgInteresse = document.getElementById("interest");
    let contato = document.getElementById("contat");
    let title = document.getElementById("title").value;
    fetch(`../publico/demonstrarInteresse.php?msg=${msgInteresse}&tel=${contato}&title=${title}`)
    .then(alert("Mensagem enviada ao Dono do Anuncio!"))
});

// anunciar
let anunciar = document.getElementById("anunciar");

anunciar.addEventListener("click", () =>
    document.getElementById("login").dispatchEvent(new Event("click"))
);

// busca avancada
let busca = document.getElementById("busca");

busca.addEventListener("click", () => {
    document.getElementById("welcome").hidden = "true";
    document.getElementById("prods").hidden = "true";
    document.getElementById("details").hidden = "true";
    document.getElementById("advansearch").removeAttribute("hidden");
    document.getElementById("mainCadastro").hidden = "true";
    document.getElementById("mainLogin").hidden = "true";
});

//lista de resultados da busca avancada

let buscaAvancada = document.getElementById("bttntxtSearch");

buscaAvancada.addEventListener("click", () => {
    let form = document.querySelectorAll('form');
    let formD = new FormData(form[1]);
    console.log(formD);
    let options = {
        "method": "POST",
        "body": formD
    }
    console.log(formD);
    let contador = 0;
    fetch('../publico/advansearch.php', options)
    .then(response => response.json())
    .then(data => {
        getProducts(data);
        contador++;
        window.onscroll = function () {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight-10){
                fetch(`../publico/advansearch.php?count=${contador}`, options)
                .then(response => response.json())
                .then(data => getProducts(data));
                contador++;
            }
        }
    })
});

// signin
let signin = document.getElementById("signin");

signin.addEventListener("click", function(){
    document.getElementById("welcome").hidden = "true";
    document.getElementById("prods").hidden = "true";
    document.getElementById("details").hidden = "true";
    document.getElementById("advansearch").hidden = "true";
    document.getElementById("mainCadastro").removeAttribute("hidden");
    document.getElementById("mainLogin").hidden = "true";
});

// login
let login = document.getElementById("login");

login.addEventListener("click", function(){
    document.getElementById("welcome").hidden = "true";
    document.getElementById("prods").hidden = "true";
    document.getElementById("details").hidden = "true";
    document.getElementById("advansearch").hidden = "true";
    document.getElementById("mainCadastro").hidden = "true";
    document.getElementById("mainLogin").removeAttribute("hidden");
});
