import React from 'react'
import '../../../../styles/CardContent.css'

import { MyDropdown } from '../index'


import { HiLocationMarker } from 'react-icons/hi'
import { MdOutlineBedroomParent ,MdOutlineBathroom } from 'react-icons/md'

const CardContent = ( props ) => {
  var Bathrooms=true;
  if(props.Bathrooms==0){Bathrooms=false;}
  return (
    <div className="Annonce-item-content">
      <div className="Annonce-item-content-immeuble">
        <div className="Annonce-item-content-immeuble-donnee">
          <div className="donnee category">
            { props.Category }
          </div>
          <div className="donnee prix">
            { props.Prix } MAD/mois
          </div>
          <div className="donnee adresse">
            <HiLocationMarker/> { props.NumImmo } { props.Rue } , { props.Ville }
          </div>
          <div className="donnee intern">
            <div className="donnee-intern"> <MdOutlineBedroomParent/> { props.Bedrooms } bedrooms</div>
            {Bathrooms && <div className="donnee-intern"> <MdOutlineBathroom/> { props.Bathrooms } bathrooms</div>}
            <div className="donnee-intern">{ props.Surface } m<sup>2</sup></div>
          </div>
        </div>
        {/* <div className="Annonce-item-content-immeuble-config">
          <MyDropdown editUrl={ props.editUrl } deleteUrl={ props.deleteUrl } csrf_token_id={ props.csrf_token_id } />
        </div> */}
      </div>
      <div className="Annonce-item-content-personel">
      </div>
    </div> 
  )
}

export default CardContent