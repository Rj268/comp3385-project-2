<template>
  <div class="register-container">
    <nav class="navbar">
      <div class="navbar-brand">United Auto Sales</div>
      <div class="navbar-links">
        <router-link to="/register">Register</router-link>
        <router-link to="/login">Login</router-link>
      </div>
    </nav>

    <div class="register-card">
      <h1>Register New User</h1>

      <form @submit.prevent="handleRegister" enctype="multipart/form-data">
        <!-- Username -->
        <div class="form-group">
          <label>Username</label>
          <input
            v-model="form.name"
            type="text"
            required
            placeholder="Enter your username"
          />
        </div>

        <!-- Password -->
        <div class="form-group">
          <label>Password</label>
          <input
            v-model="form.password"
            type="password"
            required
            placeholder="Enter your password"
          />
        </div>

        <!-- Confirm -->
        <div class="form-group">
          <label>Confirm Password</label>
          <input
            v-model="form.password_confirmation"
            type="password"
            required
            placeholder="Confirm your password"
          />
        </div>

        <!-- Fullname -->
        <div class="form-group">
          <label>Fullname</label>
          <input
            v-model="form.fullname"
            type="text"
            required
            placeholder="Enter your full name"
          />
        </div>

        <!-- Email -->
        <div class="form-group">
          <label>Email</label>
          <input
            v-model="form.email"
            type="email"
            required
            placeholder="Enter your email"
          />
        </div>

        <!-- Location -->
        <div class="form-group">
          <label>Location</label>
          <input
            v-model="form.location"
            type="text"
            placeholder="Enter your location"
          />
        </div>

        <!-- Biography -->
        <div class="form-group">
          <label>Biography</label>
          <textarea
            v-model="form.biography"
            rows="4"
            placeholder="Tell us a bit about yourself"
          ></textarea>
        </div>

        <!-- Photo -->
        <div class="form-group">
          <label>Upload Photo</label>
          <input
            @change="onFileChange"
            type="file"
            accept="image/*"
          />
        </div>

        <button type="submit" class="register-button">Register</button>
      </form>

      <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
      <p v-if="successMessage" class="success">{{ successMessage }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { registerUser } from '@/services/registerService'

const router = useRouter()

const form = ref({
  name: '',
  password: '',
  password_confirmation: '',
  fullname: '',
  email: '',
  location: '',
  biography: '',
  photo: null,
})

const errorMessage = ref('')
const successMessage = ref('')

function onFileChange(event) {
  form.value.photo = event.target.files[0] || null
}

const handleRegister = async () => {
  errorMessage.value = ''
  successMessage.value = ''

  try {
    await registerUser(form.value)
    successMessage.value = 'Registration successful! Please log in.'
    // Optionally redirect after a short delay:
    setTimeout(() => router.push('/login'), 1500)
  } catch (err) {
    errorMessage.value =
      err.response?.data?.message ||
      'Registration failed. Please check your inputs.'
  }
}
</script>

<style src="@/../css/register.css"></style>
