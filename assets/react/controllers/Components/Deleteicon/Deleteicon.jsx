import React from 'react'
import '../../../../styles/CardContentSecondaire.css'

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
        <button className="config-Secondaire">Supprimer</button>
    </form>
  )
}

export default Deleteicon