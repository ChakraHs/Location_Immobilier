import React from 'react'
import '../../../../styles/ImageSlider.css'
import '../../../../../node_modules/slick-carousel/slick/slick.css'
import '../../../../../node_modules/slick-carousel/slick/slick-theme.css'

import Slider from "react-slick";


const ImageSlider = (props) => {
  const imagepath = '../../../../uploads/Annonce_Image/';
  var settings = {
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1
  };
  return (
    <Slider {...settings}>
      { props.image.map(imageURL => (
        <div key={ props.id }>
          <img className='Annonce-item-image' alt={ `${imagepath}${imageURL}` } src={ `${imagepath}${imageURL}` } />
        </div>
      )) }
    </Slider>
  )
}

export default ImageSlider