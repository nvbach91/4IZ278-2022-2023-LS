// This file is intentionally blank
// Use this file to add JavaScript to your project
  // Get all the slider images
  var sliderImages = document.querySelectorAll('.slider-container img');

  // Initialize the current image index
  var currentImageIndex = 0;

  // Function to change the image every 3 seconds
  function changeImage() {
    // Hide the current image
    sliderImages[currentImageIndex].style.display = 'none';

    // Increment the current image index
    currentImageIndex++;

    // Reset the current image index to 0 if it exceeds the number of images
    if (currentImageIndex === sliderImages.length) {
      currentImageIndex = 0;
    }

    // Show the next image
    sliderImages[currentImageIndex].style.display = 'block';
  }

  // Call the changeImage function every 3 seconds
  setInterval(changeImage, 3000);