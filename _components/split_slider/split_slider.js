"use strict"

const Flickity = require('flickity')
;

Flickity.createMethods.push('_createPrevNextCells')
Flickity.prototype._createPrevNextCells = function() {
    this.on( 'select', this.setPrevNextCells )
}
Flickity.prototype.setPrevNextCells = function() {
    // remove classes
    changeSlideClasses( this.previousSlide, 'remove', 'is-previous' );
    changeSlideClasses( this.previousPreviousSlide, 'remove', 'is-previous-previous' );
    changeSlideClasses( this.nextSlide, 'remove', 'is-next' );
    changeSlideClasses( this.nextNextSlide, 'remove', 'is-next-next' );
    // set slides
    this.previousSlide = this.slides[ this.selectedIndex - 1 ];
    this.previousPreviousSlide = this.slides[ this.selectedIndex - 2 ];
    this.nextSlide = this.slides[ this.selectedIndex + 1 ];
    this.nextNextSlide = this.slides[ this.selectedIndex + 2 ];
    // add classes
    changeSlideClasses( this.previousSlide, 'add', 'is-previous' );
    changeSlideClasses( this.previousPreviousSlide, 'add', 'is-previous-previous' );
    changeSlideClasses( this.nextSlide, 'add', 'is-next' );
    changeSlideClasses( this.nextNextSlide, 'add', 'is-next-next' );
}

function changeSlideClasses( slide, method, className ) {
    if ( !slide ) {
        return
    }
    slide.getCellElements().forEach( function( cellElem ) {
        cellElem.classList[ method ]( className )
    })
}


(function() {

    const storyImages = document.querySelector('.story-images')
    if(!storyImages){ return }
    const storyExcerpt = document.querySelector('.story-excerpt')
    if(!storyExcerpt){ return }

    const excerpts = new Flickity( storyExcerpt, {
        wrapAround: false,
        pageDots: false,
        prevNextButtons: false,
        draggable: false,
        imagesLoaded: true,
        initialIndex: 0,
        cellAlign: 'left',
    })

    const slides = storyImages.querySelectorAll('.slide')
    if(storyImages && slides.length > 1){
        const picSlider = new Flickity( storyImages, {
            wrapAround: false,
            pageDots: false,
            prevNextButtons: true,
            imagesLoaded: true,
            initialIndex: 0,
            cellAlign: 'left',
        })
        picSlider.on( 'select', function() {
          excerpts.select(picSlider.selectedIndex);
        });
    } else {
        storyImages.classList.remove('flickity')
    }

}());
