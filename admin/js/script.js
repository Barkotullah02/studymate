document.addEventListener('DOMContentLoaded', (event)=>{

  function startCounting() {
  const counterItems = document.querySelectorAll('.counter-item');
  const options = {
    rootMargin: '0px',
    threshold: 0.2
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.dataset.target = entry.target.innerText;
        entry.target.innerText = 0;
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, options);

  counterItems.forEach(item => {
    observer.observe(item);
  });
}

function animateCounter(element) {
  const target = parseInt(element.dataset.target);
  let current = 0;

  const increment = Math.ceil(target / 100);

  const counter = setInterval(() => {
    current += increment;
    element.innerText = current;
    if (current >= target) {
      clearInterval(counter);
      element.innerText = target;
    }
  }, 15);
}

window.addEventListener('load', startCounting);

function startSlowCounting() {
  const counterItems = document.querySelectorAll('.counter-item-slow');
  const options = {
    rootMargin: '0px',
    threshold: 0.2
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.dataset.target = entry.target.innerText;
        entry.target.innerText = 0;
        animateSlowCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, options);

  counterItems.forEach(item => {
    observer.observe(item);
  });
}

function animateSlowCounter(element) {
  const target = parseInt(element.dataset.target);
  const increment = 1; // Count by 1 to make it visible and stop at 10
  let current = 0;

  const counter = setInterval(() => {
    current += increment;
    element.innerText = current;
    if (current >= target || current >= 11) { // Stop at target or 10
      clearInterval(counter);
      element.innerText = Math.min(target, 11); // Ensure to not exceed 10
    }
  }, 150); // Adjust the interval for a slower count

}

window.addEventListener('load', startSlowCounting);


let slideIndex = 1;
showSlides(slideIndex);

// Add automatic slide transition timer
let slideTimer = setInterval(function() {
  plusSlides(1);
}, 3000); // Change 3000 to the desired interval in milliseconds (3 seconds)

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

function pressSlide(n) {
  showSlides(slideIndex = n);
}


var slide1 = document.querySelector(".slide-1");
  var slide2 = document.querySelector(".slide-2");
  var slide3 = document.querySelector(".slide-3");

  // Initial state
  var currentIndex = 0; // Starting with the second slide
  var images = ["img/img1.jpeg", "img/img2.jpeg", "img/img3.jpeg", "img/img4.jpeg", "img/img5.jpeg", "img/img6.jpeg",]; // Array of images

  // Function to update slides with the current image
  function updateSlides() {
    let a = currentIndex;
    let b = a + 1;
    let c = a + 2;
    if (a > images.length - 1) {
      a = 0;
      b = 1;
      c = 2;
    }
    if (b > images.length - 1) {
      b = 0;
      a = 4;
      c = 1;
    }
    if (c > images.length - 1) {
      c = 0;
      b = 4;
      a = 3;
    }
    slide1.src = images[a];
    slide2.src = images[b];
    slide3.src = images[c];
  }

  // Function to move to the next image
  function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    updateSlides();
  }

  // Initially set up the slides
  updateSlides();

  // Set interval for sliding effect
  setInterval(nextImage, 3000); // Change image every 3 seconds


});

function showPressSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

function pressSlide(n) {
  showPressSlides(slideIndex = n);
}



