window.addEventListener('load', () => {
    const carouselSlide = document.querySelector('.carousel-slide');
    const images = document.querySelectorAll('.carousel-slide img');
  
    let counter = 1;
    if (images)
    {
      const size = images[0].clientWidth;
  
      carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
  
      function moveToNextSlide() {
        if (counter >= images.length - 1) 
          counter = -1;
        carouselSlide.style.transition = 'transform 0.4s ease-in-out';
        counter++;
        carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
      }
  
      function moveToPrevSlide() {
        if (counter <= 0) 
          counter = images.length;
        carouselSlide.style.transition = 'transform 0.4s ease-in-out';
        counter--;
        carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
      }
  
      carouselSlide.addEventListener('transitionend', () => {
        if (images[counter].id === 'lastClone') {
          carouselSlide.style.transition = 'none';
          counter = images.length - 2;
          carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
        }
        if (images[counter].id === 'firstClone') {
          carouselSlide.style.transition = 'none';
          counter = images.length - counter;
          carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
        }
      });
  
      nextBtn.addEventListener('click', () => {
        moveToNextSlide();
      });
  
      prevBtn.addEventListener('click', () => {
        moveToPrevSlide();
      });
  
      setInterval(moveToNextSlide, 10000);
    } 
  });
