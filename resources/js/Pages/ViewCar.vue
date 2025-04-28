<template>
  <div class="view-car-container">
    <div class="car-details-card">
      <img :src="car.image" alt="Car Image" class="car-image" />

      <div class="car-info">
        <h2>{{ car.year }} {{ car.make }} {{ car.model }}</h2>
        <p>{{ car.description }}</p>

        <div class="car-specs">
          <p><strong>Color:</strong> {{ car.color }}</p>
          <p><strong>Body Type:</strong> {{ car.type }}</p>
          <p><strong>Price:</strong> ${{ car.price }}</p>
          <p><strong>Transmission:</strong> {{ car.transmission }}</p>
        </div>

        <div class="buttons">
          <button class="email-button">Email Owner</button>

          <button class="heart-button" @click="toggleFavourite(car.id)">
            <span v-if="isFavourited">❤️</span>
            <span v-else>🤍</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      car: {},           // Car object (details)
      isFavourited: false, // Track heart status
      token: '',         // User's JWT token
    }
  },
  methods: {
    async toggleFavourite(carId) {
      try {
        const response = await axios.post(`http://localhost:8000/api/v1/cars/${carId}/favourite`, {}, {
          headers: {
            Authorization: `Bearer ${this.token}`
          }
        });

        this.isFavourited = response.data.favourited;  // Update heart immediately
      } catch (error) {
        console.error('Error favouriting car:', error);
      }
    },

    async fetchCarDetails() {
      try {
        const carId = this.$route.params.car_id; // get from URL /cars/{id}
        const response = await axios.get(`http://localhost:8000/api/v1/cars/${carId}`, {
          headers: {
            Authorization: `Bearer ${this.token}`
          }
        });

        this.car = response.data.car;
        this.isFavourited = response.data.car.is_favourited || false; // optional if your API returns it
      } catch (error) {
        console.error('Error fetching car details:', error);
      }
    }
  },
  mounted() {
    this.token = localStorage.getItem('token'); // Get token when page loads
    this.fetchCarDetails(); // Load the car info immediately
  }
}
</script>

<style scoped>
.view-car-container {
  padding: 2rem;
  display: flex;
  justify-content: center;
}

.car-details-card {
  width: 800px;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
  padding: 2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.car-image {
  width: 100%;
  border-radius: 10px;
  margin-bottom: 1.5rem;
}

.car-info {
  text-align: center;
}

.car-specs {
  margin-top: 1rem;
  text-align: left;
}

.buttons {
  margin-top: 2rem;
  display: flex;
  gap: 1rem;
  justify-content: center;
}

.email-button {
  background-color: #00b894;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
}

.heart-button {
  background: none;
  border: none;
  font-size: 2rem;
  cursor: pointer;
}
</style>
