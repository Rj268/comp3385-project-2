// services/loginService.js

import axios from 'axios'

export const loginUser = async (form) => {
  const response = await axios.post('http://localhost:8000/api/v1/auth/login', {
    name: form.name,          
    password: form.password,
  })

  return response.data.token  
}
