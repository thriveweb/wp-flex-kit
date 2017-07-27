import Flickity from 'flickity'
import _each from 'lodash/each'

const discoverBanners = document.querySelectorAll('.home-banner')

_each(discoverBanners, initBanner)

function initBanner(banner){
  const bgs = banner.querySelectorAll('.background-image')
  const slideCount = banner.querySelectorAll('.home-slider .slide').length

  if (slideCount <= 1 ) return updateBg(0)

  const slider = new Flickity(banner.querySelector('.home-slider'), {
    prevNextButtons: false,
    pageDots: true,
    autoPlay: 4000,
    wrapAround: true
  })

  slider.on('select', handleSlideChange)
  handleSlideChange()

  function handleSlideChange () {
    updateBg(slider.selectedIndex)
  }

  function updateBg (index) {
    _each(bgs, bg => bg.classList.remove('active'))
    bgs[index].classList.add('active')
  }
}
