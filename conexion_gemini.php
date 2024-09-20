<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Ejemplo API Google Gemini</title>

    <style>
      body {
        font-family: sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      h1 {
        margin-bottom: 20px;
      }

      #chatbox {
        width: 400px;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
      }

      #messages {
        height: 300px;
        overflow-y: scroll;
        margin-bottom: 20px;
        padding: 10px;
      }

      .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
      }

      .user {
        background-color: #eee;
        text-align: right;
      }

      .bot {
        background-color: #ccf;
      }

      input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
      }

      button {
        padding: 10px 20px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div id="chatbox">
      <h1>Generador de texto con Google Gemini</h1>
      <div id="messages"></div>
      <input type="text" id="inputText" placeholder="Escribe algo aquí..." />
      <button id="generateButton">Generar</button>
      <p id="responseText"></p>
    </div>

    <script type="importmap">
      {
        "imports": {
          "@google/generative-ai": "https://esm.run/@google/generative-ai"
        }
      }
    </script>
    <script type="module">
  import { GoogleGenerativeAI } from "@google/generative-ai";

  const API_KEY = "AIzaSyATZ2E9oH5J99GfJB0d4LrE4S0mZ-NozFQ";
  const genAI = new GoogleGenerativeAI(API_KEY);

  document
    .getElementById("generateButton")
    .addEventListener("click", async () => {
      const inputText = document.getElementById("inputText").value;
      const model = genAI.getGenerativeModel({
        model: "gemini-1.5-pro-latest",
      });
      const prompt = inputText;

      try {
        const result = await model.generateContent(prompt);
        const response = await result.response;
        const generatedText = await response.text();

        // Mostrar el resultado en el frontend
        document.getElementById("responseText").innerText = generatedText;

        // Enviar el resultado generado a un archivo PHP para guardarlo en la base de datos
        await fetch('config/save_prompt.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ prompt: inputText, response: generatedText }),
        });
      } catch (error) {
        console.error("Error al generar contenido:", error);
      }
    });
</script>



  </body>
</html>
