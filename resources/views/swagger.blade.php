<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>API Документация — AttendoStud</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5/swagger-ui.css">
<style>
body{margin:0;padding:0;}
.topbar{display:none!important;}
.swagger-ui .info .title{color:#1e293b;}
</style>
</head>
<body>
<div id="swagger-ui"></div>
<script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
<script>
SwaggerUIBundle({
  url: "/api-docs.json",
  dom_id: '#swagger-ui',
  presets: [SwaggerUIBundle.presets.apis, SwaggerUIBundle.SwaggerUIStandalonePreset],
  layout: "BaseLayout",
  deepLinking: true,
  defaultModelsExpandDepth: 1,
  defaultModelExpandDepth: 1
});
</script>
</body>
</html>
