// resources/js/services/carService.js
import axios from 'axios'

const API_URL = 'http://localhost:8000/api/v1'

// helper to get the auth header
function authHeader() {
  return { Authorization: `Bearer ${localStorage.getItem('token')}` }
}

/**
 * Fetch all cars, optionally filtered by make/model.
 */
export async function fetchCars(filters = {}) {
  const params = {}
  if (filters.make)  params.make  = filters.make
  if (filters.model) params.model = filters.model

  const resp = await axios.get(`${API_URL}/cars`, {
    params,
    headers: authHeader(),
  })
  return resp.data.data
}

/**
 * Create a new car. Expects an object with:
 * { make, model, colour, year, price, car_type, transmission, description, photo (File) }
 */
export async function createCar(car) {
  const formData = new FormData()
  formData.append('make',         car.make)
  formData.append('model',        car.model)
  formData.append('colour',       car.colour)
  formData.append('year',         car.year)
  formData.append('price',        car.price)
  formData.append('car_type',     car.car_type)
  formData.append('transmission', car.transmission)
  formData.append('description',  car.description)
  if (car.photo) {
    formData.append('photo', car.photo)
  }

  const resp = await axios.post(
    `${API_URL}/cars`,
    formData,
    {
      headers: {
        ...authHeader(),
        'Content-Type': 'multipart/form-data',
      },
    }
  )

  return resp.data
}
