import React from 'react'
import '../../../../styles/Card.css'


import { ImageSlider , CardContent } from '../index'

const Card = (props) => {
  return (
    <div className='Annonce-item'>
      <div className='Annonce-wrapper'>
        <ImageSlider/>
        <CardContent Category={ props.Category } Prix={ props.Prix } NumImmo={ props.NumImmo } Rue={ props.Rue }  Ville={ props.Ville } Bedrooms={ props.Bedrooms } Bathrooms={ props.Bathrooms } Surface={ props.Surface } />
      </div>
    </div>
  )
}

export default Card