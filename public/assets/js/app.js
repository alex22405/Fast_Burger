console.log("bonjour");
// Effet scroll nav
window.addEventListener('scroll', function () {
    const header = document.querySelector('header');
    header.classList.toggle("sticky", window.scrollY > 0)
}
)
/*********************************************************************************************/
// Apparition titre et p
const titreSpans = document.querySelectorAll('.accueil_banner_content span');


window.addEventListener('load', () => {
    const TL = gsap.timeline({ paused: true });

    TL
        .staggerFrom(titreSpans, 5, { opacity: 0.1, ease: "power2.out" }, 0.4)
    TL.play()
}
)

const titreSpans2 = document.querySelectorAll('.banner_content_titleText span');


window.addEventListener('load', () => {
    const TL = gsap.timeline({ paused: true });

    TL
        .staggerFrom(titreSpans2, 4, { opacity: 0.1, ease: "power2.out" }, 0.1)
    TL.play()
}
)
/*********************************************************************************************/
// Responsive menu toggle
function toggleMenu() {
    const menuToggle = document.querySelector('.menuToggle');
    const navigation = document.querySelector('.navigation');

    menuToggle.classList.toggle('active');
    navigation.classList.toggle('active');
}
/*********************************************************************************************/

const sr = ScrollReveal();

sr.reveal('.accueil_menu_name', {
    origin: 'left',
    distance: '50px',
    duration: 2000,
});

sr.reveal('.accueil_titleText', {
    origin: 'left',
    distance: '50px',
    duration: 2000,
});

sr.reveal('.menu_description', {
    origin: 'top',
    distance: '50px',
    duration: 4000
});

sr.reveal('.menu_content_wrapper', {
    origin: 'bottom',
    distance: '50px',
    duration: 2000,
    delay: 500
}, 50);


sr.reveal('#mission_appear', {
    origin: 'right',
    distance: '50px',
    duration: 3000,
    delay: 1000
});

sr.reveal('#valeurs_appear', {
    origin: 'left',
    distance: '50px',
    duration: 3000,
    delay: 1000
});

sr.reveal('.accueil_mission_text', {
    origin: 'bottom',
    distance: '50px',
    duration: 3000,
});

sr.reveal('.contact_text', {
    origin: 'left',
    distance: '50px',
    duration: 4000,
});

sr.reveal('.contact_form', {
    origin: 'right',
    distance: '50px',
    duration: 4000,
    delay: 1000
});