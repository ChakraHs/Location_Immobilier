import React from 'react'
import '../../../../styles/CardContent.css'

import { MdDeleteForever } from 'react-icons/md'

const Deleteicon = (props) => {
  return (
    <form method="post" action={ props.deleteUrl } 
        onSubmit={(event) => {
            if (!window.confirm('Are you sure you want to delete this item?')) {
            event.preventDefault();
            }
        }
        }>
        <input type="hidden" name="_token" value={ props.csrf_token_id }/>
        <button className="config delete"><MdDeleteForever/></button>
    </form>
  )
}

export default Deleteicon