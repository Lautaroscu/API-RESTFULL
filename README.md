# API-RESTFULL
COMO CONSUMIR ESTA API :
Pueba con postman

El endpoint de la API es: http://localhost/tucarpetalocal/API-RESTFULL/api/chapters
 Method = GET 
 URL = api/chapters
 Code = 200
 Response = array type json

 Method = GET
 URL = api/chapters/:ID
 Code = 200
 Response = Blog

Method = POST
 URL = api/chapters
 Code = 201
 Response = Blog

Method = PUT 
URL = api/chapters/:ID
Code = 201
Response = Blog

Method = DELETE 
URL = api/chapters/:ID
Code = 200
Response = Blog

PAGINATION
Add query params to GET requests:
api/chapters?page=0&limit=number

SORTING
Add query params to GET requests:
api/chapters?sort=field&order=desc
Nota: El orden por default sera asc

SEARCHING & FILTERING
Add query params to GET requests:
api/chapters?filter=algo que quieras filtrar
