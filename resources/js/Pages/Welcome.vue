<template>
  <div class="home-container">
    <nav class="navbar">
      <div class="navbar-brand">United Auto Sales</div>
      <div class="navbar-links">
        <router-link to="/register">Register</router-link>
        <router-link to="/login">Login</router-link>
      </div>
    </nav>

    <div class="home-content">
      <div class="home-left">
        <h1>Buy and Sell Cars Online</h1>
        <p>
          United Auto Sales provides the fastest, easiest and most user friendly way to buy or sell cars online.
          Find a Great Price on the Vehicle You Want.
        </p>
        <div class="buttons">
          <router-link to="/register" class="register-button">Register</router-link>
          <router-link to="/login" class="login-button">Login</router-link>
        </div>
      </div>

      <div class="home-right">
        <img src="/images/car-home.jpg" alt="Car" />
      </div>
    </div>
  </div>
</template>

<script setup>
// No extra logic needed for now
</script>

<style scoped>
.home-container {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background-color: #f5f7fa;
}

.navbar {
  width: 100%;
  background-color: #1f2937;
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
}

.navbar-brand {
  font-size: 20px;
  font-weight: bold;
}

.navbar-links a {
  margin-left: 20px;
  color: white;
  text-decoration: none;
}

.navbar-links a:hover {
  text-decoration: underline;
}

.home-content {
  display: flex;
  flex: 1;
  padding: 50px;
  align-items: center;
  justify-content: center;
}

.home-left {
  flex: 1;
  padding-right: 30px;
}

.home-left h1 {
  font-size: 40px;
  margin-bottom: 20px;
}

.home-left p {
  margin-bottom: 30px;
  color: #6b7280;
}

.buttons {
  display: flex;
  gap: 20px;
}

.register-button {
  background-color: #3b82f6;
  padding: 10px 20px;
  border-radius: 5px;
  color: white;
  text-decoration: none;
}

.login-button {
  background-color: #10b981;
  padding: 10px 20px;
  border-radius: 5px;
  color: white;
  text-decoration: none;
}

.register-button:hover {
  background-color: #2563eb;
}

.login-button:hover {
  background-color: #059669;
}

.home-right {
  flex: 1;
}

.home-right img {
  width: 100%;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
</style>
