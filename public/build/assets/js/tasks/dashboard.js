const mask = document.getElementById("mask");
const mouseCursor = (Event) => {
  const rect = mask.getBoundingClientRect();
  const mouseX = Event.clientX - rect.left - 115;
  const mouseY = Event.clientY - rect.top - 110;
  mask.style.maskPosition = `${mouseX}px ${mouseY}px`;
};

mask.addEventListener("mousemove", mouseCursor);
const nav = document.querySelector(".nav");
window.addEventListener("scroll", function () {
  nav.classList.toggle("active", window.scrollY > 0);
});