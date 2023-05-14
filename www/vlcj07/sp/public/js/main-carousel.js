const slide1Container = document.getElementById('slide1-container');
const slide2Container = document.getElementById('slide2-container');
const slide3Container = document.getElementById('slide3-container');

let currentIndex = 0;

function showSlide(index) {
  switch (index) {
    case 0:
      slide1Container.querySelector('.slide').classList.add('active');
      slide2Container.querySelector('.slide').classList.remove('active');
      slide3Container.querySelector('.slide').classList.remove('active');
      break;
    case 1:
      slide1Container.querySelector('.slide').classList.remove('active');
      slide2Container.querySelector('.slide').classList.add('active');
      slide3Container.querySelector('.slide').classList.remove('active');
      break;
    case 2:
      slide1Container.querySelector('.slide').classList.remove('active');
      slide2Container.querySelector('.slide').classList.remove('active');
      slide3Container.querySelector('.slide').classList.add('active');
      break;
    default:
      break;
  }
  currentIndex = index;
}

function nextSlide() {
  let index = (currentIndex + 1) % 3;
  showSlide(index);
}

setInterval(nextSlide, 3000);


