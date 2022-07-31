//produtos


// anunciar
let anunciar = document.getElementById("anunciar");

anunciar.addEventListener("click", () =>
    document.getElementById("login").dispatchEvent(new Event("click"))
);

// signin
let signin = document.getElementById("signin");

signin.addEventListener("click", function(){
    document.getElementById("main1").hidden = "true";
    document.getElementById("main2").removeAttribute("hidden");
    document.getElementById("main3").hidden = "true";
});

// login
let login = document.getElementById("login");

login.addEventListener("click", function(){
    document.getElementById("main1").hidden = "true";
    document.getElementById("main2").hidden = "true";
    document.getElementById("main3").removeAttribute("hidden");
});
