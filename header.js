 header = document.querySelector("header");
 marker_header = document.querySelector("#section_hero");
 menu = header.querySelector("#mobile-menu").children;
 logo_text = header.querySelector("#logo_text");



///// HEADER EN HAUT
let observer_header_moved = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        header.classList.remove("backdrop-blur-xs");
        logo_text.classList.remove("hidden");
        logo_text.classList.add("flex");
      } else {
        logo_text.classList.remove("flex");
        logo_text.classList.add("hidden");
        header.classList.add("backdrop-blur-xs");
      }
    });
  },
  { threshold: 1 },
);
observer_header_moved.observe(marker_header);

////////// ANIMATION HEADER
let scrollTimeout;
let ticking = false;

function onScroll() {
  if (!ticking) {
    window.requestAnimationFrame(() => {
      header.classList.add("-translate-y-[100%]");
      ticking = false;
    });
    ticking = true;
  }

  clearTimeout(scrollTimeout);
  scrollTimeout = setTimeout(() => {
    header.classList.remove("-translate-y-[100%]");
  }, 800);
}

window.addEventListener("scroll", onScroll, { passive: true });
