import React from 'react'
import '../../../../styles/ImageSlider.css'
import { default as image } from '../../../../../public/uploads/Annonce_Image/backyard-water-contemporary-architecture-sky.jpg'
import { default as image2 } from '../../../../../public/uploads/Annonce_Image/villa-house-model-key-drawing-retro-desktop-real-estate-sale-concept_1387-310.avif'



const ImageSlider = () => {
  return (
    <img className='Annonce-item-image' alt='' src={ image2 } />
  )
}

export default ImageSlider