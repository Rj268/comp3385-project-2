// services/registerService.js

import axios from 'axios'

export const registerUser = async (form) => {
  // build FormData for file upload
  const data = new FormData()
  data.append('name', form.name)
  data.append('password', form.password)
  data.append('password_confirmation', form.password_confirmation)
  data.append('fullname', form.fullname)
  data.append('email', form.email)
  data.append('location', form.location)
  data.append('biography', form.biography)
  if (form.photo) {
    data.append('photo', form.photo)
  }

  const response = await axios.post(
    'http://localhost:8000/api/v1/auth/register',
    data,
    {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    }
  )

  return response.data
}
