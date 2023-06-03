import React from 'react'
import Dropdown from 'react-bootstrap/Dropdown'
import { Deleteicon } from '../index'

function MyDropdown(props) {
    return (
      <Dropdown> 
        <Dropdown.Toggle variant="light">
        </Dropdown.Toggle>
  
        <Dropdown.Menu>
          <Dropdown.Item href={ props.editUrl }>Modifier</Dropdown.Item>
          <Dropdown.Item><Deleteicon deleteUrl={ props.deleteUrl } csrf_token_id={ props.csrf_token_id } /></Dropdown.Item>
        </Dropdown.Menu>
      </Dropdown>
    )
  }
export default MyDropdown