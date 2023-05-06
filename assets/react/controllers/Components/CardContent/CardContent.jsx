import React from 'react'
import '../../../../styles/ImageSlider.css'
import { HiLocationMarker } from 'react-icons/hi'
import { MdOutlineBedroomParent ,MdOutlineBathroom } from 'react-icons/md'
import { TiUserDelete } from 'react-icons/ti'
import { FaUserEdit } from 'react-icons/fa'

const CardContent = (props) => {
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
                <div className="donnee-intern"> <MdOutlineBathroom/> { props.Bathrooms } bathrooms</div>
                <div className="donnee-intern">{ props.Surface } m<sup>2</sup></div>
              </div>
            </div>
            <div className="Annonce-item-content-immeuble-config">
              <a href="" className="config edit"><FaUserEdit/></a>
              <a href="" className="config delete"><TiUserDelete/></a>
            </div>
          </div>
          <div className="Annonce-item-content-personel">

          </div>
        </div>
  )
}

export default CardContent