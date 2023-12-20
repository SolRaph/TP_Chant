let modal = document.querySelector("#modal");
let btnmodal = document.querySelector("#openmodal");
let close = document.querySelector("#close");
let openmodalduhaut = document.querySelector("#openmodalduhaut");

btnmodal.addEventListener("click", ()=> {
    modal.showModal()
})
close.addEventListener("click", ()=> {
    modal.close()
})

openmodalduhaut.addEventListener('click', function () {
  openmodal.click();
});


const oeil = document.querySelector("#oeil1");
const pasoeil = document.querySelector("#pasoeil1");
const password = document.querySelector("#affichemdp");

oeil.addEventListener("mouseover", () => {
  oeil.style.display = "none";
  pasoeil.style.display = "block";
  password.type = "text";
});
pasoeil.addEventListener("mouseout", () => {
  pasoeil.style.display = "none";
  oeil.style.display = "block";
  password.type = "password";
});
console.log(bonjour);

const oeil2 = document.querySelector("#oeil2");
const pasoeil2 = document.querySelector("#pasoeil2");
const password2 = document.querySelector("#password2");

oeil2.addEventListener("mouseover", () => {
  oeil2.style.display = "none";
  pasoeil2.style.display = "block";
  password2.type = "text";
});
pasoeil2.addEventListener("mouseout", () => {
  pasoeil2.style.display = "none";
  oeil2.style.display = "block";
  password2.type = "password";
});

