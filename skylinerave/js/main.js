
//navbar  style changing on scroling
  window.addEventListener("scroll", () => {
      var header = document.querySelector("header");
      header.classList.toggle("sticky", window.scrollY > 0);
  })




  //manu bar on mobil view
let navbar = document.querySelector('header ul');
let section=document.querySelector('section');

document.querySelector('#menu-icon').onclick =()=>{
  
    navbar.classList.toggle('active');
    section.classList.toggle('fade');
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
  

}



//entertinment slider

$('.owl-carousel').owlCarousel({
  margin: 10,
  loop:true,
  nav: true,
  navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide' style=width:'5rem'></div>"],
  responsive: {
      0: {
          items: 1
      },
      600: {
          items: 3
      },
      1000: {
          items:4
      }
  }
})



let add = document.querySelector('#hide-show');
let mail = document.querySelector('#email');
document.querySelector('#myid').onclick =()=>{
add.classList.toggle('active');
mail.classList.toggle('emaildown');
}


