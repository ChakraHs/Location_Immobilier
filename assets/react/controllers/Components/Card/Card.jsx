import React from 'react'
import '../../../../styles/Card.css'

import { ImageSlider , CardContent } from '../index'

const Card = (props) => {
  return (
    <div className='Annonce-item'>
      <div className='Annonce-wrapper'>
        <ImageSlider id={ props.id } image={ props.image } />
        {/* <a href={ props.showUrl }>
          <CardContent 
            Category={ props.Category } 
            Prix={ props.Prix } 
            NumImmo={ props.NumImmo } 
            Rue={ props.Rue }  
            Ville={ props.Ville } 
            Bedrooms={ props.Bedrooms } 
            Bathrooms={ props.Bathrooms } 
            Surface={ props.Surface } 
            deleteUrl={ props.deleteUrl } 
            csrf_token_id={ props.csrf_token_id } 
            editUrl={ props.editUrl } />
        </a> */}
        <CardContent 
          Category={ props.Category } 
          Prix={ props.Prix } 
          NumImmo={ props.NumImmo } 
          Rue={ props.Rue }  
          Ville={ props.Ville } 
          Bedrooms={ props.Bedrooms } 
          Bathrooms={ props.Bathrooms } 
          Surface={ props.Surface } 
          deleteUrl={ props.deleteUrl } 
          csrf_token_id={ props.csrf_token_id } 
          editUrl={ props.editUrl }
          addimageUrl={ props.addimageUrl } />
      </div>
    </div>
  )
}

export default Card