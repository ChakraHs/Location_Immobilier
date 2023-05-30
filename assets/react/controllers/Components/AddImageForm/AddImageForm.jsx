import React, { useState } from 'react'
import axios from 'axios'

const AddImageForm = (props) => {
  const [selectedFile, setSelectedFile] = useState(null);
  const addimageUrl = props.addimageUrl ;
  const handleFileChange = (e) => {
    setSelectedFile(e.target.files[0]);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append('image', selectedFile);

    axios.post(addimageUrl, formData)
    .then(response => {
      console.log(response.data);
    })
    .catch(error => {
      console.error(error);
    });
  };

  return (
    <form onSubmit={handleSubmit}>
      <input type="file" onChange={handleFileChange} />
      <button type="submit">Add Image</button>
    </form>
  );
};

export default AddImageForm;
