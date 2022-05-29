'use strict'
let show_box = document.getElementById('show_box');
let box_mobile = document.getElementById('box_mobile');
let box_mobile_bg = document.getElementById('box_mobile_bg');

show_box.addEventListener('click',function(){
  console.log('aaaa')
  box_mobile.classList.toggle('Box-mobile');
  box_mobile_bg.classList.toggle('Box-mobile__background');
});

box_mobile_bg.addEventListener('click',function(){
  box_mobile.classList.toggle('Box-mobile');
  box_mobile_bg.classList.toggle('Box-mobile__background');
});


// if(show_box !== null){

// }

// if(box_mobile_bg !== null){
// }