const triggers = document.querySelectorAll('.nav-item');
const background = document.querySelector('.dropdownBackground');
const nav = document.querySelector('.navbar');
const navbarList = nav.querySelector('.navbar__list');

const hamburger = document.querySelector('.hamburger')

function handleEnter() {
  const dropdown = this.querySelector('.dropdown');
  if (dropdown) {
    background.classList.add('open');
    this.classList.add('trigger-enter');
    setTimeout(() => this.classList.contains('trigger-enter') && this.classList.add('trigger-enter-active'), 150);
    const dropdownCoords = dropdown.getBoundingClientRect();
    const navCoords = nav.getBoundingClientRect();
    const coords = {
      height: dropdownCoords.height,
      width: dropdownCoords.width,
      top: (dropdownCoords.top - navCoords.top)-this.offsetTop,
      left: dropdownCoords.left - navCoords.left
    };
    background.style.setProperty('width', `${coords.width}px`);
    background.style.setProperty('height', `${coords.height}px`);
    background.style.setProperty('transform', `translate(${coords.left}px, ${coords.top}px)`);
    background.style.setProperty('color', '#000');
  }
}

function handleLeave() {
  this.classList.remove('trigger-enter', 'trigger-enter-active');
  //background.style = null
  background.classList.remove('open');
}

function openMenu(){
  navbarList.classList.toggle('show')
  console.log(navbarList)
}
function closeMenu(){
  this.classList.remove('show')
}
triggers.forEach(trigger => trigger.addEventListener('mouseenter', handleEnter));
triggers.forEach(trigger => trigger.addEventListener('mouseleave', handleLeave));
hamburger.addEventListener('click', openMenu);
hamburger.addEventListener('mouseleave', closeMenu);