// app.js

// Função para o login
document.getElementById("loginForm").addEventListener("submit", async function(e) {
  e.preventDefault();

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  try {
    const response = await fetch("http://localhost/autoagend/backend/api.php/login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password })
    });
    const data = await response.json();

    if (response.ok) {
      localStorage.setItem("token", data.token);  // Armazena o token JWT
      window.location.href = "dashboard.html";     // Redireciona para a página de cadastro de usuário
    } else {
      document.getElementById("error-message").textContent = data.message;
    }
  } catch (error) {
    console.error("Erro no login:", error);
  }
});

// Função para o cadastro de usuário
document.getElementById("userForm").addEventListener("submit", async function(e) {
  e.preventDefault();

  const name = document.getElementById("name").value;
  const cpf = document.getElementById("cpf").value;
  const email = document.getElementById("userEmail").value;
  const password = document.getElementById("userPassword").value;
  const profile = document.getElementById("profile").value;

  try {
    const response = await fetch("http://localhost/autoagend/backend/api.php/users", {
      method: "POST",
      headers: { 
        "Content-Type": "application/json",
        "Authorization": `Bearer ${localStorage.getItem("token")}`
      },
      body: JSON.stringify({ name, cpf, email, password, profile })
    });

    const data = await response.json();
    document.getElementById("response-message").textContent = data.message;
  } catch (error) {
    console.error("Erro ao cadastrar usuário:", error);
  }
});
