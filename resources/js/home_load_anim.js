import gsap from 'gsap';
import SplitText from 'gsap/SplitText';
import ScrollTrigger from 'gsap/ScrollTrigger';
import { DisplayP3ColorSpace } from 'three/examples/jsm/math/ColorSpaces.js';
import { split } from 'three/tsl';
import SplitType from 'split-type';
gsap.registerPlugin(SplitText, ScrollTrigger);

window.addEventListener('load', async () => {
  await document.fonts.ready;

  const popup = document.getElementById('popup');
  if (!popup) return;
  setTimeout(() => {
  popup.style.opacity = '0';
  setTimeout(() => {
    popup.remove();
  }, 500);
  }, 4000);
});

window.addEventListener('load', () => {
    gsap.registerPlugin(SplitText);

    const headline = document.querySelector('.title_headline');
    const split = new SplitText(headline, { type: 'lines' });

    split.lines.forEach(line => {
        const wrapper = document.createElement('div');
        wrapper.classList.add('line-wrapper');
        line.parentNode.insertBefore(wrapper, line);
        wrapper.appendChild(line);
        line.classList.add('line');
    });
    
    function animateHeadlineLines() {
      return gsap.to('.line', {
        y: 0,
        delay: 0.5,
        duration: 1.5,
        ease: 'power3.out',
        stagger: 0.15,
      });
    }

    function animateDescriptionLines() {
      return gsap.from('.title_desc_container', {
        y: 50,
        duration: 1.5,
        opacity: 0,
        ease: 'power3.out',
      });
    }
  

function animateButton() {
  return gsap.from('.home_btn', {
    y: 30,
        duration: 1.5,
        opacity: 0,
        ease: 'power3.out',
  }
  );
}


    function animateBackground() {
      return gsap.from('.about_bg', {
          scale: 0,
          duration: 1,
          transformOrigin: 'center center',
          ease: "power3.out"
        })
    }

    const tl = gsap.timeline();
    tl.add(animateBackground(), 0)
      .add(animateHeadlineLines(), 0.5)
      .add(animateDescriptionLines(), 1.5)
      .add(animateButton(), 0);

    
});

gsap.from('.project', {
  scrollTrigger: {
    trigger: '.projects_container',
    start: 'top center',
    end: '+=300px',
  },
  scale: 0,
  stagger: 0.3,
  ease: 'power5.inOut'
})

gsap.fromTo(
  '.achive',
  {
    y: 300,
    opacity: 0,
  },
  {
    scrollTrigger: {
      trigger: '.achives_wrapper',
      start: '-40% center',
      end: "30% center",  
      scrub: true
    },
    y: 0,
    opacity: 1,
    stagger: 1,
    duration: 1.5,
    scale: 1,
    ease: 'power5.out',
  }
);

const achives = document.querySelectorAll('.achive');

achives.forEach(el => {
  el.addEventListener('mouseenter', () => {
    gsap.to(el, { scale: 0.95, duration: 0.1, ease: "power1.inOut" });
  });
  el.addEventListener('mouseleave', () => {
    gsap.to(el, { scale: 1, duration: 0.1, ease: "power1.inOut" });
  });
});


gsap.from('.news_card', {
  scrollTrigger: {
    trigger: '.news_container',
    start: 'top center',
    end: '+=300px',
  },
  scale: 0,
  stagger: 0.3,
  ease: 'power5.inOut'
})


const tl = gsap.timeline({
  scrollTrigger: {
    trigger: '.achives_wrapper',
    start: 'top center', 
    end: '70% center',
    duration: 3,
    stagger: 1
  },
});

tl.to('#yearCount', {innerText: 30, snap: "innerText"}, 0)

tl.to('#squareCount', {innerText: 120000, snap: "innerText"}, 0)

tl.to('#procentCount', {innerText: 100, snap: "innerText"}, 0)


gsap.registerPlugin(SplitText);

const splitTypes = document.querySelectorAll('.about_item');

splitTypes.forEach((char,i) => {
  
  const text = new SplitType(char, {types: 'words, chars'})

  gsap.from(text.chars, {
    scrollTrigger: {
      trigger: char,
      start: 'top 80%',
      end: 'top 20%',
      scrub: true,
    },
    opacity: 0.2,
    stagger: 0.1
  })
})

GSDevTools.create();