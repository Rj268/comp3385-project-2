// userService.js
import axios from 'axios'

export const getUserFavourites = async (user_id) => {
  const response = await axios.post(`http://localhost:8000/api/v1/users/${user_id}/favourites`)
  return response.data
}

export const getUserInfo = async () => {
  const token = localStorage.getItem('token')

  const response = await axios.get('http://localhost:8000/api/v1/user', {
    headers: { Authorization: `Bearer ${token}` }
  })

  return response.data
}
export const logoutUser = () => {
    localStorage.removeItem('token')
  }
  