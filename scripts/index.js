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
    // fetch('../publico/getProducts.php')
    // .then(response => response.json())
    // .then(data => {
        let data
        getProducts(contador++, data);
        window.onscroll = function () {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight-10)
                getProducts(contador++, data);
        }
   // })
});

function getProducts(contador, data){
        let data1 = [
            {
                titulo : "titulo",
                preco : "100.00",
                imgSrc : "produto1.jpg",
                descricao : "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, animi alias maxime, veniam enim nisi iure distinctio non aliquam nobis quibusdam fuga eum aliquid similique, atque sed consequuntur velit. Velit?"
            },{
                titulo : "titulo",
                preco : "100.00",
                imgSrc : "produto1.jpg",
                descricao : "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, animi alias maxime, veniam enim nisi iure distinctio non aliquam nobis quibusdam fuga eum aliquid similique, atque sed consequuntur velit. Velit?"
            },{
                titulo : "titulo",
                preco : "100.00",
                imgSrc : "produto1.jpg",
                descricao : "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, animi alias maxime, veniam enim nisi iure distinctio non aliquam nobis quibusdam fuga eum aliquid similique, atque sed consequuntur velit. Velit?"
            },{
                titulo : "titulo",
                preco : "100.00",
                imgSrc : "produto1.jpg",
                descricao : "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, animi alias maxime, veniam enim nisi iure distinctio non aliquam nobis quibusdam fuga eum aliquid similique, atque sed consequuntur velit. Velit?"
            },{
                titulo : "titulo",
                preco : "100.00",
                imgSrc : "produto1.jpg",
                descricao : "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, animi alias maxime, veniam enim nisi iure distinctio non aliquam nobis quibusdam fuga eum aliquid similique, atque sed consequuntur velit. Velit?"
            },{
                titulo : "titulo",
                preco : "100.00",
                imgSrc : "produto1.jpg",
                descricao : "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, animi alias maxime, veniam enim nisi iure distinctio non aliquam nobis quibusdam fuga eum aliquid similique, atque sed consequuntur velit. Velit?"
            }  
        ];
        data1.forEach(row => {
            //fetch(`imgsrc.php?src=${row.idAnuncio}`)
            //.then(response => response.json())
            //.then(imgSrc => {
                let card = document.createElement("div");
                card.className = "card";
                let a = document.createElement("a");
                a.href = "#";
                let img = document.createElement("img");
                img.src = `./img/imgAnuns/${row.imgSrc}`;
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

                    document.getElementById("imgProd").src = row.imgSrc;
                    document.getElementById("title").textContent = row.titulo;
                    document.getElementById("price").textContent = row.preco;
                });
                document.getElementById("prods").appendChild(card);
            //})
        })
    //})
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

busca.addEventListener("click", function(){
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
    let form = document.getElementById("advsearch");
    let formD = new FormData(form);
    let options = {
        method: POST,
        body: formD
    }
    fetch('../publico/advansearch.php', options)
    .then(response => response.json())
    .then(data => {
        let contador = 0;
        getProducts(contador++, data);
        window.onscroll = function () {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight-10)
                getProducts(contador++, data);
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
