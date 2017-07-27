"use strict"

const Flickity = require('flickity')
;

(function() {
    const logoSlider = document.querySelector('.partner_logos')
    if(!logoSlider){ return }
    const slides = logoSlider.querySelectorAll('.slide')
    if (logoSlider) {
        const logo = new Flickity( logoSlider, {
            setGallerySize: true,
            wrapAround: true,
            pageDots: false,
            prevNextButtons: false,
            autoPlay: 10000,
            imagesLoaded: true,
        })
    } else {
        logoSlider.classList.remove('flickity')
    }
}());
