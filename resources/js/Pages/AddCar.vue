<template>
  <div class="addcar-container">
    <nav class="navbar">
      <div class="navbar-brand">United Auto Sales</div>
      <div class="navbar-links">
        <router-link to="/addcar">Add Car</router-link>
        <router-link to="/explore">Explore</router-link>
        <router-link to="/profile">My Profile</router-link>
        <a @click="logout" style="cursor:pointer">Logout</a>
      </div>
    </nav>

    <div class="addcar-card">
      <h1>Add New Car</h1>

      <form @submit.prevent="submitCar" enctype="multipart/form-data">
        <div class="form-group">
          <label>Make</label>
          <input v-model="form.make" type="text" required placeholder="Make" />
        </div>

        <div class="form-group">
          <label>Model</label>
          <input v-model="form.model" type="text" required placeholder="Model" />
        </div>

        <div class="form-group">
          <label>Colour</label>
          <input v-model="form.colour" type="text" placeholder="Colour" />
        </div>

        <div class="form-group">
          <label>Year</label>
          <input v-model="form.year" type="number" placeholder="Year" />
        </div>

        <div class="form-group">
          <label>Price</label>
          <input
            v-model="form.price"
            type="number"
            placeholder="Price in dollars"
          />
        </div>

        <div class="form-group">
          <label>Car Type</label>
          <select v-model="form.car_type">
            <option>Sedan</option>
            <option>SUV</option>
            <option>Hatchback</option>
            <option>Coupe</option>
          </select>
        </div>

        <div class="form-group">
          <label>Transmission</label>
          <select v-model="form.transmission">
            <option>Automatic</option>
            <option>Manual</option>
          </select>
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea
            v-model="form.description"
            rows="4"
            placeholder="Describe the car"
          ></textarea>
        </div>

        <div class="form-group">
          <label>Upload Photo</label>
          <input @change="onFileChange" type="file" accept="image/*" />
        </div>

        <button type="submit" class="addcar-button">Save</button>
      </form>

      <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
      <p v-if="successMessage" class="success">{{ successMessage }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { createCar } from '@/services/carService'

const router = useRouter()
const form = ref({
  make: '',
  model: '',
  colour: '',
  year: '',
  price: '',
  car_type: 'Sedan',
  transmission: 'Automatic',
  description: '',
  photo: null,
})

const errorMessage   = ref('')
const successMessage = ref('')

function onFileChange(e) {
  form.value.photo = e.target.files[0] || null
}

async function submitCar() {
  errorMessage.value   = ''
  successMessage.value = ''

  try {
    await createCar(form.value)
    successMessage.value = 'Car added successfully!'
    setTimeout(() => router.push('/explore'), 1500)
  } catch (err) {
    console.error(err)
    errorMessage.value =
      err.response?.data?.message || 'Failed to add car. Please try again.'
  }
}

function logout() {
  localStorage.removeItem('token')
  router.push('/login')
}
</script>

<style src="@/../css/addcar.css"></style>
