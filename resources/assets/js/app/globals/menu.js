document.addEventListener('DOMContentLoaded', function () {
console.log('loaded')
  // Get all "navbar-burger" elements
  let $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  console.log($navbarBurgers)
  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {
    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {
        console.log('clicked')
        // Get the target from the "data-target" attribute
        let target = $el.dataset.target;
        let $target = document.getElementById(target);
        const navItem = document.querySelectorAll('.navbar-item');
        navItem.forEach((item)=>{
          item.addEventListener('click',function(){
            $el.classList.remove('is-active');
            $target.classList.remove('is-active');
          })
        })
        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
      });
    });
  }
});
