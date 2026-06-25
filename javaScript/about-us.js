
<script>
let index = 0;
const slides = document.querySelector(".slides");
const total = document.querySelectorAll(".slide").length;

document.querySelector(".next").onclick = () => {
  index = (index + 1) % total;
  slides.style.transform = `translateX(-${index * 100}%)`;
};

document.querySelector(".prev").onclick = () => {
  index = (index - 1 + total) % total;
  slides.style.transform = `translateX(-${index * 100}%)`;
};
</script>
