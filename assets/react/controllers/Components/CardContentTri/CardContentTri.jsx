import React from 'react'
import '../../../../styles/CardContentSecondaire.css'

import { MyDropdown } from '../index'

import { HiLocationMarker } from 'react-icons/hi'
import { MdOutlineBedroomParent ,MdOutlineBathroom } from 'react-icons/md'
import { TbHomeEdit } from 'react-icons/tb'

const CardContent = ( props ) => {
  var Bathrooms=true;
  if(props.Bathrooms==0){Bathrooms=false;}
  return (
    <div className="Annonce-item-content-Secondaire">
          <div className="Annonce-item-content-immeuble-Secondaire">
            <a className="Annonce-item-content-path-Secondaire" href={props.showUrl}>
              <div className="Annonce-item-content-immeuble-donnee-Secondaire">
                <div className="donnee-Secondaire category-Secondaire">
                  { props.Category }
                </div>
                <div className="donnee-Secondaire prix-Secondaire">
                  { props.Prix } MAD/mois
                </div>
                <div className="donnee-Secondaire adresse-Secondaire">
                  <HiLocationMarker/> { props.NumImmo } { props.Rue } , { props.Ville }
                </div>
                <div className="donnee-Secondaire intern-Secondaire">
                  <div className="donnee-intern-Secondaire"> <MdOutlineBedroomParent/> { props.Bedrooms } bedrooms</div>
                  {Bathrooms && <div className="donnee-intern-Secondaire"> <MdOutlineBathroom/> { props.Bathrooms } bathrooms</div>}
                  <div className="donnee-intern-Secondaire">{ props.Surface } m<sup>2</sup></div>
                </div>
              </div>
            </a>
            <div className="Annonce-item-content-immeuble-config-Secondaire">
            </div>
          </div>
          <div className="Annonce-item-content-personel-Secondaire">
          </div>
        </div>
  )
}

export default CardContent