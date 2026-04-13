document.addEventListener("DOMContentLoaded", () => {
  const toggler = document.querySelector(".custom-toggler");
  toggler.addEventListener("click", () => {
    toggler.classList.toggle("active");
  });
});
